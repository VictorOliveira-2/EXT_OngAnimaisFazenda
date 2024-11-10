<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'nome_do_banco';
$username = 'usuario_do_banco';
$password = 'senha_do_banco';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verificar se o token é válido
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM usuarios WHERE reset_token = :token AND reset_token_expiry > NOW()";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $novaSenha = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "UPDATE usuarios SET senha = :senha, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':senha', $novaSenha);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            echo "<p>Senha redefinida com sucesso. <a href='login.html'>Faça login</a>.</p>";
        }
    } else {
        echo "<p>Link de redefinição inválido ou expirado.</p>";
    }
} else {
    echo "<p>Token de redefinição não fornecido.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="recuperar_senha.css">
</head>
<body>

    <div class="page">
        <form method="POST" class="formRedefinirSenha">
            <h1>Redefinir Senha</h1>
            <label for="password">Nova Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite a nova senha" required />
            <input type="submit" value="Redefinir Senha" class="btn" />
        </form>
    </div>
    
</body>
</html>

