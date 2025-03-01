<?php
session_start();
include '../bd_info.php';
$connection = new mysqli($servername, $username, $password, $db);
if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}

$sql = "SELECT `profname` FROM `profession_data` WHERE `expertID` = ? AND `profid` = ?";

if ($stmt = $connection->prepare($sql)) {
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../redirectPages/alreadyRated.html");
    }
}
