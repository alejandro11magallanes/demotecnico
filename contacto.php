<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {

    $nombre = $_POST['nombre'];
    $empresa = $_POST['empresa'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    $ip = $_SERVER["REMOTE_ADDR"];
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = '6LeqNvUiAAAAAAhw3um7TkIUD9H3GLF9c3QpulNN';

    $errors = array();

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");

    $atributos = json_decode($response, TRUE);

    if (!$atributos['success']) {
        $errors[] = 'Verifica el captcha';
    }

    if (empty($nombre)) {
        $errors[] = 'El campo nombre es obligatorio';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'La dirección de correo electrónico no es válida';
    }
    if (empty($empresa)) {
        $errors[] = 'El campo empresa es obligatorio';
    }

    if (empty($telefono)) {
        $errors[] = 'El campo telefono es obligatorio';
    }

    if (empty($mensaje)) {
        $errors[] = 'El campo mensaje es obligatorio';
    }

    if (count($errors) == 0) {

        $msj = "De: $nombre <a href='mailto:$email'>$email</a><br>";
        $msj .= "Empresa que contacta: $empresa<br><br>";
        $msj .= "Cuerpo del mensaje:";
        $msj .= '<p>' . $mensaje . '</p>';
        $msj .= "Telefono del Cliente:";
        $msj .= '<p>' . $telefono . '</p>';
        $msj .= "--<p>Este mensaje se ha enviado desde la pagina de preset.mx </p>";

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'mail.preset.mx';
            $mail->SMTPAuth = true;
            $mail->Username = 'contacto@preset.mx';
            $mail->Password = 'contacto1212,';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('correo@dominio.com', 'Emisor');
            $mail->addAddress('contacto@preset.mx', 'Receptor');
            //$mail->addReplyTo('otro@dominio.com');

            $mail->isHTML(true);
            $mail->Subject = 'Un cliente ha contactado desde preset';
            $mail->Body = utf8_decode($msj);

            $mail->send();

            $respuesta = 'Gracias por contactar con preset.mx en breve responderemos tu mensaje, Gracias';
        } catch (Exception $e) {
            $respuesta = 'Mensaje ' . $mail->ErrorInfo;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="img/icono.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Contacto</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="img/logo1.png" alt="Logo" width="200" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="info.html">¿Qué es Preset?</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="planes.html">Planes por Empresa</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="funcion.html">Funcionalidad</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="contacto.php">Contactanos</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <button class="btn btn-secondary" style="color: #00b0f0" onclick="location.href='login.php'">
                    Iniciar Sesión
                </button>
            </div>
        </div>
    </nav>
    <br />
    <div class="container">
        <h3>Contactanos</h3>
    </div>
    <div class="container">
        <br />
        <?php
        if (isset($errors)) {
            if (count($errors) > 0) {
        ?>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                            foreach ($errors as $error) {
                                echo $error . '<br>';
                            }
                            ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>

        <div class="row">
            <div class="col-md-6" style="margin-left: 25%;">

                <form class="form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
                    autocomplete="off">
                    <div class="mb-3">

                        <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required
                            autofocus>
                    </div>

                    <div class="mb-3">

                        <input type="text" class="form-control" placeholder="Nombre de tu empresa" id="email"
                            name="empresa" required>
                    </div>

                    <div class="mb-3">

                        <input type="email" class="form-control" placeholder="Correo electronico" id="asunto"
                            name="email" required>
                    </div>
                    <div class="mb-3">

                        <input type="text" class="form-control" placeholder="Telefono de contacto" id="asunto"
                            name="telefono" required>
                    </div>

                    <div class="mb-3">

                        <textarea class="form-control" id="mensaje" placeholder="Dejanos tus comentarios" name="mensaje"
                            rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6LeqNvUiAAAAACNSxmBapdx6OiJJ3BGixtuYUTXk"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="contacto" name="submit" class="btn btn-lg ">Enviar</button>
                    </div>

                </form>

            </div>
        </div>

        <?php if (isset($respuesta)) { ?>
        <div class="row py-3">
            <div class="col-lg-6 col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $respuesta; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
    <br><br><br>
    <footer>
        <!-- Copyright -->
        <div class="p-3" style="background-color: #000">
            <div class="container">
                <br />
                <h4 style="color: #00b0f0">Contáctanos</h4>
                <br />
                <h4 style="color: #00b0f0">Teléfono: 871-510-2784</h4>
                <h4 style="color: #00b0f0">Teléfono: 871-296-2685</h4>
                <br />
                <h4 style="color: #00b0f0">contacto@preset.mx</h4>
                <br />
                <div class="row">
                    <div class="col-md-4 offset-md-2">
                        <h4 style="color: #00b0f0">
                            <a href="privacidad.html" style="text-decoration: none; color: #00b0f0">Archivo de
                                privacidad</a>
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <h4 style="color: #00b0f0; margin-left: 15%">
                            Derecha Reservados Brixar, S.A. de C.V.
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
    </footer>


</body>

</html>