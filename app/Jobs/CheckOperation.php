<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jmrashed\Zkteco\Lib\ZKTeco;

class CheckOperation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 10;

    public function __construct(protected string $ip, protected int $port) {}

    public function handle()
    {
        try {
            $zk = new ZKTeco($this->ip, $this->port);
            $zk->connect();

            $zk->disableDevice();
            $zk->enableDevice();

            $zk->disconnect();
        } catch (\Exception $e) {
            \Log::error('Check operation failed: ' . $e->getMessage());
            // If the connection or operation fails, throw the exception to indicate failure
            throw $e;
        }
    }
}
