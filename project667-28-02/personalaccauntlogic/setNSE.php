<?php
session_start();
include '../bd_info.php';

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    if ($name != "") {
        $id = $_SESSION['id'];
        $sql = "UPDATE `user_data` SET `name`= ? WHERE `user_id`=  $id";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }

    $surname = htmlspecialchars($_POST["surname"]);

    if ($surname != "") {
        $id = $_SESSION['id'];
        $sql = "UPDATE user_data SET surname = ? WHERE user_id = $id";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $surname);
        $stmt->execute();
    }

    $email = htmlspecialchars($_POST["email"]);
    if ($email != "") {
        $id = $_SESSION['id'];
        $sql = "UPDATE user_data SET email = ? WHERE user_id = $id";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    }
}

header("Location: /redirectPages/goPA.php");
exit;
