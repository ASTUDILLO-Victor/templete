<?php
    include_once "conexion.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["user"]) && isset($_POST["pass"]) && $_POST["user"] != "" && $_POST["pass"] != ""){
            $sql = "SELECT * FROM usuarios WHERE usuario = '".$_POST["user"]."' AND contrasena = '".$_POST["pass"]."';";
            $resultado = $conn->query($sql);

            if($resultado){
                if(mysqli_num_rows($resultado) > 0){
                    echo "<script>alert('INICIO DE SESION CORRECTO');</script>";
                    
                    $sql = "UPDATE `estados` SET `estadoAlarma`='1';";
        
                    $conn->query($sql);
                        
                }else{
                    echo "<script>alert('CREDENCIALES NO VALIDAS');</script>";
                    $sql = "UPDATE `estados` SET `estadoAlarma`='2';";
        
                    $conn->query($sql);
                }
                
            }else{
                echo "<script>alert('MAL');</script>";
            }
        }else{
            echo "<script>alert('Faltan datos');</script>";
        }
    }

?>

<html>
    <head>    
        <title>Iniciar sesion</title>
        <script type="text/javascript" language="javascript">

        var http_request = false;

        function makeRequest(url) {

            http_request = false;

            if (window.XMLHttpRequest) { // Mozilla, Safari,...
                http_request = new XMLHttpRequest();
                if (http_request.overrideMimeType) {
                    http_request.overrideMimeType('text/xml');
                    // Ver nota sobre esta linea al final
                }
            } else if (window.ActiveXObject) { // IE
                try {
                    http_request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        http_request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {}
                }
            }

            if (!http_request) {
                alert('Falla :( No es posible crear una instancia XMLHTTP');
                return false;
            }
            http_request.onreadystatechange = alertContents;
            http_request.open('GET', url, true);
            http_request.send();

        }

        function hide (elements) {
            elements = elements.length ? elements : [elements];
            for (var index = 0; index < elements.length; index++) {
                elements[index].style.display = 'none';
            }
        }

        function show (elements, specifiedDisplay) {
            elements = elements.length ? elements : [elements];
            for (var index = 0; index < elements.length; index++) {
                elements[index].style.display = 'inline-block' || 'block';
            }
        }

        setInterval(myCallback, 1000);

        function myCallback() {
            let options = {
            method: 'GET'
            };

            fetch('/practicaMicro/mostrarLogin.php', options)
            .then(response => response.text())
            .then(res => {
                if(res == "0") hide(document.getElementById('login'));
                else show(document.getElementById('login'));
            });
        }
    </script>
    </head>
    <body>
        <div id="login" style="display: none;">
            <form method="POST" action="index.php">
                <input type="text" placeholder="Usuario" name="user" required />
                <input type="password" placeholder="Contrasena" name="pass"  required/>

                <input type="submit" value="Iniciar Sesion"/>
            </form>     
        </div>

    </body>

</html>