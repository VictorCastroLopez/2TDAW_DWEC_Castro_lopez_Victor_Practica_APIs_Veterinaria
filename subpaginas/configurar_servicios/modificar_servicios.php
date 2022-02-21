<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Modificar servicios</title>
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
                    $idServicios=$_POST['datos'];  
                    $consulta1="SELECT * FROM servicio WHERE ID='$idServicios'";
                    $dato=$conexion->query($consulta1);
                    $fila=$dato->fetch_array();
                    if($dato->num_rows>0){
                        echo"<form action='#' method='post' enctype='multipart/form-data'>
                                <label for='descripcion'>Descripcion: </label>
                                <input type='text' name='descripcion' value='$fila[Descripcion]'>
                                <br><br>
                                <label for='duracion'>Duracion: </label>
                                <input type='text' name='duracion' value='$fila[Duracion]'>
                                <br><br>
                                <label for='precio'>Precio: </label>
                                <input type='text' name='precio' value='$fila[precio]'>
                                <br><br>
                                <input class='boton_enviar_configuraciones' type='submit' name='enviar_modificacion_servicios' value='Enviar modificación'>
                                <input type='hidden' name='datos' value='$fila[ID]'>
                                <br><br>
                            </form>";
                    }
                ?>
            </div>
        </div>
        <?php
            if(isset($_POST['enviar_modificacion_servicios'])){
                $descripcion=$_POST['descripcion'];
                $duracion=$_POST['duracion'];
                $precio=$_POST['precio'];

                $insertid=insertarId();

                // Modificar Productos
                $modificarServicio="UPDATE servicio 
                                    SET Descripcion=?,Duracion=?,precio=? 
                                    WHERE ID='$idServicios'";

                $consulta2=$conexion->prepare($modificarServicio);
                $consulta2->bind_param("sid",$descripcion,$duracion,$precio);
                $consulta2->execute();

                $consulta2->close();
                echo"<meta http-equiv='refresh' content='0;url=../servicios.php'>";
            }
        ?>
    </main>
    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>