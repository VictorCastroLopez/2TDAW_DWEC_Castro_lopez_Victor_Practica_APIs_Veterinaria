<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Modificar productos</title>
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
            <h1>Modificar datos del producto</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <?php
                    // Mostrar formulario de datos para actualizar 
                    $idProducto=$_POST['datos'];  
                    $consulta1="SELECT * FROM producto WHERE ID='$idProducto'";
                    $dato=$conexion->query($consulta1);
                    $fila=$dato->fetch_array();
                    if($dato->num_rows>0){
                        echo"<form action='#' method='post' enctype='multipart/form-data'>
                                <label for='nombre'>Nombre: </label>
                                <input type='text' name='nombre' value='$fila[Nombre]'>
                                <br><br>
                                <label for='precio'>Precio: </label>
                                <input type='text' name='precio' value='$fila[precio]'>
                                <br><br>
                                <input class='boton_enviar_configuraciones' type='submit' name='enviar_modificacion_productos' value='Enviar modificación'>
                                <input type='hidden' name='datos' value='$fila[Id]'>
                                <br><br>
                            </form>";
                    }
                ?>
            </div>
        </div>
        <?php
            if(isset($_POST['enviar_modificacion_productos'])){
                $nombre=$_POST['nombre'];
                $precio=$_POST['precio'];

                $insertid=insertarId();

                // Modificar Productos
                $modificarProducto="UPDATE producto 
                                    SET Nombre=?,precio=? 
                                    WHERE ID='$idProducto'";

                $consulta2=$conexion->prepare($modificarProducto);
                $consulta2->bind_param("sd",$nombre,$precio);
                $consulta2->execute();

                $consulta2->close();
                echo"<meta http-equiv='refresh' content='0;url=../productos.php'>";
            }
        ?>
    </main>
    
    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>