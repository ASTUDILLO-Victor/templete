<?php 

//require "modal/modal3.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AireSafe - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script  src="js/modal.js"></script>
    

    

<style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            width: 200%;
            max-width: 1000px; /* Aumenta este valor para hacer el card más grande */
            padding: 20px;
        }
    </style>
</head>

<body class="bg-gradient-primary">

<div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-center">Recuperar contraseña</h5>
            <form action="index.php?url=recuperar2" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text" name="email" id="email-icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu correo" aria-describedby="email-icon" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button><br><br>
                <button onclick="window.location.href = 'index.php?url=login-form'" class="btn btn-primary w-100">
                                Volver
                        </button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/validar.js"></script>
    

</body>

</html>

