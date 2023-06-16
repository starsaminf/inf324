<?php 
	include "conexion.inc.php";
	$sql = "SELECT paralelo.*
	FROM academica2.paralelo paralelo 
	INNER JOIN academica2.materia ON materia.codMateria = paralelo.codMateria;";
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
		<table class="table mt-3">
			<thead>
				<tr>
					<th>codMateria</th>
					<th>Paralelo</th>
					<th>Horario</th>
					<th>Inscripción</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while ($registros = mysqli_fetch_array($resultado)) {
					echo "<tr>";
					echo "<td>" . $registros["codMateria"] . "</td>";
					echo "<td>" . $registros["Paralelo"] . "</td>";
					echo "<td>" . $registros["horario"] . "</td>";
					echo "<td><input type='checkbox' name='materia[]' value='" . $registros["codMateria"] . "-" . $registros["Paralelo"] . "'></td>";
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


