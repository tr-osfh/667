<?php
session_start();
include '../personalaccauntlogic/getName.php';
include '../personalaccauntlogic/getSurname.php';

include '../bd_info.php';

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data_time = htmlspecialchars($_POST["date_time"]);
    $id = $_SESSION['id'];
    $sql = "INSERT INTO `consultations` (`data_time`, `consultant_id`, `consultant_name`)
        VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $consultant_name = getName() . ' ' . getSurname();
    $stmt->bind_param("sss", $data_time, $id, $consultant_name);
    $stmt->execute();
    header('Location:http://localhost/project667-28-02/PA/CA/consultantpanel.php');
}
