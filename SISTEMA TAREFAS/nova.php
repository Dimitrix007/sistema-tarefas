<?php
include("conexao.php");
include("layout.php");

if(!isset($_SESSION["usuario_id"])) exit;

if($_POST){
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];

    $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?,?,?)");
    $stmt->execute([$titulo, $descricao, $_SESSION["usuario_id"]]);

    header("Location: index.php");
}
?>

<form method="POST" class="card p-3">
    <h4>Nova Tarefa</h4>

    <input name="titulo" class="form-control mb-2" placeholder="Título" required>
    <textarea name="descricao" class="form-control mb-2"></textarea>

    <button class="btn btn-success">Salvar</button>
</form>

<?php include("footer.php"); ?>