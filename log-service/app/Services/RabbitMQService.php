<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', 'guest')
        );
        $this->channel = $this->connection->channel();
    }

    /**
     * Publish a message to a RabbitMQ queue.
     *
     * @param string $queueName
     * @param array $data
     */
    public function publishToQueue(string $queueName, array $data)
    {
        $this->channel->queue_declare($queueName, false, false, false, false);

        $message = new AMQPMessage(json_encode($data));
        $this->channel->basic_publish($message, '', $queueName);
    }

    /**
     * Consume messages from a RabbitMQ queue.
     *
     * @param string $queueName
     * @param callable $callback
     */
    public function consume(string $queueName, callable $callback)
    {
        $this->channel->queue_declare($queueName, false, false, false, false);

        $this->channel->basic_consume($queueName, '', false, true, false, false, $callback);

        $this->channel->wait(null, false, 5);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
