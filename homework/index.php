<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>
<p>Отправить задание в очередь</p>
<form method="post" action="actions/send.php ">
    <input type="text" name="message"><br>
    <input type="hidden" name="number" value="<?php echo $number; ?>"><br>
    <button id="send" type="submit">Отправить</button>
</form>

<hr>

<p>Найти задание по его номеру</p>
<form action="actions/check.php" method="get">
    <input type="number" name="number"><br><br>
    <button type="submit">Найти</button>
</form>
<hr>

<p>Обновить задание по его номеру</p>
<form action="actions/update.php" method="post">
    Номер задание
    <input type="number" name="number"><br>
    <br>
    Новое текст задания
    <input type="text" name="message"><br>
    <br>
    <button type="submit">Изменить</button>
</form>
<hr>


<p>Удалить задание по номеру</p>
<form method="post" action="actions/delete.php">
    <input type="number" name="number"><br><br>
    <button type="submit">Удалить</button>
</form>


</body>
</html>