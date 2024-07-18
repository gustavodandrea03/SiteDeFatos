<?php
require_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $connect->real_escape_string($_POST['username']);

    $sql = "DELETE FROM usuarios WHERE Nome='$username'";

    if ($connect->query($sql) === TRUE) {
        echo "Usuário removido com sucesso";
    } else {
        echo "Erro ao remover usuário: " . $connect->error;
    }

    $connect->close();
}
?>
