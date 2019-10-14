<?php

include_once __DIR__ . '/../../vendor/autoload.php';

use App\Db;

if (isset($_POST['number']) && !empty($_POST['number'])) {
    $table = 'rabbit_tasks';
    $connection = Db::getInstance();

    $query = 'DELETE FROM ' . $table . ' WHERE number=:number';
    $sth = $connection->query($query, [':number' => $_POST['number']]);

    if ($sth === false) {
        echo 'Нет такого задания!';
    } else {
        echo 'Задание удалено.';
    }


}

?>

<br>

<a href="/">На главную</a>
