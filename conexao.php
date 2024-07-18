<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sitefatos';

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

function selectDados($connect, $table) {
    $sql = "SELECT * FROM $table";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return [];
    }
}
?>
