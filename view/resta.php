<?php
// restablecer.php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'root'; // Tu usuario de MySQL
$password = ''; // Tu contraseña de MySQL

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

        echo "Tu contraseña ha sido actualizada.";

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

            document.getElementById('new_password').addEventListener('input', validatePasswords);
            document.getElementById('confirm_password').addEventListener('input', validatePasswords);

            function validatePasswords() {
                var newPassword = document.getElementById('new_password').value;
                var confirmPassword = document.getElementById('confirm_password').value;
                var errorMessage = document.getElementById('error-message');
                var successMessage = document.getElementById('success-message');
                
                if (newPassword === confirmPassword) {
                    errorMessage.style.display = 'none';
                    successMessage.style.display = 'block';
                } else {
                    errorMessage.style.display = 'block';
                    successMessage.style.display = 'none';
                }
            }

            document.getElementById('resetForm').addEventListener('submit', function(event) {
                var newPassword = document.getElementById('new_password').value;
                var confirmPassword = document.getElementById('confirm_password').value;
                if (newPassword !== confirmPassword) {
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