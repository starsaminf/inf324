<?php
session_start();

include "conexion.inc.php";
$sql = "SELECT * FROM flujousuario ";
$sql .= "WHERE usuario='" . $_SESSION["usuario"] . "' ";
$sql .= "AND fechafin is not null ";
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
			<a href="cerrar.php" class="btn btn-link">Cerrar sesión</a>
		</div>
	</nav>

	<div class="container mt-3">
		<div class="d-flex justify-content-start">
			<a href="bandejaE.php" class="btn btn-primary mr-2">Volver</a>
		</div>

		<table class="table mt-3">
			<thead>
				<tr>
					<th>Flujo</th>
					<th>Proceso</th>
					<th>Fecha inicio</th>
					<th>Fecha fin</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while ($registros = mysqli_fetch_array($resultado)) {
					echo "<tr>";
					echo "<td>" . $registros["flujo"] . "</td>";
					echo "<td>" . $registros["proceso"] . "</td>";
					echo "<td>" . $registros["fechainicio"] . "</td>";
					echo "<td>" . $registros["fechafin"] . "</td>";
					echo "</tr>";
				}
			?>
			</tbody>
		</table>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
