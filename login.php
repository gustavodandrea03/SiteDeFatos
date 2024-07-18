<?php
require_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $connect->real_escape_string($_POST['username']);
    $password = $connect->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM usuarios WHERE Nome='$username'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Senha'])) {
            echo "Login bem-sucedido";
            header( 'Location: fatos.php' ) ;
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "Usuário não encontrado";
    }

    $connect->close();
}
?>
