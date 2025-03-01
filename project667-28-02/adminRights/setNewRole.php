<?php

include '../bd_info.php';

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_POST["userid"]);
    $role = htmlspecialchars($_POST["role"]);
    if ($role == "user" || $role == "admin" || $role == "consultant" || $role == "expert") {
        $sql = "UPDATE `users` SET `role`= ? WHERE `id`=  $id";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $role);
        $stmt->execute();
        header('Location:http://localhost/project667-28-02/PA/AA/adminpanel.php');
    } else {
        header('Refresh: 3;http://localhost/project667-28-02/PA/AA/adminpanel.php');
        echo "такой роли или пользователя не существует";
    }
}