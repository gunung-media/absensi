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

    public function test()
    {
        $this->init();
        $this->zk->testVoice();
        $this->disable();
    }

    public function disable()
    {
        $this->zk->enableDevice();
        $this->zk->disconnect();
    }
}
