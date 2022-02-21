<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Servicios</title>
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
        <div class="div_buscador">
            <form id="form_clientes" action="#" method="post">
                <label for="buscar">Introduce el servicio que buscas:</label>
                <input id="buscador" type="search" name="buscador" placeholder="Nombre servicio">
                <input id="boton_buscador" type="submit" name="buscar" value="Buscar">
            </form>
        </div>
        <?php
            if(isset($_COOKIE['Msesion'])){
                if($_SESSION['nombre']=="admin"){
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Servicios</u></h1>
                            <a href='configurar_servicios/insertar_servicios.php'><button class='boton_añadir'>Añadir servicio</button></a>
                        </div>";
                }else{
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Servicios</u></h1>
                        </div>";
                }
            }
        ?>
        <br>
        <?php
            // Producto mostrado por buscador
            if(isset($_POST['buscar'])){
                $buscado=$_POST['buscador'];

                $consulta="SELECT * FROM servicio WHERE Descripcion LIKE '%$buscado%'";
                $sacar_datos_consulta=$conexion->query($consulta);

                if($sacar_datos_consulta!=null){
                    echo"<div class='servicio'>";
                    while($fila=$sacar_datos_consulta->fetch_array(MYSQLI_ASSOC)){
                        echo"<div class='div_servicios'>
                                <h3>Descripción: $fila[Descripcion]</h3>
                                <h3>Duración: $fila[Duracion]min</h3>
                                <h3>Precio: $fila[precio]€</h3>";
                                if(isset($_COOKIE['Msesion'])){
                                    if($_SESSION['nombre']=="admin"){
                                        echo"<div class='div_ajustar_boton'>
                                                <form action='configurar_servicios/modificar_servicios.php' method='post'>
                                                    <input class='botones_modificar_borrar' type='submit' name'modificar' value='Modificar'>
                                                    <input type='hidden' name='datos' value='$fila[ID]'>
                                                </form>
                                            </div>";
                                    }
                                }
                        echo"</div>";
                    }
                    echo"</div>";
                }
            }else{
                $consulta1="SELECT * FROM servicio";

                $a=$conexion->query($consulta1);
                if($a!=null){
                    echo"<div class='servicio'>";
                    while($fila=$a->fetch_array(MYSQLI_ASSOC)){
                        echo"<div class='div_servicios'>
                                <h3>Descripción: $fila[Descripcion]</h3>
                                <h3>Duración: $fila[Duracion]min</h3>
                                <h3>Precio: $fila[precio]€</h3>";
                                if(isset($_COOKIE['Msesion'])){
                                    if($_SESSION['nombre']=="admin"){
                                        echo"<div class='div_ajustar_boton'>
                                                <form action='configurar_servicios/modificar_servicios.php' method='post'>
                                                    <input class='botones_modificar_borrar' type='submit' name'modificar' value='Modificar'>
                                                    <input type='hidden' name='datos' value='$fila[ID]'>
                                                </form>
                                            </div>";
                                    }
                                }
                            echo"</div>";
                    }
                    echo"</div>";
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