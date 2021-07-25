<?php

namespace App\Jobs;

use App\Services\ServiceGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $serviceGateway;
    private $data;
    public function __construct($data, ServiceGateway $serviceGateway)
    {
        $this->serviceGateway = $serviceGateway;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->serviceGateway->messageService->createMessage($this->data);
    }
}
