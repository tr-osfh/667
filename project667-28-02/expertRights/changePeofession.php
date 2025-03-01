<?php
session_start();

include '../bd_info.php';

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_POST["id"]);
    $profession_name = htmlspecialchars($_POST["profname"]);
    $descriprion = htmlspecialchars($_POST["description"]);
    $ph_link = htmlspecialchars($_POST["photolink"]);

    $sql = "UPDATE `professions` SET `profname`= ?, `description`= ?, `photolink`= ? WHERE `id`= ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssi", $profession_name, $descriprion, $ph_link, $id);
    $stmt->execute();
    header('Location:http://localhost/project667-28-02/PA/EA/expertpanel.php');
}
