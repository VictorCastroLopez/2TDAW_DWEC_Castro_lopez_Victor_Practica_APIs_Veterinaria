<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Insertar citas</title>
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
            <h1>Insertar una nueva cita</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <form action="#" method="post" enctype="multipart/form-data">
                    <br><br>
                    <label for="opcion_cliente">Introduzca el nombre del cliente: </label>
                    <?php
                        $sacarCliente="SELECT * FROM cliente";

                        $datos_clientes=$conexion->query($sacarCliente);

                        if($datos_clientes!=null){
                            echo"<select name='opcion_cliente'>";
                            while($fila=$datos_clientes->fetch_array(MYSQLI_ASSOC)){
                                echo"<option style='width: 150px' value='$fila[ID]'>";
                                echo"$fila[Nombre]";
                                echo"</option>";
                            }
                            
                            echo"</select>";
                        }
                    ?>
                    <br><br>
                    <label for="opcion_servicio">Introduzca el servicio: </label>
                    <?php
                        $sacarServicio="SELECT * FROM servicio";

                        $datos_servicios=$conexion->query($sacarServicio);

                        if($datos_servicios!=null){
                            echo"<select name='opcion_servicio'>";
                            while($fila=$datos_servicios->fetch_array(MYSQLI_ASSOC)){
                                echo"<option style='width: 150px' value='$fila[ID]'>";
                                echo"$fila[Descripcion]";
                                echo"</option>";
                            }
                            
                            echo"</select>";
                        }
                    ?>
                    <br><br>
                    <label for="fecha_cita">Fecha para la cita: </label>
                    <input type="date" name="fecha_cita" required>
                    <br><br>
                    <label for="hora">Introduzca la hora a la que quiera la cita: </label>
                    <input type="time" name="hora" required>
                    <br><br>
                    <input class="boton_enviar_configuraciones" type="submit" name="enviar" value="Añadir cita">
                    <br><br>
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST['enviar'])){
                $nombre_cliente=$_POST['opcion_cliente'];
                $servicio_elegido=$_POST['opcion_servicio'];
                $fecha_cita=$_POST['fecha_cita'];
                $hora=$_POST['hora'];

                $fecha_actual=date("Y-m-d");
                        
                if($fecha_cita>=$fecha_actual){
                    $insertar_cita="INSERT into citas values (?,?,?,?)";
            
                    $consulta=$conexion->prepare($insertar_cita); 
                    $consulta->bind_param("iiss",$nombre_cliente,$servicio_elegido,$fecha_cita,$hora);
                    $consulta->execute();

                    $consulta->close();
                    echo"<meta http-equiv='refresh' content='0;url=../citas.php'>";
                }else{
                    echo"<div class='div_aviso'>
                            <p><strong>No se puede insertar una cita de una fecha pasada</strong></p>
                        </div>";

                    echo"<meta http-equiv='refresh' content='3;url=insertar_citas.php'>";
                }
            }
        ?>
    </main>
    <?php

        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>