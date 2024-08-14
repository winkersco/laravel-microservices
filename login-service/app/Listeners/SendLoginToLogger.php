<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Services\RabbitMQService;

class SendLoginToLogger
{
    public function __construct(
        protected readonly RabbitMQService $rabbitMQService
    ) {}

    /**
     * Handle the event.
     *
     * @param UserLoggedIn $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        // Prepare the data to send to the logger service
        $data = [
            'key' => 'login',
            'data' => $event->user->mobile,
            'datetime' => $event->loginAt,
        ];

        // Send the data to the RabbitMQ queue
        $this->rabbitMQService->publishToQueue('login_logs', $data);
    }
}
