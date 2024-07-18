<?php
require_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $connect->real_escape_string($_POST['username']);
    $password = password_hash($connect->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (Nome, Senha) VALUES ('$username', '$password')";

    if ($connect->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso";
    } else {
        echo "Erro ao cadastrar usuário: " . $connect->error;
    }

    $connect->close();
}
?>
