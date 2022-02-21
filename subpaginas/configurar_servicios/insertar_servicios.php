<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Insertar servicios</title>
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
            <h1>Insertar un nuevo servicio</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <form action="#" method="post" enctype="multipart/form-data">
                    <br><br>
                    <label for="id">Id asignado: </label>
                    <?php
                        $insertarId="SELECT `AUTO_INCREMENT` FROM information_schema.tables WHERE table_schema='veterinaria' AND table_name='servicio';";

                        $consulta=$conexion->query($insertarId);
                        $fila2=$consulta->fetch_array(MYSQLI_ASSOC);

                        echo"<input type='text' name='id' value='$fila2[AUTO_INCREMENT]' readonly required>";
                    ?>
                    <br><br>
                    <label for="descripcion">Introduzca la descripción del servicio: </label>
                    <input class="input_insertar_productos" type="text" name="descripcion" required>
                    <br><br>
                    <label for="duracion">Introduzca la duración del servicio (en minutos): </label>
                    <input class="input_insertar_productos" type="number" step="any" name="duracion" required>
                    <br><br>
                    <label for="precio">Introduzca el precio del servicio: </label>
                    <input class="input_insertar_productos" type="number" step="any" name="precio" required>
                    <br><br>
                    <input class="boton_enviar_configuraciones" type="submit" name="enviar" value="Insertar">
                    <br><br>
                </form>
            </div>
        </div>
    </main>

    <?php
        if(isset($_POST['enviar'])){
            $descripcion=$_POST['descripcion'];
            $duracion=$_POST['duracion'];
            $precio=$_POST['precio'];

            $insertid=insertarId();

            $insertarServicio="INSERT INTO servicio VALUES(null,?,?,?)";

            $consulta=$conexion->prepare($insertarServicio);
            $consulta->bind_param("sid",$descripcion,$duracion,$precio);
            $consulta->execute();

            $consulta->close();
            echo"<meta http-equiv='refresh' content='0;url=../servicios.php'>";
        }
    ?>

    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>