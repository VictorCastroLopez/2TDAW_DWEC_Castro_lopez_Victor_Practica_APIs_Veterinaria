<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Insertar dueños</title>
    <!-- Favicon -->
    <link rel="icon" href="../../assets/iconos/favicon.png" type="image/x-icon">
    <!-- Tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Antique+Soft&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <?php
        require_once("../../funciones_php/funciones.php");
        $conexion=conectarServidor();
        
        $parametro1="../../";
        $parametro2="../";
        $parametro3="../../assets/";
        echo mostrarNav($parametro1,$parametro2,$parametro3);
    ?>
    <main class="main_configuraciones">
        <div class="centrar_titulo_configuraciones">
            <h1>Insertar un nuevo dueño</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <form action="#" method="post" enctype="multipart/form-data">
                    <br><br>
                    <label for="dni">Dni: </label>
                    <input type="text" name="dni" required>
                    <br><br>
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" required>
                    <br><br>
                    <label for="telefono">Teléfono: </label>
                    <input type="text" name="telefono">
                    <br><br>
                    <label for="nick">Nick: </label>
                    <input type="text" name="nick" required>
                    <br><br>
                    <label for="contraseña">Contraseña: </label>
                    <input type="password" name="contraseña" required>
                    <br><br>
                    <input class="boton_enviar_configuraciones" type="submit" name="enviar">
                    <br><br>
                </form>
            </div>
        </div>
    </main>

    <?php
        // Insertar dueños en BD
        if(isset($_POST['enviar'])){

            $dni=$_POST['dni'];
            $nombre=$_POST['nombre'];
            $telefono=$_POST['telefono'];
            $nick=$_POST['nick'];
            $contraseña=$_POST['contraseña'];

            $insertid=insertarId();

            $insertarDueño="INSERT INTO dueño values(?,?,?,?,md5(?))";

            $consulta=$conexion->prepare($insertarDueño);
            $consulta->bind_param("ssiss",$dni,$nombre,$telefono,$nick,$contraseña);
            $consulta->execute();

            $consulta->close();
            echo"<meta http-equiv='refresh' content='0;url=../dueños.php'>";
        }
    ?>

    <?php

        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>