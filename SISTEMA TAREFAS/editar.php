<?php
include("conexao.php");
include("layout.php");

if(!isset($_SESSION["usuario_id"])) exit;

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id=?");
$stmt->execute([$id]);
$tarefa = $stmt->fetch();

if($_POST){
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status = $_POST["status"];

    $stmt = $pdo->prepare("UPDATE tarefas SET titulo=?, descricao=?, status=? WHERE id=?");
    $stmt->execute([$titulo, $descricao, $status, $id]);

    header("Location: index.php");
}
?>

<form method="POST" class="card p-3">
    <h4>Editar</h4>

    <input name="titulo" value="<?= $tarefa["titulo"] ?>" class="form-control mb-2">
    <textarea name="descricao" class="form-control mb-2"><?= $tarefa["descricao"] ?></textarea>

    <select name="status" class="form-control mb-2">
        <option <?= $tarefa["status"]=="pendente"?"selected":"" ?>>pendente</option>
        <option <?= $tarefa["status"]=="concluida"?"selected":"" ?>>concluida</option>
    </select>

    <button class="btn btn-primary">Atualizar</button>
</form>

<?php include("footer.php"); ?>