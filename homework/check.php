<?php
require_once __DIR__ . '/Db.php';

if (isset($_GET['number']) && !empty($_GET['number'])) {
    $number = $_GET['number'];
    $table = 'rabbit_tasks';
    $connection = Db::getInstance();
    $query = 'SELECT message, number FROM ' . $table . ' WHERE number=:number';
    $sth = $connection->query($query, [':number' => $number]);
    if ($sth === false) {
        echo 'Ваш запрос обрабатывается...';
    }
    else {
        echo 'Ваш запрос  ' . $sth['message'] . ' обработан';
    }
}
