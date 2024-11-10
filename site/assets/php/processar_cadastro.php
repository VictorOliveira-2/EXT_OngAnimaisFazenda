<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'nome_do_banco';
$username = 'usuario_do_banco';
$password = 'senha_do_banco';

try {
    // Conectar ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados do formulário
    $primeiroNome = $_POST['firstname'];
    $sobrenome = $_POST['lastname'];
    $email = $_POST['email'];
    $telefone = $_POST['number'];
    $senha = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografa a senha
    $genero = $_POST['gender'];

    // Inserir dados na tabela de usuários
    $sql = "INSERT INTO usuarios (primeiro_nome, sobrenome, email, telefone, senha, genero) 
            VALUES (:primeiro_nome, :sobrenome, :email, :telefone, :senha, :genero)";
    $stmt = $pdo->prepare($sql);

    // Associar parâmetros
    $stmt->bindParam(':primeiro_nome', $primeiroNome);
    $stmt->bindParam(':sobrenome', $sobrenome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':genero', $genero);

    // Executar a consulta e verificar se foi bem-sucedida
    if ($stmt->execute()) {
        echo "<p>Cadastro realizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao realizar o cadastro. Tente novamente.</p>";
    }
}
?>
