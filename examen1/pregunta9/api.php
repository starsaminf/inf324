<?php
include "conexion.php";
$pdo = new conexion();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["id"])) {
		$sql = $pdo->prepare("SELECT * FROM persona WHERE ci=:id");
		$sql->bindValue(":ci", $_GET["ci"]);
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		header("HTTP/1.1 200 Tengo datos");
		echo json_encode($sql->fetchAll());
		exit;
	} else {
		$sql = $pdo->prepare("SELECT * FROM persona");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		header("HTTP/1.1 200 Tengo datos");
		echo json_encode($sql->fetchAll());
		exit;
	}
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
	$sql = $pdo->prepare("DELETE FROM persona WHERE ci=:ci");
	$sql->bindValue(":ci", $_GET["ci"]);
	$sql->execute();
	header("HTTP/1.1 200 Eliminado");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
	$data = file_get_contents('php://input');
	$jsonData = json_decode($data);

	$sql = $pdo->prepare("UPDATE persona SET nombre_completo =:nombre, fecha_nacimiento =:fecha_nacimiento, telefono=:telefono, departamento=:departamento WHERE ci=:ci");
	$sql->bindValue(":nombre", $jsonData->nombre_completo);
	$sql->bindValue(":fecha_nacimiento", $jsonData->fecha_nacimiento);
	$sql->bindValue(":telefono", $jsonData->telefono);
	$sql->bindValue(":departamento", $jsonData->departamento);

	$sql->bindValue(":ci", $_GET["ci"]);

	$sql->execute();
	header("HTTP/1.1 200 actualizado");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$data = file_get_contents('php://input');
	$jsonData = json_decode($data);

	$qry = sprintf("INSERT INTO persona VALUES ('%s', '%s', '%s', '%s', '%s')", $jsonData->ci, $jsonData->nombre_completo, $jsonData->fecha_nacimiento, $jsonData->telefono, $jsonData->departamento);
	$sql = $pdo->prepare($qry);
	$sql->execute();
	header("HTTP/1.1 200 INSERT");
	exit;
}
