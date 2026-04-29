<?php
include("conexao.php");
session_start();

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario=? AND senha=?");
    $stmt->execute([$usuario, $senha]);

    if($stmt->rowCount() > 0){
        $user = $stmt->fetch();
        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];

        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<form method="POST" class="card p-4" style="width:300px;">
    <h4>Login</h4>

    <?php if($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <input name="usuario" class="form-control mb-2" placeholder="Usuário">
    <input type="password" name="senha" class="form-control mb-2" placeholder="Senha">

    <button class="btn btn-primary">Entrar</button>
</form>

</body>
</html>