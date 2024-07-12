<?php
// restablecer.php
$host = 'localhost';
$dbname = 'u246287323_airsafe';
$username = 'u246287323_root'; // Tu usuario de MySQL
$password = 'u1|G9Qd|9V'; // Tu contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Verificar el token
    $stmt = $pdo->prepare("SELECT id_e FROM empleado WHERE token = :token and fecha_C > NOW()");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Actualizar la contraseña
        $stmt = $pdo->prepare("UPDATE empleado SET password = :new_password, token = NULL, fecha_C=null WHERE id_e = :id");
        $stmt->bindParam(':new_password', $new_password);
        $stmt->bindParam(':id', $user['id_e']);
        $stmt->execute();

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Éxito',
                    text: 'Tú contraseña ha sido actualizada.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php?url=login-form';
                    }
                });
            });
        </script>";

    } else {
        echo "Token inválido.";
    }
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
    ?>
     <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f4f4f4;
                margin: 0;
                font-family: Arial, sans-serif;
            }
            .container {
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
                text-align: center;
            }
            .container h2 {
                margin-bottom: 20px;
                color: #333;
            }
            .form-group {
                margin-bottom: 15px;
                position: relative;
            }
            .form-group input {
                width: 100%;
                padding: 10px 40px 10px 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
            }
            .form-group i {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: #aaa;
                cursor: pointer;
            }
            .btn {
                background-color: #28a745;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-transform: uppercase;
                font-weight: bold;
                transition: background-color 0.3s;
            }
            .btn:hover {
                background-color: #218838;
            }
            .error {
                color: red;
                font-size: 14px;
                margin-bottom: 10px;
                display: none;
            }
            .success {
                color: green;
                font-size: 14px;
                margin-bottom: 10px;
                display: none;
            }
            #password-rules {
            text-align: left;
            font-size: 0.8em;
            color: grey;
            line-height: 0.5;
        }

        #password-rules .rule {
            display: block;
            margin: 2px 0;
        }
        </style>
    </head>
    <body>
    <div class="container">
        <h2>Restablecer Contraseña</h2>
        <form id="resetForm" method="POST" action="index.php?url=resta">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="form-group">
                <input type="password" id="new_password" name="new_password" placeholder="Nueva Contraseña" required>
                <i class="fas fa-eye" onclick="togglePassword('new_password')"></i>
            </div>
            <div class="form-group">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                <i class="fas fa-eye" onclick="togglePassword('confirm_password')"></i>
            </div>
            <div class="error" id="error-message">Las contraseñas no coinciden.</div>
            <div class="success" id="success-message">Las contraseñas coinciden.</div>
            <div id="password-rules">
                <span id="min-characters" class="rule">Mínimo 6 caracteres</span><br>
                <span id="uppercase" class="rule">Una mayúscula</span><br>
                <span id="lowercase" class="rule">Una minúscula</span><br>
                <span id="number" class="rule">Un número</span>
            </div>
            <button type="submit" class="btn">Restablecer Contraseña</button>
        </form>
    </div>

        <script>
            function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = field.nextElementSibling;
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                field.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        document.getElementById('new_password').addEventListener('input', validatePasswordRules);
        document.getElementById('confirm_password').addEventListener('input', validatePasswords);

        function validatePasswordRules() {
            var password = document.getElementById('new_password').value;
            var minCharacters = document.getElementById('min-characters');
            var uppercase = document.getElementById('uppercase');
            var lowercase = document.getElementById('lowercase');
            var number = document.getElementById('number');
            
            // Minimum 6 characters
            if (password.length >= 6) {
                minCharacters.style.color = 'green';
            } else {
                minCharacters.style.color = 'red';
            }

            // At least one uppercase letter
            if (/[A-Z]/.test(password)) {
                uppercase.style.color = 'green';
            } else {
                uppercase.style.color = 'red';
            }

            // At least one lowercase letter
            if (/[a-z]/.test(password)) {
                lowercase.style.color = 'green';
            } else {
                lowercase.style.color = 'red';
            }

            // At least one number
            if (/\d/.test(password)) {
                number.style.color = 'green';
            } else {
                number.style.color = 'red';
            }
        }

        function validatePasswords() {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var errorMessage = document.getElementById('error-message');
            var successMessage = document.getElementById('success-message');
            
            if (newPassword === confirmPassword && validatePasswordStrength(newPassword)) {
                errorMessage.style.display = 'none';
                successMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'block';
                successMessage.style.display = 'none';
            }
        }

        function validatePasswordStrength(password) {
            return password.length >= 6 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /\d/.test(password);
        }

        document.getElementById('resetForm').addEventListener('submit', function(event) {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (newPassword !== confirmPassword || !validatePasswordStrength(newPassword)) {
                event.preventDefault();
                document.getElementById('error-message').style.display = 'block';
            }
        });

        </script>
    </body>
    </html>
 
   
    <?php
} else {
    echo "Token no proporcionado.";
}
?>