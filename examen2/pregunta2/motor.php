<?php
include "conexion.inc.php";
session_start();
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];

$pantalla = $_GET["pantalla"];
$tramite = $_SESSION["codtramite"];
$uuu = $_SESSION["usuario"];

$condi = "SELECT tipo FROM flujo ";
$condi .= "WHERE flujo='$flujo' and proceso='$proceso' ";
$result = mysqli_query($con, $condi);
$regist = mysqli_fetch_array($result);
$tipo = $regist["tipo"];
$ps="";
if ($tipo == 'C') {
    if (isset($_GET["Siguiente"])) {
        if (isset($_GET["Si"])) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and codProceso='$proceso'";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProcesoSi"];
        }
        if (isset($_GET["No"])) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and codProceso='$proceso'";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProcesoNo"];
        }

        $today = getdate();
	    $fecha_fin = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	    $sql = "UPDATE flujousuario SET fechafin='$fecha_fin' WHERE numerotramite='$tramite' and proceso='$proceso'";
	    $resultado = mysqli_query($con, $sql);
    }

    if (isset($_GET["Anterior"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and procesosiguiente='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["proceso"];
        if ($procesoSiguiente == null) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and (codProcesoSi='$proceso' or codProcesoNo='$proceso') ";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProceso"];
        }
    }
} else {
    if (isset($_GET["Anterior"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and procesosiguiente='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["proceso"];
        if ($procesoSiguiente == null) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and (codProcesoSi='$proceso' or codProcesoNo='$proceso') ";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProceso"];
        }if($proceso=="P1" || $proceso=="P4" || $proceso=="P6" || $proceso=="P11" || $proceso=="P9" ){
			$procesoSiguiente = $proceso;
        }
    }
    if (isset($_GET["Siguiente"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and proceso='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["procesosiguiente"];
        if($procesoSiguiente == null && $registros["proceso"]== "P12"){
		    $sql2 = "SELECT d.codMateria, c.nombre ,d.Paralelo, d.horario FROM academica2.materia c INNER JOIN
		    		(SELECT a.codMateria, a.Paralelo, a.horario FROM academica2.paralelo a INNER JOIN
					(SELECT codMateria, paralelo FROM wf.estudiantekardex WHERE codTramite='$tramite' LIMIT 1) b ON a.codMateria=b.codMateria and a.Paralelo=b.paralelo) d ON c.codMateria=d.codMateria";
		    $resultado2 = mysqli_query($con, $sql2);
		    $registros2 = mysqli_fetch_array($resultado2);

		    $sql3 = "DELETE FROM wf.estudiantekardex WHERE codTramite = '$tramite' AND codMateria = '" . $registros2["codMateria"] . "' AND paralelo = '" . $registros2["Paralelo"] . "'";
		    $resultado3 = mysqli_query($con, $sql3);
		    header("Location: fin.php");
        	exit;

        }
        //actualizar flujo
        $today = getdate();
	    $fecha_fin = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	    $sql = "UPDATE flujousuario SET fechafin='$fecha_fin' WHERE numerotramite='$tramite' and proceso='$proceso' AND fechafin IS NULL LIMIT 1";
	    $resultado = mysqli_query($con, $sql);
    }

    if($procesoSiguiente == "P9"){
        	//Debemos enviar la lista de materias inscritas al estudiante
        	//creamos flujo para estudiante las materias inscritas ya estaran en estudiantekardex
        	$sql1 = "SELECT usuario FROM estudiantekardex WHERE codTramite='$tramite' LIMIT 1";
		    $resultado1 = mysqli_query($con, $sql1);
		    $registros1 = mysqli_fetch_array($resultado1);
		    $usuario = $registros1["usuario"];

		    $flujo = "F1";
		    $proceso = "P9";

		    $today = getdate();
		    $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
		    $fecha_fin = "NULL";

		    $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
		    $sql .= $fecha_fin . ",'" . $usuario . "')";
		    $resultado = mysqli_query($con, $sql);

 			header("Location: bandejaE.php");
 			exit;
        }        
    }  

    header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");
    
}

?>
