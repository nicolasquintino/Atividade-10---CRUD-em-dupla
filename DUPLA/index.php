<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Professores, Diárias e Aulas</title>
</head>
<body>
    <h1>CRUD - Professores, Diárias e Aulas</h1>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CRUD_dupla";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    if (isset($_POST['create_professor'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $idade = $_POST['idade'];

        $sql = "INSERT INTO professores (nome, email, telefone, idade) VALUES ('$nome', '$email', '$telefone', $idade)";
        if ($conn->query($sql) === TRUE) {
            echo "Professor inserido com sucesso!<br>";
        } else {
            echo "Erro ao inserir professor: " . $conn->error . "<br>";
        }
    }
