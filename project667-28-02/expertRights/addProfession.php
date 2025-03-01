<?php
session_start();

include '../bd_info.php';

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profession_name = htmlspecialchars($_POST["profname"]);
    $descriprion = htmlspecialchars($_POST["description"]);
    $ph_link = htmlspecialchars($_POST["photolink"]);
    $sql = "INSERT INTO `professions` (`profname`, `description`, `photolink`)
        VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $profession_name, $descriprion, $ph_link);
    $stmt->execute();
    header('Location:http://localhost/project667-28-02/PA/EA/expertpanel.php');
}
