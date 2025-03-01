<?php
session_start();
include '../personalaccauntlogic/getName.php';
include '../personalaccauntlogic/getSurname.php';
include '../personalaccauntlogic/getEmail.php';

include '../bd_info.php';

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consultation_id = htmlspecialchars($_POST["consultation_id"]);
    $id = $_SESSION['id'];

    $sql = "UPDATE `consultations` SET `user_id` = ?, `user_name` = ?, `user_email` = ?, `active` = 1 WHERE `id` = ?";
    $stmt = $connection->prepare($sql);

    $user_name = getName() . ' ' . getSurname();
    $email = getEmail();

    $stmt->bind_param("ssss", $id, $user_name, $email, $consultation_id);

    if ($stmt->execute()) {
        header('Location: http://localhost/project667-28-02/pages/consultationForm.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
