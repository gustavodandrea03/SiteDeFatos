<?php
require_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="welcome">
        <h1>Bem-vindo, <span id="user-name"></span></h1>
    </div>
    <div class="form-container">
        <div class="form-wrapper">
            <form id="login-form" action="login.php" method="POST">
                <h2>Entrar</h2>
                <label for="login-username">Nome de Usuário:</label>
                <input type="text" id="login-username" name="username" required>
                <label for="login-password">Senha:</label>
                <input type="password" id="login-password" name="password" required>
                <button type="submit">Entrar</button>
            </form>
        </div>
        <div class="form-wrapper">
            <form id="register-form" action="cadastrar.php" method="POST">
                <h2>Cadastrar Conta</h2>
                <label for="register-username">Nome de Usuário:</label>
                <input type="text" id="register-username" name="username" required>
                <label for="register-password">Senha:</label>
                <input type="password" id="register-password" name="password" required>
                <button type="submit" class="cad_button">Cadastrar Conta</button>
            </form>
        </div>
        <div class="form-wrapper">
            <form id="remove-form" action="logoff.php" method="POST">
                <h2>Remover Conta</h2>
                <label for="remove-username">Nome de Usuário:</label>
                <input type="text" id="remove-username" name="username" required>
                <button type="submit" class="remove-button">Remover Conta</button>
            </form>
        </div>
    </div>
    <div class="container">
  
    </div>
</body>
</html>
