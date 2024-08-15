<?php

namespace App\Console\Commands;

use App\Services\LogService;
use App\Services\RabbitMQService;
use Illuminate\Console\Command;

class ConsumeLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consume:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume logs from RabbitMQ';

    public function __construct(
        protected readonly LogService $logService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rabbitMQService = new RabbitMQService();
        $rabbitMQService->consume('logs', function ($msg) {
            $data = json_decode($msg->body, true);

            if (empty($data['service_name'])) {
                $this->error('Service name is required.');
                return;
            }

            $this->logService->create($data);
        });
    }
}
