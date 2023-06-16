<?php
	session_start();
	include "conexion.inc.php";

	$proceso="P1";

	if($_SESSION["rol"] == 'estudiante'){
		$proceso = "P4";
	}

	if($_SESSION["rol"] == 'kardex'){
		$proceso = "P1";
	}

	$sql="SELECT * FROM flujo 
			WHERE proceso ='".$proceso."' AND rol='".$_SESSION["rol"]."'";

	$resultado = mysqli_query($con, $sql);
	$registros = mysqli_fetch_array($resultado);
	$flujo = $registros["flujo"];
	$proceso = $registros["proceso"];


	$sql = "SELECT COALESCE(max(numerotramite), 0) + 1 AS numerotramite FROM flujousuario";
	$resultado = mysqli_query($con, $sql);
	$registros = mysqli_fetch_array($resultado);
	$numerotramite = $registros["numerotramite"];

	$sql = "INSERT INTO flujousuario(numerotramite, flujo, proceso, fechainicio, fechafin, usuario) VALUES ('".$numerotramite."','".$flujo."','$proceso','".date("Y-m-d h:m:s")."' ";
	$sql .= ",NULL,'".$_SESSION["usuario"]."')";
	$resultado = mysqli_query($con, $sql);
	header("Location: imbox.php");
