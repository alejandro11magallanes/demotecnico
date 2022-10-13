<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <script src="js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body>
<nav class="navbar navbar-expand-lg" id="nav">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
          <img
            src="img/logo.jpg"
            alt="Logo"
            width="100"
            height="100"
            class="d-inline-block align-text-top"
          />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <h4>Dominio.com.mx</h4>
            </li>
            <li style="margin-left: 30px" class="nav-item">
              <a class="nav-link" href="planes">PLANES</a>
            </li>
            <li style="margin-left: 30px" class="nav-item">
              <a class="nav-link" href="contactanos">CONTACTANOS</a>
            </li>
          </ul>
        </div>
        <div style="margin-right: 10%" class="navbar-brand">
          <h5>Contacto: 871-111-0454</h5>
        </div>
        <div class="navbar-brand">
          <button class="btn btn-danger" onclick="location.href='index.html'">
            Volver
          </button>
        </div>
      </div>
    </nav>
    <br />
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
            <form>
                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            <br>
            <div class="text-center">
            <a href="">¿Olvidaste tu Contraseña?</a>
            </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>