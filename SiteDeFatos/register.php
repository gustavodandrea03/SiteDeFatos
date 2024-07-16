<?php
// register.php

// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitefatos";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter dados do POST
$userName = $_POST['username'];
$userPassword = $_POST['password'];

if (empty($userName) || empty($userPassword)) {
    die("Usuário ou senha vazios.");
}

// Criptografar a senha antes de armazenar
$hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

// Inserir usuário no banco de dados usando prepared statements
$stmt = $conn->prepare("INSERT INTO usuarios (Nome, Senha) VALUES (?, ?)");
$stmt->bind_param("ss", $userName, $hashedPassword);

if ($stmt->execute()) {
    echo "Novo usuário cadastrado com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
