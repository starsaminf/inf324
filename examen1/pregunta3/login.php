<?php
session_start();
include "./includes/conexion.php";

if (isset($_POST["usuario"]) && isset($_POST["password"])) {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
} else {
    header("Location: login_form.php");
    die();
}

$pdo = new conexion();
$sql = $pdo->prepare("SELECT * FROM usuario WHERE usuario=:usuario AND password=:pass");
$sql->bindParam(':usuario', $usuario);
$sql->bindParam(':pass', $password);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);

$usuario = $sql->fetch();

if (empty($usuario["ci"])) {
    header("Location: login_form.php");
} else {
    $_SESSION['usuario'] = $usuario["usuario"];
    header("Location: index.php");
}

