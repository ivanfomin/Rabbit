<?php

include_once __DIR__ . '/../../vendor/autoload.php';

use App\Db;
use App\Producer;

if (isset($_POST['message']) && !empty($_POST['message'])) {
    $table = 'rabbit_tasks';
    $connection = Db::getInstance();
    do {
        $number = rand(0, 1000);
        $query = 'SELECT number FROM ' . $table . ' WHERE number=:number';
        $sth = $connection->query($query, [':number' => $number]);
    } while ($sth['number'] == $number);

    Producer::sendTask([$number, $_POST['message']]);

    echo 'Your number is ' . $number;

    echo '<p><a href="/actions/check.php?number=' . $number . '">Проверить</a></p>';


}