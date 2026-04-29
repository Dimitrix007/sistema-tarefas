<?php
include("conexao.php");
session_start();

if(!isset($_SESSION["usuario_id"])) exit;

$id = $_GET["id"];

$stmt = $pdo->prepare("DELETE FROM tarefas WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");