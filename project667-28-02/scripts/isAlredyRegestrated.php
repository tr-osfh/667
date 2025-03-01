<?php
session_start();

include "isRegistrated.php";

if (!isR()) {
    header('Location:http://localhost/project667-28-02/pages/authorization/authorization.html');
} else {
    header('Location:http://localhost/project667-28-02/pages/pages/authorization/alredyAuthorized.html');
}
