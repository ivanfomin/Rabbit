<?php
include_once __DIR__ . '/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Producer
{

    public static function sendTask($data)
    {
        $data = implode(' ', $data);
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('task_queue', false, true, false, false);
        $msg = new AMQPMessage(
            $data,
            ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
        );
        $channel->basic_publish($msg, '', 'task_queue');
        $channel->close();
        $connection->close();
    }
}