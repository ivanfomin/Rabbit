<?php

include_once __DIR__ . '/../../vendor/autoload.php';

use App\Db;

if (isset($_POST['number']) && !empty($_POST['number']) && isset($_POST['message']) && !empty($_POST['message'])) {
    $table = 'rabbit_tasks';
    $connection = Db::getInstance();

    $query = 'SELECT * FROM ' . $table . ' WHERE number=:number';
    $sth = $connection->query($query, [':number' => $_POST['number']]);

    if ($sth === false) {
        echo 'Нет такого задания!';
    } else {
        $query = 'UPDATE ' . $table . ' SET message=:message  WHERE number=:number';
        $sth = $connection->query($query, [':message' => $_POST['message'], ':number' => $_POST['number']]);
        echo 'Задание обновлено!';
    }

}

?>

<br>

<a href="/">На главную</a>
