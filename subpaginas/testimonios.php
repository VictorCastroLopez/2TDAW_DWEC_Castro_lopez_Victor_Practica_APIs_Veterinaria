<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Testimonios</title>
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

    <main class="main_configuraciones">
        <div class="div_h1_boton">
            <h1 style="margin-left: 5%;"><u>Testimonios</u></h1>
            <a href="configurar_testimonios/insertar_testimonios.php"><button class="boton_añadir">Añadir testimonio</button></a>
        </div>

        <?php
            $consulta="SELECT d.Nombre,t.Contenido,t.fecha FROM testimonio t,dueño d WHERE t.Dni_autor=d.Dni";

            $datos=$conexion->query($consulta);
            if($datos!=null){
                while($fila=$datos->fetch_array(MYSQLI_ASSOC)){
                    echo"<div class='div_testimonios'>
                            <h2>$fila[Nombre]</h2>
                            <p>$fila[Contenido]</p>
                            <span>".convertir_fecha($fila['fecha'])."</span>
                        </div><br>";
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