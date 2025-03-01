<?php
session_start();

include "../scripts/isRegistrated.php";

if (isR()) {
    $role = $_SESSION['role'];
    switch ($role) {
        case "user":
            header('Location:http://localhost/project667-28-02/PA/UA/personalaccaunt.php');
            break;
        case "admin":
            header('Location:http://localhost/project667-28-02/PA/AA/adminaccaunt.php');
            break;
        case "expert":
            header('Location:http://localhost/project667-28-02/PA/EA/expertaccaunt.php');
            break;
        case "consultant":
            header('Location:http://localhost/project667-28-02/PA/CA/consultantaccaunt.php');
            break;
        default:
            header('Location:http://localhost/project667-28-02/index.php');
    }
} else {
    header('Location:http://localhost/project667-28-02/redirectPages/notRegistred.html');
}
