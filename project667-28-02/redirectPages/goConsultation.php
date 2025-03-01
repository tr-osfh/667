<?php
session_start();

include "../scripts/isRegistrated.php";

if (isR()) {
    header('Location:http://localhost/project667-28-02/pages/consultationForm.php');
} else {
    header('Location:http://localhost/project667-28-02/redirectPages/notRegistred.html');
}
