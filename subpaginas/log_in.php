<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Acceder</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/iconos/favicon.png" type="image/x-icon">
    <!-- Tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Antique+Soft&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php
        require_once("../funciones_php/funciones.php");
        $conexion=conectarServidor();
        
        $parametro1="../";
        $parametro2="";
        $parametro3="../assets/";
        echo mostrarNav($parametro1,$parametro2,$parametro3);
    ?>

    <main class="main_configuraciones" style='padding-top: 8%; padding-bottom: 8%;'>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <h1 style='text-align: center;'>Iniciar sesión</h1>
                <form action="#" method="post">
                    <div style='text-align: center; margin-left: -20%'>
                        <label for="nombre">Nick: </label>
                        <input style='width: 40%' type="text" name='nombre' required>
                        <br>
                        <label for="contraseña">Contraseña: </label>
                        <input style='width: 40%' type="password" name='contraseña' required>
                        <br>
                        <label for="mantener_sesion">Mantener sesión iniciada: </label>
                        <input style="width: 2%;" type="checkbox" id="mantener_sesion" name="mantener_sesion">
                        <br>
                        <input type="submit" name='enviar' value='Iniciar sesión'>
                    </div>
                </form>
                <br><br>
            </div>
        </div>
        <?php
        
            if(isset($_POST['enviar'])){

                $nombre_usuario=$_POST['nombre'];
                $contraseña_usuario=$_POST['contraseña'];
                $contraseña_usuario=md5($contraseña_usuario);

                $consulta="SELECT nick FROM dueño WHERE nick=? AND pass=?";
                $datos=$conexion->prepare($consulta);
                $datos->bind_param("ss",$nombre_usuario,$contraseña_usuario);
                $datos->execute();

                $datos->store_result();

                if($datos->num_rows==0){ 
                    echo"<div class='div_aviso'>
                            <p><strong>Nombre o contraseña incorrecta</strong></p>
                        </div>";
                }else{
                    $_SESSION['nombre']=$nombre_usuario;

                    if(isset($_POST['mantener_sesion'])){
                        $tiempo=time()+60*60*24*30;

                        $codificar=session_encode();
                        setcookie("Msesion",$codificar,$tiempo,"/");
                    }
                    echo"<meta http-equiv='refresh' content='0;url=../index.php'>";
                }
            }

        ?>
    </main>

    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>