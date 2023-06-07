<?php 
$usuario = $_GET["usuario"];
$password = $_GET["password"];

session_start();

include "conexion.inc.php";

$sql="SELECT count(*) AS contador, rol FROM academica2.usuario ";
$sql.="where nombre='$usuario' GROUP BY nombre";
$resultado=mysqli_query($con, $sql);
$registros=mysqli_fetch_array($resultado);
$contador=$registros["contador"];

if (($contador>0) && ($password=='123456'))
{
	$_SESSION["usuario"] = $usuario;
	$_SESSION["rol"] = $registros["rol"];
	header("Location: imbox.php");
} 
else {
	header("Location: index.php");
}
