<?php
session_start();

include '../bd_info.php';

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Ошибка: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order'])) {
        $order = explode(",", $_POST['order']);
    }
    $expertID = htmlspecialchars($_POST["expertID"]);
    $id = htmlspecialchars($_POST["id"]);
    $c = 1;
    foreach ($order as &$value) {
        switch ($value) {
            case "skill":
                $resOfRate[0] = $c;
                $c = $c + 1;
                break;
            case "knowlege":
                $resOfRate[1] = $c;
                $c = $c + 1;
                break;
            case "sport":
                $resOfRate[2] = $c;
                $c = $c + 1;
                break;
            case "creativity":
                $resOfRate[3] = $c;
                $c = $c + 1;
                break;
            case "communication":
                $resOfRate[4] = $c;
                $c = $c + 1;
                break;
            case "confidence":
                $resOfRate[5] = $c;
                $c = $c + 1;
                break;
            case "chill":
                $resOfRate[6] = $c;
                $c = $c + 1;
                break;
        }
    }


    $sql = "INSERT INTO `profession_data` (`value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `profid`, `expertID`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssssss", $resOfRate[0], $resOfRate[1], $resOfRate[2], $resOfRate[3], $resOfRate[4], $resOfRate[5], $resOfRate[6], $id, $expertID);
    $stmt->execute();

    $sql = "SELECT `value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `profid` FROM `profession_data` WHERE `profid` = ?";
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $v1 = 0;
        $v2 = 0;
        $v3 = 0;
        $v4 = 0;
        $v5 = 0;
        $v6 = 0;
        $v7 = 0;

        if ($result->num_rows > 0) {
            while ($line = $result->fetch_assoc()) {
                $v1 = $v1 + $line['value1'];
                $v2 = $v2 + $line['value2'];
                $v3 = $v3 + $line['value3'];
                $v4 = $v4 + $line['value4'];
                $v5 = $v5 + $line['value5'];
                $v6 = $v6 + $line['value6'];
                $v7 = $v7 + $line['value7'];
            }
        }

        $sql = "UPDATE `average_rating` SET `value1`= ?, `value2`= ?, `value3`= ?, `value4`= ?, `value5`= ?, `value6`= ?, `value7`= ?  WHERE `profid`= ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iiiiiiii", $v1, $v2, $v3, $v4, $v5, $v6, $v7, $id);
        $stmt->execute();
    } else {
        echo "Ошибка выполнения запроса: " . $connection->error;  // Выводим ошибку, если запрос не удалось подготовить
    }
    header('Location:http://localhost/project667-28-02/PA/EA/expertpanel.php');
}
