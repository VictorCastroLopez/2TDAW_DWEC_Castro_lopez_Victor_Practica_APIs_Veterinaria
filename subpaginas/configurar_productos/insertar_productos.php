<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Insertar productos</title>
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
            <h1>Insertar un nuevo producto</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <form action="#" method="post" enctype="multipart/form-data">
                    <br><br>
                    <label for="id">Id asignado: </label>
                    <?php
                        $insertarId="SELECT `AUTO_INCREMENT` FROM information_schema.tables WHERE table_schema='veterinaria' AND table_name='producto';";

                        $consulta=$conexion->query($insertarId);
                        $fila2=$consulta->fetch_array(MYSQLI_ASSOC);

                        echo"<input type='text' name='id' value='$fila2[AUTO_INCREMENT]' readonly required>";
                    ?>
                    <br><br>
                    <label for="titular">Introduzca el nombre del producto: </label>
                    <input class="input_insertar_productos" type="text" name="nombre" required>
                    <br><br>
                    <label for="titular">Introduzca el precio del producto: </label>
                    <input class="input_insertar_productos" type="number" step="any" name="precio" required>
                    <br><br>
                    <input class="boton_enviar_configuraciones" type="submit" name="enviar">
                    <br><br>
                </form>
            </div>
        </div>
    </main>

    <?php
        if(isset($_POST['enviar'])){
            $nombre=$_POST['nombre'];
            $prec=$_POST['precio'];

            $insertid=insertarId();

            $insertarProducto="INSERT INTO producto VALUES(null,?,?)";

            $consulta=$conexion->prepare($insertarProducto);
            $consulta->bind_param("sd",$nombre,$prec);
            $consulta->execute();

            $consulta->close();
            echo"<meta http-equiv='refresh' content='0;url=../productos.php'>";
        }
    ?>

    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>