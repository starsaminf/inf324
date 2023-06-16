<?php
session_start();

include "conexion.inc.php";
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];
 
$sql = "SELECT * FROM flujo ";
$sql .= "WHERE flujo='$flujo' and proceso = '$proceso'";
$resultado = mysqli_query($con,$sql);
$registros = mysqli_fetch_array($resultado);
$pantalla = $registros["pantalla"];
?>
<html>
<head>
	<title>inscripción a materias</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	
	<form action="motor.php" method="GET"> 
		<?php include $pantalla.".php"; ?><br/>
		<input type="hidden" name="pantalla" value="<?php echo $pantalla; ?>">
		<input type="hidden" name="flujo" value="<?php echo $flujo; ?>">
		<input type="hidden" name="proceso" value="<?php echo $proceso; ?>">
		<div class="container mt-5">
			<input type="submit" value="Anterior" name="Anterior">
			<input type="submit" value="Siguiente" name="Siguiente">
		</div>
	</form>
</body>
</html>
