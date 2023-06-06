
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sistema de registro a materias</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">
	  <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/floating-labels/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin"  method="GET" action="control.php">
  <div class="text-center mb-4">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Datos personales</h1>
  </div>

  <div class="form-label-group">
    <input type="text" name="usuario" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputEmail">Nombre de Usuario</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <label for="inputPassword">Password</label>
  </div>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
</form>
</body>
</html>


