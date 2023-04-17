<!DOCTYPE html>
<html>

<head>
	<title>Listado de Personas</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<h2>Listado de Personas</h2>
		<a href="../persona/create" class="btn btn-primary">Nueva Persona</a>
		<br><br>
		<table class="table">
			<thead>
				<tr>
					<th>Cédula de Identidad</th>
					<th>Nombre Completo</th>
					<th>Fecha de Nacimiento</th>
					<th>Teléfono</th>
					<th>Departamento</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $persona) { ?>
					<tr>
						<td><?php echo $persona->ci; ?></td>
						<td><?php echo $persona->nombre_completo; ?></td>
						<td><?php echo $persona->fecha_nacimiento; ?></td>
						<td><?php echo $persona->telefono; ?></td>
						<td><?php echo $persona->departamento; ?></td>
						<td>
							<a href="../persona/edit/<?php echo $persona->ci; ?>" class="btn btn-warning">Editar</a>
							<a href="../persona/delete/<?php echo $persona->ci; ?>" class="btn btn-danger">Eliminar</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</body>

</html>
