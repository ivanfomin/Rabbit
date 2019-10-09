<?php
require_once __DIR__ . '/Db.php';
require_once __DIR__ . '/rabbit_producer.php';


if (isset($_POST['message']) && !empty($_POST['message'])) {
    $table = 'rabbit_tasks';
    $connection = Db::getInstance();
    do {
        $number = rand(0, 1000);
        $query = 'SELECT number FROM ' . $table . ' WHERE number=:number';
        $sth = $connection->query($query, [':number' => $number]);
    } while ($sth['number'] == $number);

    sendTask([$number, $_POST['message']]);

    include __DIR__ . '/link.php';
}