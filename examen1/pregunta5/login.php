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

$sql = $pdo->prepare("SELECT * FROM rol WHERE ci=:ci");
$sql->bindParam(':ci', $usuario["ci"]);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
$rol = $sql->fetch();


if (!empty($rol["rol"]) && $rol["rol"] == "DIRECTOR") {
    $sql = "SELECT
	sum(case when departamento='01' then cantidad else 0 end) as CHUQUISACA,
	sum(case when departamento='02' then cantidad else 0 end) as LA_PAZ,
	sum(case when departamento='03' then cantidad else 0 end) as ORURO,
	sum(case when departamento='04' then cantidad else 0 end) as POTOSI
    FROM 
    (
        SELECT departamento, (nota1 + nota2 + nota3 + notafinal)/4 as cantidad
        FROM inscripcion
        INNER JOIN persona ON inscripcion.ci_estudiante = persona.ci
        GROUP BY persona.ci, inscripcion.sigla
    ) as depto;";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $notasRow = $sql->fetch();
    $_SESSION['notasRow'] = $notasRow;
    $_SESSION['rol'] = "DIRECTOR";
}

if (empty($usuario["ci"])) {
    header("Location: login_form.php");
} else {
    $_SESSION['usuario'] = $usuario["usuario"];
    header("Location: index.php");
}

