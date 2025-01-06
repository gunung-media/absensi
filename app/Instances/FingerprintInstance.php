<?php

namespace App\Instances;

use App\Models\Employee;
use Jmrashed\Zkteco\Lib\Helper\Util;
use Jmrashed\Zkteco\Lib\ZKTeco;

use function GuzzleHttp\default_ca_bundle;

class FingerprintInstance
{
    public ZKTeco $zk;

    public function init()
    {
        $zk = new ZKTeco('192.168.1.201', 4370);
        $this->zk = $zk;
        $this->zk->connect();
        $this->zk->disableDevice();
    }

    public function disable()
    {
        $this->zk->enableDevice();
        $this->zk->disconnect();
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
                return "State belum diatur, Silahkan hubungi Developer";
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

    public function getAttendance()
    {
        $this->init();
        $attendances = $this->zk->getAttendance();
        $this->disable();
        return collect($attendances)->map(function ($attendance) {
            return [
                ...$attendance,
                'state' => $this->getAttState($attendance['state']),
                'type' => $this->getAttType($attendance['type']),
                'employee' => Employee::find($attendance['id'])
            ];
        });
    }
}
