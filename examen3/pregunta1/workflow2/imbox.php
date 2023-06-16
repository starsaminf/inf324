<?php
session_start();
include "conexion.inc.php";

$sql = "SELECT * FROM flujousuario ";
$sql .= "WHERE usuario='" . $_SESSION["usuario"] . "' ";
$sql .= "AND fechafin IS NULL";
$resultado = mysqli_query($con, $sql);
?>
<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Mi Aplicación</a>
		<div class="ml-auto">
			<a href="logout.php" class="btn btn-link">Cerrar sesión</a>
		</div>
	</nav>

	<div class="container mt-3">
		<div class="d-flex justify-content-start">
			<a href="iniciar_flujo.php" class="btn btn-primary mr-2">Iniciar proceso</a>
			<a href="bandejaS.php" class="btn btn-primary">Ver bandeja de salida</a>
		</div>

		<table class="table mt-3">
			<thead>
				<tr>
					<th>Flujo</th>
					<th>Proceso</th>
					<th>Operacion</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($registros = mysqli_fetch_array($resultado)) {
				echo "<tr>";
				echo "<td>" . $registros["flujo"] . "</td>";
				echo "<td>" . $registros["proceso"] . "</td>";
				echo "<td>";
				echo "<a href='mflujo.php?flujo=" . $registros["flujo"] . "&proceso=" . $registros["proceso"] . "' class='btn btn-info'>Ir</a>";
				echo "</td>";
				echo "</tr>";
				$_SESSION['codtramite'] = $registros["numerotramite"];
			}
			?>
			</tbody>
		</table>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

