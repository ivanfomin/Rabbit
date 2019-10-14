<?php
include_once __DIR__ . '/../../vendor/autoload.php';



if (isset($_GET['number']) && !empty($_GET['number'])) {
    $number = $_GET['number'];
    $table = 'rabbit_tasks';
    $connection = Db::getInstance();
    $query = 'SELECT message, number, status FROM ' . $table . ' WHERE number=:number';
    $sth = $connection->query($query, [':number' => $number]);
    if ($sth === false) {
        echo 'Запрос не найден!';
    } elseif ($sth['status'] === false) {
        echo 'Ваш запрос обрабатывается...';
    } else {
        echo 'Ваш запрос  ' . $sth['message'] . ' обработан';
    }
}

?>
<br>

<a href="/">На главную</a>

