<?php

namespace App\Instances;

use Jmrashed\Zkteco\Lib\ZKTeco;

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
}
