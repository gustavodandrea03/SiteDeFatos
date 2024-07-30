<?php
require_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Início</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="functions.js"></script>
</head>
<body>
    <div class="welcome">
        <h1>Bem-vindo</h1>
    </div>
    <div class="form-container">
    <div class="form-wrapper">
            <form id="login-form" onsubmit="event.preventDefault(); login();">

                <h2>Entrar</h2>
                <label for="login-username">Nome de Usuário:</label>
                <input type="text" id="login-username" name="username" required>

                <label for="login-password">Senha:</label>
                <input type="password" id="login-password" name="password" required>

                <input type="submit" class="cad_button" value="Entrar" />
            </form>
        </div>
        <div class="form-wrapper">
            <form id="register-form">

                <h2>Cadastrar Conta</h2>
                
                <label for="register-username">Nome de Usuário:</label>
                <input type="text" id="register-username" name="username" required>

                <label for="register-password">Senha:</label>
                <input type="password" id="register-password" name="password" required>

                <input type="button" onclick="cadUsuario()" class="cad_button" value="Cadastrar Conta" />
            </form>
        </div>
        <div class="form-wrapper">
            <form id="remove-form" onsubmit="event.preventDefault(); removeConta();">
                
                <h2>Remover Conta</h2>

                <label for="remove-username">Nome de Usuário:</label>
                <input type="text" id="remove-username" name="username" required>

                <input type="submit" class="cad_button" value="Remover Conta"/>

            </form>
        </div>
    </div>
</body>
</html>
