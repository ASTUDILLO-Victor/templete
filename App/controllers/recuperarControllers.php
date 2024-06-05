<?php
namespace App\controllers;

use App\models\Task;
use App\models\empleado;
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

class recuperarControllers
{

    public function show()
    {
        return view('recuperar');
    }

    public function recuperar()
    {
        require 'vendor/autoload.php';
    
        // Conexión a la base de datos
        $host = 'localhost';
        $dbname = 'proyecto';
        $username = 'root';
        $password = '';
    
        try {
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
    
            // Verificar si el email existe en la base de datos
            $stmt = $pdo->prepare("SELECT id_e FROM empleado WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
                $token = bin2hex(random_bytes(16)); // Generar un token aleatorio
                $expiration = date('Y-m-d H:i:s', strtotime('+24 hours')); // Calcular la fecha y hora de expiración (24 horas a partir de ahora)
    
                // Guardar el token en la base de datos
                $stmt = $pdo->prepare("UPDATE empleado SET token = :token, fecha_C = :fecha_C WHERE id_e = :id_e");
                $stmt->bindParam(':token', $token);
                $stmt->bindParam(':fecha_C', $expiration);
                $stmt->bindParam(':id_e', $user['id_e']);
                $stmt->execute();
    
                // Enviar correo electrónico
                $this->sendPasswordResetEmail($email, $token);
                echo "<div class='alert alert-success' role='alert'>Se ha enviado un enlace de recuperación a tu correo electrónico.</div>";
    
                // Redirigir al usuario al login después de un breve retraso (por ejemplo, 3 segundos)
                header("refresh:3;index.php?url=login-form");
            } else {
                echo "El correo electrónico no está registrado.";
            }
        }
    }
    
    public function sendPasswordResetEmail($email, $token)
    {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    
        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'prueba354astu@outlook.com'; // Tu correo de Outlook
            $mail->Password = 'nicole354'; // Tu contraseña de Outlook
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            // Remitente y destinatario
            $mail->setFrom('prueba354astu@outlook.com', 'Administrador');
            $mail->addAddress($email);
    
            // Obtener información de ubicación y dispositivo
            $locationInfo = 
            $deviceInfo = $this->getDeviceInfo();
    
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                        line-height: 1.6;
                    }
                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding: 10px 0;
                        border-bottom: 1px solid #ddd;
                    }
                    .header h1 {
                        margin: 0;
                        font-size: 24px;
                        color: #333;
                    }
                    .content {
                        padding: 20px;
                    }
                    .content p {
                        margin: 0 0 20px;
                    }
                    .content a {
                        display: inline-block;
                        background-color: #28a745;
                        color: #fff;
                        padding: 10px 20px;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                    .footer {
                        text-align: center;
                        padding: 10px 0;
                        border-top: 1px solid #ddd;
                        margin-top: 20px;
                    }
                    .footer p {
                        margin: 0;
                        font-size: 12px;
                        color: #777;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1>Restablecimiento de Password</h1>
                    </div>
                    <div class='content'>
                        <p>Hola,</p>
                        <p>Recibiste este correo porque solicitaste restablecer tu Password. Haz clic en el button de abajo para restablecer tu Password:</p>
                        <p><a href='http://localhost/templete-main/index.php?url=resta&token=$token'>Restablecer Password</a></p>
                        <p>Si no solicitaste restablecer tu Password, puedes ignorar este correo.</p>
                        
                        <p><strong>Dispositivo:</strong> {$deviceInfo}</p>
                        
                    </div>
                    <div class='footer'>
                        <p>Gracias,</p>
                        <p>El equipo de soporte</p>
                    </div>
                </div>
            </body>
            <script>
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    document.getElementById('locationInfo').innerHTML = '<strong>Ubicación:</strong> Latitud: ' + latitude + ', Longitud: ' + longitude;
                });
            } else {
                document.getElementById('locationInfo').innerHTML = 'La geolocalización no está disponible en este navegador.';
            }
            
            var userAgent = navigator.userAgent;
            var deviceInfo = 'Navegador desconocido y SO';
            
            if (/MSIE/i.test(userAgent) && !/Opera/i.test(userAgent)) {
                deviceInfo = 'Internet Explorer';
            } else if (/Firefox/i.test(userAgent)) {
                deviceInfo = 'Mozilla Firefox';
            } else if (/Chrome/i.test(userAgent)) {
                deviceInfo = 'Google Chrome';
            } else if (/Safari/i.test(userAgent)) {
                deviceInfo = 'Apple Safari';
            } else if (/Opera/i.test(userAgent)) {
                deviceInfo = 'Opera';
            } else if (/Netscape/i.test(userAgent)) {
                deviceInfo = 'Netscape';
            }
            
            var osArray = {
                '/windows nt 10/i': 'Windows 10',
                '/windows nt 6.3/i': 'Windows 8.1',
                '/windows nt 6.2/i': 'Windows 8',
                '/windows nt 6.1/i': 'Windows 7',
                '/windows nt 6.0/i': 'Windows Vista',
                '/windows nt 5.2/i': 'Windows Server 2003/XP x64',
                '/windows nt 5.1/i': 'Windows XP',
                '/windows xp/i': 'Windows XP',
                '/macintosh|mac os x/i': 'Mac OS X',
                '/mac_powerpc/i': 'Mac OS 9',
                '/linux/i': 'Linux',
                '/ubuntu/i': 'Ubuntu',
                '/iphone/i': 'iPhone',
                '/ipod/i': 'iPod',
                '/ipad/i': 'iPad',
                '/android/i': 'Android',
                '/blackberry/i': 'BlackBerry',
                '/webos/i': 'Mobile'
            };
            
            for (var regex in osArray) {
                if (osArray.hasOwnProperty(regex) && new RegExp(regex).test(userAgent)) {
                    deviceInfo += ' en ' + osArray[regex];
                    break;
                }
            }
            
            document.getElementById('deviceInfo').innerHTML = '<strong>Dispositivo:</strong> ' + deviceInfo;
        </script>
            </html>";
    
            $mail->send();
        } catch (\Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}";
        }
    }
    
   
    private function getDeviceInfo()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $deviceInfo = "Navegador desconocido y SO";
    
        if (preg_match('/MSIE/i', $userAgent) && !preg_match('/Opera/i', $userAgent)) {
            $deviceInfo = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $deviceInfo = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            $deviceInfo = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $deviceInfo = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $userAgent)) {
            $deviceInfo = 'Opera';
        } elseif (preg_match('/Netscape/i', $userAgent)) {
            $deviceInfo = 'Netscape';
        }
    
        $osArray = [
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        ];
    
        foreach ($osArray as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                $deviceInfo .= " en {$value}";
                break;
            }
        }
    
        return $deviceInfo;
    }

}
