<?php
$server="localhost";
$fatoDb="root";
$passDb="";
$database="sitefatos";
$connect=mysqli_connect($server,$fatoDb,$passDb,$database);

if ($connect->connect_error) {
    die("Conexão falhou: " . $connect->connect_error);
}


function selectDados($conn, $tabela) {
    $sql = "SELECT * FROM " . $tabela;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}


?>
