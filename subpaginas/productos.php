<?php
    session_start();

    if(isset($_COOKIE['Msesion'])){
        session_decode($_COOKIE['Msesion']);
    }
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Productos</title>
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
    
    <!-- Borrar Producto -->
    <?php
    if(isset($_POST['borrar'])){
        $borrarId=$_POST['borrar_id'];
        $borrarProducto="DELETE FROM producto WHERE Id='$borrarId'";
        $consulta3=$conexion->query($borrarProducto);
    }
    ?>

    <main class="main_configuraciones">
        <div class="div_buscador">
            <form id="form_clientes" action="#" method="post">
                <label for="buscar">Introduce a quien quieres buscar:</label>
                <input id="buscador" type="search" name="buscador" placeholder="Nombre producto/Precio producto">
                <input id="boton_buscador" type="submit" name="buscar" value="Buscar">
            </form>
        </div>
        
        <?php
            if(isset($_COOKIE['Msesion'])){
                if($_SESSION['nombre']=="admin"){
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Productos</u></h1>
                            <a href='configurar_productos/insertar_productos.php'><button class='boton_añadir'>Añadir producto</button></a>
                        </div>";
                }else{
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Productos</u></h1>
                        </div>";
                }
            }
        ?>
        <br>
        <?php
            // Producto mostrado por buscador
            if(isset($_POST['buscar'])){
                $buscado=$_POST['buscador'];

                $consulta2="SELECT * FROM producto WHERE Nombre LIKE '%$buscado%' OR precio LIKE '%$buscado%'";
                $dato=$conexion->query($consulta2);

                if($dato!=null){
                    echo"<div class='producto'>";
                    while($fila=$dato->fetch_array(MYSQLI_ASSOC)){
                        echo"<div class='div_productos'>
                                <h2>$fila[Nombre]</h2>
                                <h3>Precio: $fila[precio]€</h3>
                                <div class='div_botones_configuraciones'>";
                                    if(isset($_COOKIE['Msesion'])){
                                        if($_SESSION['nombre']=="admin"){
                                            echo"<form action='configurar_productos/modificar_productos.php' method='post'>
                                                <input class='botones_modificar_borrar' type='submit' name='modificar' value='Modificar'>
                                                <input type='hidden' name='datos' value='$fila[Id]'>
                                            </form>
                                            <form action='#' method='post'>
                                                <input class='botones_modificar_borrar' type='submit' name='borrar' value='Borrar'>
                                            </form>";
                                        }
                                    }
                                echo"</div>
                            </div>";
                    }
                    echo"</div>";
                }
            }else{
                // Mostrar todos los productos 
                $consulta1="SELECT * FROM producto";

                $a=$conexion->query($consulta1);
                if($a!=null){
                    echo"<div class='producto'>";
                    while($fila=$a->fetch_array(MYSQLI_ASSOC)){
                        echo"<div class='div_productos'>
                                <h2>$fila[Nombre]</h2>
                                <h3>Precio: $fila[precio]€</h3>
                                <div class='div_botones_configuraciones'>";
                                    if(isset($_COOKIE['Msesion'])){
                                        if($_SESSION['nombre']=="admin"){
                                            echo"<form action='configurar_productos/modificar_productos.php' method='post'>
                                                <input class='botones_modificar_borrar' type='submit' name='modificar' value='Modificar'>
                                                <input type='hidden' name='datos' value='$fila[Id]'>
                                            </form>
                                            <form action='#' method='post'>
                                                <input class='botones_modificar_borrar' type='submit' name='borrar' value='Borrar'>
                                                <input type='hidden' name='borrar_id' value='$fila[Id]'>
                                            </form>";
                                        }
                                    }
                                echo"</div>
                            </div>";
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