<?php

function getSurname()
{
    include '../bd_info.php';

    $connection = new mysqli($servername, $username, $password, $db);

    if ($connection->connect_error) {
        die("Ошибка: " . $connection->connect_error);
    }

    $id = $_SESSION['id'];
    $sql = "SELECT surname FROM user_data WHERE user_id = $id";
    $res = $connection->query($sql)->fetch_assoc()['surname'];
    return $res;
}
