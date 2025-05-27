<?php

namespace App\Instances;

use App\Models\Employee;
use App\Models\Fingerprint;
use Carbon\Carbon;
use Jmrashed\Zkteco\Lib\ZKTeco;

class FingerprintInstance
{
    public ZKTeco $zk;

    public function __construct(protected Fingerprint $fingerprint) {}

    public function init()
    {
        $timeout = 2;
        $fp = @stream_socket_client("tcp://{$this->fingerprint->ip}:{$this->fingerprint->port}", $errno, $errstr, $timeout);

        if (!$fp) {
            throw new \Exception("Unable to connect to fingerprint device: $errstr ($errno)");
        }

        fclose($fp);
        $zk = new ZKTeco($this->fingerprint->ip, $this->fingerprint->port);
        $this->zk = $zk;
        $this->zk->connect();
        $this->zk->disableDevice();
    }

    public function disable()
    {
        $this->zk->enableDevice();
        $this->zk->disconnect();
    }

    public function check(): bool
    {
        try {
            $this->init();
            $this->disable();

            return true;
        } catch (\Throwable $th) {
            session()->flash('errorToasts', array_merge(
                session('errorToasts', []),
                ["Mesin '{$this->fingerprint->name}' offline"]
            ));
            return false;
        }
    }

    public function test()
    {
        $this->init();
        $this->zk->testVoice();
        $this->disable();
    }

    public function getUsers()
    {
        $this->init();
        $users = $this->zk->getUser();
        $this->disable();
        return $users;
    }

    public function setUser(int $uid, string $name, int|string $password)
    {
        $this->init();
        try {
            $this->zk->setUser(
                uid: $uid,
                userid: $uid,
                name: $name,
                password: $password,
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        } finally {
            $this->disable();
        }
    }

    public function deleteUser(int $uid)
    {
        $this->init();
        try {
            $this->zk->removeUser($uid);
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        } finally {
            $this->disable();
        }
    }

    protected function getAttState(int $state)
    {
        switch ($state) {
            case 15:
                return "Wajah";
            default:
                return "Jari";
        }
    }

    protected function getAttType(int $type)
    {
        switch ($type) {
            case 255:
                return "Check-in";
            default:
                return "Type belum diatur, Silahkan hubungi Developer";
        }
    }

    public function getAttendanceRaw(array $params = [])
    {
        $this->init();
        $attendances = $this->zk->getAttendance();
        $this->disable();
        return $attendances;
    }

    public function getAttendance(array $params = [])
    {
        $this->init();
        $attendances = $this->zk->getAttendance();
        $this->disable();
        return collect($attendances)
            ->filter(function ($attendance) use ($params) {
                $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $attendance['timestamp']);

                $monthMatch = isset($params['m']) ? $carbon->month == $params['m'] : true;
                $yearMatch = isset($params['y']) ? $carbon->year == $params['y'] : true;

                return $monthMatch && $yearMatch;
            })
            ->map(function ($attendance) {
                $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $attendance['timestamp']);
                $employee = Employee::find($attendance['id']);
                return [
                    ...$attendance,
                    'date' => $carbon->format('d, F, Y'),
                    'time' => $carbon->format('H:i:s'),
                    'state' => $this->getAttState($attendance['state']),
                    'type' => $this->getAttType($attendance['type']),
                    'employee' => $employee,
                    'fingerprint' => $this->fingerprint->name,
                ];
            });
    }

    public function getAttendanceGroupBy(array $params = [])
    {
        $this->init();
        $attendances = $this->zk->getAttendance();
        $this->disable();
        return collect($attendances)
            ->filter(function ($attendance) use ($params) {
                $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $attendance['timestamp']);

                $monthMatch = isset($params['m']) ? $carbon->month == $params['m'] : true;
                $yearMatch = isset($params['y']) ? $carbon->year == $params['y'] : true;

                return $monthMatch && $yearMatch;
            })
            ->map(function ($attendance) {
                $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $attendance['timestamp']);
                return [
                    ...$attendance,
                    'date' => $carbon->format('d, F, Y'),
                    'time' => $carbon->format('H:i:s'),
                    'state' => $this->getAttState($attendance['state']),
                    'type' => $this->getAttType($attendance['type']),
                ];
            })->groupBy('id')
            ->map(function ($value, $key) {
                return [
                    'employee' => Employee::find($key),
                    'attendances' => $value->groupBy(function ($attendance) {
                        $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $attendance['timestamp']);
                        return $carbon->day; // Group by day of the month
                    })->toArray(),
                ];
            });
    }
}
