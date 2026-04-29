<?php
include("conexao.php");
session_start();

if(!isset($_SESSION["usuario_id"])) exit;

$id = $_GET["id"];

$stmt = $pdo->prepare("UPDATE tarefas SET status='concluida' WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");