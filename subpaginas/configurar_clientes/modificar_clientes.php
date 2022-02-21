<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Modificar clientes</title>
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
            <h1>Modificar datos del cliente</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <?php
                    $idCliente=$_POST['datos'];
                    $consulta1="SELECT * FROM cliente WHERE ID='$idCliente'";
                    $dato=$conexion->query($consulta1);
                    $fila=$dato->fetch_array();
                    if($dato->num_rows>0){
                        echo"<form action='#' method='post' enctype='multipart/form-data'>
                                <br><br>
                                <label for='raza'>Raza del cliente: </label>
                                <input type='text' name='raza' value='$fila[Tipo]'>
                                <br><br>
                                <label for='nombre'>Nombre del cliente: </label>
                                <input type='text' name='nombre' value='$fila[Nombre]'>
                                <br><br>
                                <label for='edad'>Edad del cliente: </label>
                                <input type='number' name='edad' value='$fila[Edad]'>
                                <br><br>
                                <label for='Dni_dueño'>Dni del dueño: </label>
                                <input type='text' name='Dni_dueño' value='$fila[Dni_dueño]' readonly>
                                <br><br>
                                <label for='imagen'>Imagen del cliente: </label>
                                <input type='file' name='imagen' value='$fila[Foto]'>
                                <br><br>
                                <input class='boton_enviar_configuraciones' type='submit' name='enviar_modificacion_clientes' value='Enviar modificación'>
                                <input type='hidden' name='datos' value='$fila[ID]'>
                                <br><br>
                            </form>";
                    }
                ?>
            </div>
        </div>
    </main>
    <?php
        if(isset($_POST['enviar_modificacion_clientes'])){

            // print_r($_POST);
            $idCliente=$_POST['datos'];
            $raza=$_POST['raza'];
            $nombre=$_POST['nombre'];
            $edad=$_POST['edad'];
            $Dni_dueño=$_POST['Dni_dueño'];

            if($_FILES['imagen']['size']>0){
                $imag_cliente=$_FILES['imagen']['name'];
                $temp=$_FILES['imagen']['tmp_name'];

                if(!file_exists("../../assets/Imagenes/img")){
                    mkdir("../../assets/Imagenes/img");
                }

                /* Compruebo que pasan imagen */
                if($_FILES["imagen"]["type"]==="image/png"){
                    $imag_cliente=$imag_cliente.".png";
                }elseif($_FILES["imagen"]["type"]==="image/jpg"){
                    $imag_cliente=$imag_cliente.".jpg";
                }

                // /* Pongo rutas de directorios */
                $ruta_img="../../assets/Imagenes/img/$imag_cliente";
                move_uploaded_file($temp,$ruta_img);
            }else{
                $fotoFinal="SELECT Foto FROM cliente WHERE ID=$idCliente";
                $ejecutarSentencia=$conexion->query($fotoFinal);
                $mostrarFotoFinal=$ejecutarSentencia->fetch_array();
                $imag_cliente=$mostrarFotoFinal['Foto'];
            }

            $insertid=insertarId();

            // Modificar Producto 
            $modificarCliente="UPDATE cliente 
                               SET Tipo=?,Nombre=?,Edad=?,Dni_dueño=?,Foto=? 
                               WHERE ID='$idCliente'";

            $consulta2=$conexion->prepare($modificarCliente);
            $consulta2->bind_param("ssiss",$raza,$nombre,$edad,$Dni_dueño,$imag_cliente);
            $consulta2->execute();

            $consulta2->close();
            echo"<meta http-equiv='refresh' content='0;url=../clientes.php'>";
        }
    ?>
    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>