<?php
include "conexion.inc.php";
session_start();
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];

$pantalla = $_GET["pantalla"];
$tramite = $_SESSION["codtramite"];
$usuario = $_SESSION["usuario"];

if (empty($proceso)) {
    echo "Su flujo termino";
    exit();
}

$condi = "SELECT * FROM flujo ";
$condi .= "WHERE flujo='$flujo' and proceso='$proceso' ";
$result = mysqli_query($con, $condi);
$regist = mysqli_fetch_array($result);
$tipo = $regist["tipo"];
$procesoSiguiente = $regist["procesosiguiente"];

$rol = $regist["rol"];
$ps="";

// condicional
if ($tipo == 'C') {

    $sql="SELECT * FROM flujocondicional ";
    $sql.="WHERE codFlujo='$flujo' and codProceso='$proceso'";
    $resultado = mysqli_query($con, $sql);
    $registros = mysqli_fetch_array($resultado);

    $procesoSi = $registros["codProcesoSi"];
    $procesoNo = $registros["codProcesoNo"];

    $random = rand(0, 1);
    if ($random == 1) {
        $procesoSiguiente = $procesoSi;
    } else {
        $procesoSiguiente = $procesoNo;
    }
} else {
    if (isset($_GET["Anterior"]))
    {
        $sql="SELECT * FROM flujo ";
        $sql.="WHERE flujo='$flujo' and procesosiguiente='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["proceso"];
    }

    if (isset($_GET["Siguiente"])) {

        $fecha_fin = date("Y-m-d h:m:s");
        $sql = "UPDATE flujousuario SET fechafin = '$fecha_fin' 
        WHERE numerotramite = '$tramite' AND proceso = '$proceso'";
        $resultado = mysqli_query($con, $sql);

        $sql = "SELECT COALESCE(max(numerotramite), 0) + 1 AS numerotramite FROM flujousuario";
	    $resultado = mysqli_query($con, $sql);
	    $registros = mysqli_fetch_array($resultado);
	    $numerotramite = $registros["numerotramite"];
        
        if (!empty($procesoSiguiente)) {
            $fecha_fin = "NULL";
            $sql = "INSERT INTO flujousuario(numerotramite, flujo, proceso, fechainicio, fechafin, usuario)
                     VALUES ('".$numerotramite."','".$flujo."','$procesoSiguiente','".date("Y-m-d h:m:s")."' ";
            $sql .= ",NULL,'".$_SESSION["usuario"]."')";
            $resultado = mysqli_query($con, $sql);
        }
            //inserta la inscripcion en todos los usuarios
        if ($flujo == "F1" && $proceso == "P2") {
            $sql = "SELECT * FROM academica2.usuario WHERE rol = 'estudiante';";
    	    $resultado = mysqli_query($con, $sql);
			while ($usuario = mysqli_fetch_assoc($resultado)) {
                $sql = "SELECT COALESCE(max(numerotramite), 0) + 1 AS numerotramite FROM flujousuario";
                $resultado2 = mysqli_query($con, $sql);
                $registros = mysqli_fetch_array($resultado2);
                $numerotramite = $registros["numerotramite"];
                
                $fecha_fin = date('Y-m-d', strtotime('+1 hour'));
                $fecha_fin = 'NULL';
                $flujo = "F1";
                $proceso = "P4";
                $sql = "INSERT INTO flujousuario(numerotramite, flujo, proceso, fechainicio, fechafin, usuario)
                        VALUES ('".$numerotramite."','".$flujo."','$proceso','".date("Y-m-d h:m:s")."' ";
                $sql .= ",NULL,'".$usuario["nombre"]."')";
                mysqli_query($con, $sql);
            }
        }
    }
}
header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");

