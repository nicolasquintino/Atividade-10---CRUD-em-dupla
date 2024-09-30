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
    $dbname = "crud_dupla";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM professores";
    $result = $conn->query($sql);

    if (isset($_POST['create_professores'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $idade = $_POST['idade'];

        $sql = "INSERT INTO professores (nome, email, telefone, idade) 
                VALUES ('$nome', '$email', '$telefone', '$idade')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo professor registrado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['update_professores'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $idade = $_POST['idade'];

        $sql = "UPDATE professores SET";
    
        if (!empty($nome)) {
            $sql .= " nome='$nome',";
        }
        if (!empty($email)) {
            $sql .= " email='$email',";
        }
        if (!empty($telefone)) {
            $sql .= " telefone='$telefone',";
        }
        if (!empty($idade)) {
            $sql .= " idade=$idade,";
        }
    
        $sql = rtrim($sql, ',');
  
        $sql .= " WHERE id=$id";
    
        if ($conn->query($sql) === TRUE) {
            echo "Professor atualizado com sucesso!<br>";
        } else {
            echo "Erro ao atualizar professor: " . $conn->error . "<br>";
        }
    }
  
    
    if (isset($_POST['delete_professores'])) {
        $id = $_POST['id'];
        
        // Verifica se o ID foi preenchido e é numérico
        if (!empty($id) && is_numeric($id)) {
            $sql = "DELETE FROM professores WHERE id = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo "Professor deletado com sucesso!<br>";
            } else {
                echo "Erro ao deletar professor: " . $conn->error . "<br>";
            }
        } else {
            echo "ID inválido para exclusão.<br>";
        }
    }
    
    

    if (isset($_POST['diaria'])) {
        $horaAula = $_POST['horaAula'];
        $valor = $_POST['valor'];
        $dataAula = $_POST['dataAula'];
        $professores_id = $_POST['professores_id'];

        $sql = "INSERT INTO diaria (horaAula, valor, dataAula, professores_id) 
                VALUES ('$horaAula', '$valor', '$dataAula', '$professores_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo diaria registrada com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['sala'])) {
        $sala = $_POST['sala'];
        $horarioInicio = $_POST['horarioInicio'];
        $horarioFim = $_POST['horarioFim'];
        $professores_id = $_POST['professores_id'];

        $sql = "INSERT INTO aulas (sala, horarioInicio, horarioFim, professores_id) 
                VALUES ('$sala', '$horarioInicio', '$horarioFim', $professores_id)";
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

    $conn->close();
    ?>

    <h2>Inserir Professor</h2>
    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email"><br>
        Telefone: <input type="text" name="telefone"><br>
        Idade: <input type="number" name="idade" required><br>
        <input type="submit" name="create_professores" value="Inserir Professor">
    </form>

    <h2>Atualizar Professor</h2>
    <form method="post">
        ID: <input type="number" name="id" required><br>
        Nome: <input type="text" name="nome"><br>
        Email: <input type="email" name="email"><br>
        Telefone: <input type="text" name="telefone"><br>
        <input type="submit" name="update_professores" value="Atualizar Professor">
    </form>

    <h2>Deletar Professor</h2>
    <form method="post">
        ID: <input type="number" name="id" required><br>
        <input type="submit" name="delete_professores" value="Deletar Professor">
    </form>
</body>
</html>
