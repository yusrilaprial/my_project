<?php 
error_reporting(0);
include("connection.php");
$table = "login";
$id_login = $_GET["id_login"];
$email = $_POST["email"];
$password = $_POST["password"];
$level = $_POST["level"];


if ($_GET['act'] == 'insert') {
    $sql = "INSERT INTO `$table` (`email`, 
`password`, 
`level`) 
VALUES ('$email', 
md5('$password'), 
'$level')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data execute successfully"); window.history.go(-1);</script>';
    } else {
        echo '<script>alert("Data error execute"); window.history.go(-1);</script>';
    }
    $conn->close();
} else if ($_GET['act'] == 'update') {
    $sql = "UPDATE `$table` SET `email` = '$email', 
`password` = md5('$password'), 
`level` = '$level' WHERE `id_login` = '$id_login'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data execute successfully"); window.history.go(-1);</script>';
    } else {
        echo '<script>alert("Data error execute"); window.history.go(-1);</script>';
    }
    $conn->close();
} else if ($_GET['act'] == 'show') {
    $sql = "SELECT * FROM `$table`  WHERE `id_login` = '$_POST[id_login]'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_array();
        $sqlfield = $conn->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `table_name` = '$table'");
        while ($field = $sqlfield->fetch_array()) {
            $data["$field[COLUMN_NAME]"] = $row["$field[COLUMN_NAME]"];
        }
        echo json_encode($data);
    }
} else if ($_GET['act'] == 'delete') {
    $sql = "DELETE FROM `$table` WHERE `id_login` = '$id_login'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data execute successfully"); window.history.go(-1);</script>';
    } else {
        echo '<script>alert("Data error execute"); window.history.go(-1);</script>';
    }
    $conn->close();
}
