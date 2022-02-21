<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Insertar testimonio</title>
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
            <h1>Insertar un nuevo testimonio</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <form action="#" method="post" enctype="multipart/form-data">
                    <br><br>
                    <label for="id">Id asignado: </label>
                    <?php
                        $insertarId="SELECT `AUTO_INCREMENT` FROM information_schema.tables WHERE table_schema='veterinaria' AND table_name='testimonio';";

                        $consulta=$conexion->query($insertarId);
                        $fila2=$consulta->fetch_array(MYSQLI_ASSOC);

                        echo"<input type='text' name='id' value='$fila2[AUTO_INCREMENT]' readonly required>";
                    ?>
                    <br><br>
                    <label for="opcion_nick">Nombre del autor: </label>
                    <?php
                        $sacarnickDueño="SELECT Dni, Nombre FROM dueño WHERE nick!='admin'";

                        $nickDueño=$conexion->query($sacarnickDueño);

                        if($nickDueño!=null){
                            echo"<select name='opcion_nick'>";
                            while($fila=$nickDueño->fetch_array(MYSQLI_ASSOC)){
                                echo"<option style='width: 150px' value='$fila[Dni]'>";
                                echo"$fila[Nombre]";
                                echo"</option>";
                            }
                            
                            echo"</select>";
                        }
                    ?>
                    <br><br>
                    <label for="contenido">Introduzca el contenido de su testimonio: </label>
                    <input class="input_insertar_productos" type="text" name="contenido" required>
                    <br><br>
                    <input class="boton_enviar_configuraciones" type="submit" name="enviar" value="Insertar">
                    <br><br>
                </form>
            </div>
        </div>
    </main>
    <?php
        if(isset($_POST['enviar'])){
            $autor=$_POST['opcion_nick'];
            $contenido=$_POST['contenido'];
            $fecha_publicacion=date("Y/m/d",time());

            $insertid=insertarId();

            $insertarTestimonio="INSERT INTO testimonio VALUES(null,?,?,?)";

            $consulta=$conexion->prepare($insertarTestimonio);
            $consulta->bind_param("sss",$autor,$contenido,$fecha_publicacion);
            $consulta->execute();

            $consulta->close();
            echo"<meta http-equiv='refresh' content='0;url=../testimonios.php'>";
        }
    ?>
    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>