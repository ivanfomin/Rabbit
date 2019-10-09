<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Db.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('task_queue', false, true, false, false);
echo " [*] Waiting for messages. To exit press CTRL+C\n";
$callback = function ($msg) {
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    $sleep_rand = rand(5, 60);
    sleep($sleep_rand);
    $parts = explode(' ', trim($msg->body));
    echo " [x] Done\n";
    $table = 'rabbit_tasks';
    $query = 'INSERT INTO ' . $table . ' VALUES (DEFAULT, :number, :message)';
    $connection = Db::getInstance();
    $number = array_shift($parts);
    $sth = $connection->execute($query, [':number' => $number, ':message' => implode(' ', $parts)]);
};
$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);
while ($channel->is_consuming()) {
    $channel->wait();
}
$channel->close();
$connection->close();

