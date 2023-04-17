<!DOCTYPE html>
<html>
<head>
    <title>Editar Persona</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Editar Persona</h2>
        <form method="post" action="../update/<?php echo $data->ci ?>">
            <div class="form-group">
                <label for="ci">Cédula de Identidad:</label>
                <input type="text" class="form-control" id="ci" name="ci" value="<?php echo $data->ci; ?>">
            </div>
            <div class="form-group">
                <label for="nombre_completo">Nombre Completo:</label>
                <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="<?php echo $data->nombre_completo; ?>">
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $data->fecha_nacimiento; ?>">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $data->telefono; ?>">
            </div>
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $data->departamento; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
