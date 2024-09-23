<!DOCTYPE html>
<html lang="en">
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
    $dbname = "crud_dupla";

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn -> connect_error){
        die("Falha na conexão: " . $conn -> connect_error);
    }

    if(isset($_POST['create'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $idade = $_POST['idade'];

        $sql = "INSERT INTO professor ( nome, email, telefone, idade) 
        VALUES ( '$nome', '$email', '$telefone', '$idade')";

        if($conn -> query($sql) === TRUE){
            echo "Novo pedido feito com sucesso!";
        }else{
            echo "Erro:". $sql."<br>".$conn->error;
        }

    }

    if (isset($_POST['update_professor'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $idade = $_POST['idade'];

        $sql = "UPDATE professores SET nome='$nome', email='$email', telefone='$telefone', idade=$idade WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Professor atualizado com sucesso!<br>";
        } else {
            echo "Erro ao atualizar professor: " . $conn->error . "<br>";
        }
    }

    if (isset($_POST['delete_professor'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM professores WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Professor deletado com sucesso!<br>";
        } else {
            echo "Erro ao deletar professor: " . $conn->error . "<br>";
        }
    }

    if (isset($_POST['diária'])) {
        $horaAula = $_POST['horaAula'];
        $valor = $_POST['valor'];
        $dataAULA = $_POST['dataAULA'];
        $professor_id = $_POST['professor_id'];

        $sql = "INSERT INTO diaria (horaAula, valor, dataAULA, professor_id) VALUES ('$horaAula', $valor, '$dataAULA', $professor_id)";
        if ($conn->query($sql) === TRUE) {
            echo "Diária inserida com sucesso!<br>";
        } else {
            echo "Erro ao inserir diária: " . $conn->error . "<br>";
        }
    }

    if (isset($_POST['sala'])) {
        $sala = $_POST['sala'];
        $horarioInicio = $_POST['horarioInicio'];
        $horarioFim = $_POST['horarioFim'];
        $professor_id = $_POST['professor_id'];

        $sql = "INSERT INTO aulas (sala, horarioInicio, horarioFim, professor_id) VALUES ('$sala', '$horarioInicio', '$horarioFim', $professor_id)";
        if ($conn->query($sql) === TRUE) {
            echo "Aula inserida com sucesso!<br>";
        } else {
            echo "Erro ao inserir aula: " . $conn->error . "<br>";
        }

    }
    
    echo "<h2>Lista de Professores</h2>";
    $sql = "SELECT * FROM professores";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . " - Email: " . $row["email"] . "<br>";
        }
    } else {
        echo "Nenhum professor encontrado.<br>";
    }

    // Listar Diárias
    echo "<h2>Lista de Diárias</h2>";
    $sql = "SELECT * FROM diaria";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id_id"] . " - Hora Aula: " . $row["horaAula"] . " - Valor: " . $row["valor"] . "<br>";
        }
    } else {
        echo "Nenhuma diária encontrada.<br>";
    }

    // Listar Aulas
    echo "<h2>Lista de Aulas</h2>";
    $sql = "SELECT * FROM aulas";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Sala: " . $row["sala"] . " - Início: " . $row["horarioInicio"] . " - Fim: " . $row["horarioFim"] . "<br>";
        }
    } else {
        echo "Nenhuma aula encontrada.<br>";
    }
    ?>

    <!-- Formulário para Inserir Professor -->
    <h2>Inserir Professor</h2>
    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email"><br>
        Telefone: <input type="text" name="telefone"><br>
        Idade: <input type="number" name="idade" required><br>
        <input type="submit" name="create_professor" value="Inserir Professor">
    </form>

    <!-- Formulário para Atualizar Professor -->
    <h2>Atualizar Professor</h2>
    <form method="post">
        ID: <input type="number" name="id" required><br>
        Nome: <input type="text" name="nome"><br>
        Email: <input type="email" name="email"><br>
        Telefone: <input type="text" name="telefone"><br
