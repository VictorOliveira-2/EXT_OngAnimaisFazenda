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
    $email = $_POST['email'];
    $senha = $_POST['password'];

    // Consultar o banco de dados para verificar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Login bem-sucedido - redirecionar para a página inicial ou dashboard
        header("Location: dashboard.html");
        exit;
    } else {
        // Login falhou - mensagem de erro
        echo "<p>Email ou senha incorretos.</p>";
    }
}
?>
