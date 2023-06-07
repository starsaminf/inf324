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

// condicional?
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
        //completar el flujo usuario
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

    if ($procesoSiguiente == 'P6' && !isset($_GET["Anterior"])) {
	    /* Condicional de kardex a estudiante */
	    /* Escribir en bandeja de entrada de estudiante */

	    /* Hallar al estudiante al cual mandar */
	    $sql1 = "SELECT usuario FROM estudiantekardex WHERE codTramite='$tramite' LIMIT 1";
	    $resultado1 = mysqli_query($con, $sql1);
	    $registros1 = mysqli_fetch_array($resultado1);
	    $usuario = $registros1["usuario"];

	    $flujo = "F1";
	    $proceso = "P6";
	    /*$sql1 = "SELECT max(numerotramite) tramite FROM flujousuario";
	    $resultado1 = mysqli_query($con, $sql1);
	    $registros1 = mysqli_fetch_array($resultado1);
	    $tramite = $registros1["tramite"];*/

	    $today = getdate();
	    $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	    $fecha_fin = "NULL";

	    $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
	    $sql .= $fecha_fin . ",'" . $usuario . "')";
	    $resultado = mysqli_query($con, $sql);

	    /* Obtenemos explicacion */
	    if (isset($_GET['explicacion'])) {
	        $explicacion = $_GET["explicacion"];
	    }
	    
	    /* Guardamos en BD */
	    $sql = "INSERT INTO kardexestudiante1 VALUES ('$tramite','$usuario','$explicacion')";
	    $resultado = mysqli_query($con, $sql);

	    /*eliminamos de estudiante kardex*/
	    $sql = "DELETE from estudiantekardex where  codTramite = '$tramite'";
	    $resultado = mysqli_query($con, $sql);
	    header("Location: bandejaE.php");

	} else {
	        header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");
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


    /* Cambios de roles */
    if (($procesoSiguiente == "P4" || $procesoSiguiente == "P9" || $procesoSiguiente == "P11") && !(isset($_GET["Anterior"]))) {
        if ($procesoSiguiente == "P4") {
            $usuario2 = $_SESSION['usuario'];

            /* Escribir en bandeja de entrada de kardex */
            // Hallar el usuario de kardex con menor tareas
            $sql = "SELECT nombre, contador FROM (
                        SELECT a.nombre, COUNT(a.nombre) AS contador
                        FROM wf.flujousuario b
                        INNER JOIN academica2.usuario a ON a.rol = 'kardex' AND a.nombre = b.usuario
                        GROUP BY usuario
                    ) AS subconsulta
                    ORDER BY contador ASC
                    LIMIT 1;";
            $resultado2 = mysqli_query($con, $sql);
            $registros2 = mysqli_fetch_array($resultado2);
            $usuario = $registros2["nombre"];

            $flujo = "F1";
            $proceso = "P4";
            /*$sql1 = "SELECT max(numerotramite)+1 tramite FROM flujousuario";
            $resultado1 = mysqli_query($con, $sql1);
            $registros1 = mysqli_fetch_array($resultado1);
            $tramite = $registros1["tramite"];*/

            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";

            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "' ";
            $sql .= "," . $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);

            // Checkboxes
            // Obtener los valores seleccionados de los checkboxes
            if (isset($_GET['materia'])) {
                $materiasSeleccionadas = $_GET['materia'];

                // Verificar si se ha excedido el límite de 6 materias
                if (count($materiasSeleccionadas) <= 6) {
                    // Recorrer y guardar los datos de cada materia seleccionada
                    foreach ($materiasSeleccionadas as $materiaSeleccionada) {
                        // Separar el código de la materia y el paralelo
                        $datos = explode(" ", $materiaSeleccionada);
                        $codMateria = $datos[0];
                        $paralelo = substr($datos[0], -1);

                        // Guardar los datos en la base de datos
                        $sql = "INSERT INTO estudiantekardex VALUES ('$tramite', '$usuario2', '$codMateria', '$paralelo')";
                        mysqli_query($con, $sql);
                    }
                }
            }
            /* ---------------------- */
        	header("Location: carga.php?kardex='$usuario'");
        	exit;
        }
        elseif($procesoSiguiente == "P9"){
        	//Debemos enviar la lista de materias inscritas al estudiante
        	//creamos flujo para estudiante las materias inscritas ya estaran en estudiantekardex
        	$sql1 = "SELECT usuario FROM estudiantekardex WHERE codTramite='$tramite' LIMIT 1";
		    $resultado1 = mysqli_query($con, $sql1);
		    $registros1 = mysqli_fetch_array($resultado1);
		    $usuario = $registros1["usuario"];

		    $flujo = "F1";
		    $proceso = "P9";
		    /*$sql1 = "SELECT max(numerotramite) tramite FROM flujousuario";
		    $resultado1 = mysqli_query($con, $sql1);
		    $registros1 = mysqli_fetch_array($resultado1);
		    $tramite = $registros1["tramite"];*/

		    $today = getdate();
		    $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
		    $fecha_fin = "NULL";

		    $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
		    $sql .= $fecha_fin . ",'" . $usuario . "')";
		    $resultado = mysqli_query($con, $sql);

 			header("Location: bandejaE.php");
 			exit;
        }
        if($procesoSiguiente == "P11"){
        	//Notificamos a los docentes respectivos de que un nuevo estudiante se registro
        	//creamos flujo para docente actualizacion de lista

        	$sql1 = "SELECT * FROM estudiantekardex WHERE codTramite='$tramite'";
		    $resultado1 = mysqli_query($con, $sql1);
		    
		    //$usuario = $registros1["usuario"];

		    $flujo = "F1";
		    $proceso = "P11";
		    $today = getdate();
		    $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
		    $fecha_fin = "NULL";
		    //varios paralelos
		    while($registros1 = mysqli_fetch_array($resultado1)){
		    	//necesitamos usuario (docente)
		    	$sql2 = "SELECT c.nombre from academica2.usuario c INNER JOIN
		    			(SELECT a.idDocente from academica2.paralelo a INNER JOIN 
		    			(SELECT codMateria, paralelo FROM wf.estudiantekardex WHERE codTramite='$tramite') b ON a.codMateria=b.codMateria and a.Paralelo=b.paralelo) d ON c.id=d.idDocente LIMIT 1";
		    	$resultado2 = mysqli_query($con, $sql2);
		    	$registros3=mysqli_fetch_array($resultado2);
		    	$usuario = $registros3["nombre"];

		    	$sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
			    $sql .= $fecha_fin . ",'" . $usuario . "')";
			    $resultado = mysqli_query($con, $sql);
		    }
		    
        	header("Location: bandejaE.php");
        	exit;
        }
        

        
    }  

    header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");
    
}

?>
