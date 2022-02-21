<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Modificar dueños</title>
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
            <h1>Modificar datos del dueño</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <?php
                    if($_COOKIE['Msesion']){
                        if($_SESSION['nombre']=="admin"){
                            $idDueño=$_POST['datos'];
                            $consulta1="SELECT * FROM dueño WHERE Dni='$idDueño'";
                            $dato=$conexion->query($consulta1);
                            $fila=$dato->fetch_array();
                            if($dato->num_rows>0){
                                echo"<form action='#' method='post' enctype='multipart/form-data'>
                                        <br><br>
                                        <label for='dni'>Dni: </label>
                                        <input type='text' name='dni' value='$fila[Dni]'>
                                        <br><br>
                                        <label for='nombre'>Nombre: </label>
                                        <input type='text' name='nombre' value='$fila[Nombre]'>
                                        <br><br>
                                        <label for='telefono'>Teléfono: </label>
                                        <input type='text' name='telefono' value='$fila[Telefono]'>
                                        <br><br>
                                        <label for='nick'>Nick: </label>
                                        <input type='text' name='nick' value='$fila[nick]'>
                                        <br><br>
                                        <label for='contraseña'>Contraseña: </label>
                                        <input type='password' name='contraseña'>
                                        <br><br>
                                        <input class='boton_enviar_configuraciones' type='submit' name='enviar_modificacion_dueños' value='Enviar modificación'>
                                        <input type='hidden' name='datos' value='$fila[Dni]'>
                                        <br><br>
                                    </form>";
                            }
                        }elseif($_SESSION['nombre']!="admin"){
                            $idDueño=$_POST['datos'];
                            $consulta1="SELECT * FROM dueño WHERE Dni='$idDueño' AND nick='$_SESSION[nombre]'";
                            $dato=$conexion->query($consulta1);
                            $fila2=$dato->fetch_array();
                            if($dato->num_rows>0){
                                echo"<form action='#' method='post' enctype='multipart/form-data'>
                                        <br><br>
                                        <label for='dni'>Dni: </label>
                                        <input type='text' name='dni' value='$fila2[Dni]' readonly>
                                        <br><br>
                                        <label for='nombre'>Nombre: </label>
                                        <input type='text' name='nombre' value='$fila2[Nombre]' readonly>
                                        <br><br>
                                        <label for='telefono'>Teléfono: </label>
                                        <input type='text' name='telefono' value='$fila2[Telefono]'>
                                        <br><br>
                                        <label for='nick'>Nick: </label>
                                        <input type='text' name='nick' value='$fila2[nick]' readonly>
                                        <br><br>
                                        <label for='contraseña'>Contraseña: </label>
                                        <input type='password' name='contraseña'>
                                        <br><br>
                                        <input class='boton_enviar_configuraciones' type='submit' name='enviar_modificacion_dueños' value='Enviar modificación'>
                                        <input type='hidden' name='datos' value='$fila2[Dni]'>
                                        <br><br>
                                    </form>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </main>
    <?php
        if(isset($_POST['enviar_modificacion_dueños'])){

            $dni=$_POST['dni'];
            $nombre=$_POST['nombre'];
            $telefono=$_POST['telefono'];
            $nick=$_POST['nick'];
            $contraseña=$_POST['contraseña'];

            if(isset($_COOKIE['Msesion'])){
                if($_SESSION['nombre']=="admin"){    
                    if($_POST['contraseña']==""){
                        $mantener_contraseña="SELECT pass FROM dueño WHERE nick='$_SESSION[nombre]'";//Cambiar segun a que usuario le de a modificar
                        // Modificar dueño 
                        $modificarDueño="UPDATE dueño 
                        SET Dni=?,Nombre=?,Telefono=?,nick=?
                        WHERE Dni='$dni'";

                        $consulta2=$conexion->prepare($modificarDueño);
                        $consulta2->bind_param("ssis",$dni,$nombre,$telefono,$nick);
                        $consulta2->execute();

                        $consulta2->close();
                        echo"<meta http-equiv='refresh' content='0;url=../dueños.php'>";
                    }else{
                        $mantener_contraseña="SELECT pass FROM dueño WHERE nick='$_SESSION[nombre]'";//Cambiar segun a que usuario le de a modificar
                        // Modificar dueño 
                        $modificarDueño="UPDATE dueño 
                        SET Dni=?,Nombre=?,Telefono=?,nick=?,pass=md5(?)
                        WHERE Dni='$dni'";

                        $consulta2=$conexion->prepare($modificarDueño);
                        $consulta2->bind_param("ssiss",$dni,$nombre,$telefono,$nick,$contraseña);
                        $consulta2->execute();

                        $consulta2->close();
                        echo"<meta http-equiv='refresh' content='0;url=../dueños.php'>";
                    }

                }elseif($_SESSION['nombre']!="admin"){
                    if($_POST['contraseña']==""){
                        $mantener_contraseña="SELECT pass FROM dueño WHERE nick='$_SESSION[nombre]'";
                        // Modificar dueño 
                        $modificarDueño="UPDATE dueño 
                        SET Telefono=?
                        WHERE Dni='$dni'";
        
                        $consulta2=$conexion->prepare($modificarDueño);
                        $consulta2->bind_param("i",$telefono);
                        $consulta2->execute();
        
                        $consulta2->close();
                        echo"<meta http-equiv='refresh' content='0;url=../dueños.php'>";
                    }else{
                        $modificarDueño="UPDATE dueño 
                        SET Telefono=?,pass=md5(?)
                        WHERE Dni='$dni'";
        
                        $consulta2=$conexion->prepare($modificarDueño);
                        $consulta2->bind_param("is",$telefono,$contraseña);
                        $consulta2->execute();
        
                        $consulta2->close();
                        echo"<meta http-equiv='refresh' content='0;url=../dueños.php'>";
                    }
                }
            } 
        }
    ?>
    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>