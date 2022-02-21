<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Insertar clientes</title>
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
            <h1>Insertar un nuevo cliente</h1>
        </div>
        <div class="div_centrar_configuraciones">
            <div class="div_formulario_configuraciones">
                <form action="#" method="post" enctype="multipart/form-data">
                    <br><br>
                    <label for="id">Id asignado: </label>
                    <?php
                        $insertarId="SELECT `AUTO_INCREMENT` FROM information_schema.tables WHERE table_schema='veterinaria' AND table_name='cliente';";

                        $consulta=$conexion->query($insertarId);
                        $fila2=$consulta->fetch_array(MYSQLI_ASSOC);

                        echo"<input type='text' name='id' value='$fila2[AUTO_INCREMENT]' readonly required>";
                    ?>
                    <br><br>
                    <label for="imagen">Introduzca la raza del cliente: </label>
                    <input type="text" name="raza" required>
                    <br><br>
                    <label for="nombre">Introduzca el nombre del cliente: </label>
                    <input type="text" name="nombre" required>
                    <br><br>
                    <label for="edad">Introduzca la edad del cliente: </label>
                    <input type="number" name="edad" required>
                    <br><br>
                    <label for="opcion_dni">Nombre del dueño: </label>
                    <?php
                        $sacarDniDueño="SELECT Dni, Nombre FROM dueño WHERE nick!='admin'";

                        $dniDueño=$conexion->query($sacarDniDueño);

                        if($dniDueño!=null){
                            echo"<select name='opcion_dni'>";
                            while($fila=$dniDueño->fetch_array(MYSQLI_ASSOC)){
                                echo"<option style='width: 150px' value='$fila[Dni]'>";
                                    echo"$fila[Nombre]";
                                echo"</option>";
                            }
                            
                            echo"</select>";
                        }
                    ?>
                    <br><br>
                    <label for="imagen">Imagen del cliente: </label>
                    <input type="text" name="imagen" required>
                    <br><br>
                    <input class="boton_enviar_configuraciones" type="submit" name="enviar">
                    <br><br>
                </form>
            </div>
        </div>
    </main>

    <?php
        // Insertar clientes en BD
        if(isset($_POST['enviar'])){
            $imag_cliente=$_POSTST['imagen'];
            $raza=$_POST['raza'];
            $nombre=$_POST['nombre'];
            $edad=$_POST['edad'];
            $Dni_dueño=$_POST['opcion_dni'];

            $insertid=insertarId();

            $insertarCliente="INSERT INTO cliente values(null,?,?,?,?,?)";

            $consulta=$conexion->prepare($insertarCliente);
            $consulta->bind_param("ssiss",$raza,$nombre,$edad,$Dni_dueño,$imag_cliente);
            $consulta->execute();

            $filas_afectadas = $consulta->affected_rows;

            if($filas_afectadas==1){
                echo "$conexion->insert_id";
            }

            $consulta->close();
            echo"<meta http-equiv='refresh' content='0;url=../clientes.php'>";
        }
    ?>

    <?php

        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>