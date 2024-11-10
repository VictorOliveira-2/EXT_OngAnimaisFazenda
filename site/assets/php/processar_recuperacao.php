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
    $email = $_POST['email'];

    // Verificar se o e-mail existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Gerar um token único para redefinição de senha
        $token = bin2hex(random_bytes(50));
        
        // Armazenar o token no banco de dados com um tempo de expiração (ex: 1 hora)
        $sql = "UPDATE usuarios SET reset_token = :token, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Criar o link de redefinição de senha
        $resetLink = "https://seusite.com/redefinir_senha.php?token=$token";

        // Enviar o e-mail de recuperação
        $assunto = "Redefinição de Senha";
        $mensagem = "Olá,\n\nClique no link a seguir para redefinir sua senha:\n\n$resetLink\n\nEste link é válido por 1 hora.\n\nSe você não solicitou a redefinição, ignore este e-mail.";
        $headers = "From: noreply@seusite.com";

        if (mail($email, $assunto, $mensagem, $headers)) {
            echo "<p>Um e-mail de recuperação foi enviado para o seu endereço de e-mail.</p>";
        } else {
            echo "<p>Erro ao enviar o e-mail. Tente novamente.</p>";
        }
    } else {
        echo "<p>O e-mail informado não está registrado.</p>";
    }
}
?>
