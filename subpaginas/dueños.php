<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Dueños</title>
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
        <?php
            if(isset($_COOKIE['Msesion'])){
                if($_SESSION['nombre']=="admin"){
                    echo"<div class='div_buscador'>
                            <form id='form_clientes' action='#' method='post'>
                                <label for='buscar'>Introduce a quien quieres buscar:</label>
                                <input id='buscador' type='search' name='buscador' placeholder='Nombre dueño/Nick Dueño/Telefono'>
                                <input id='boton_buscador' type='submit' name='buscar' value='Buscar'>
                            </form>
                        </div>";
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Dueños</u></h1>
                            <a href='configurar_dueños/insertar_dueños.php'><button class='boton_añadir'>Añadir dueños</button></a>
                        </div>";
                }else{
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Mis datos personales</u></h1>
                        </div>";
                }
            }
        ?>
        <br>

        <?php
            if(isset($_POST['buscar'])){
                $buscado=$_POST['buscador'];

                $consulta2="SELECT * FROM dueño WHERE nick!='admin' AND  Nombre LIKE '%$buscado%' OR nick LIKE '%$buscado%' OR Telefono LIKE '%$buscado%'";
                $dato=$conexion->query($consulta2);

                if($dato!=null){
                    echo"<table id='tabla_clientes'>
                        <tr class='tr_clientes'>
                            <th>Dni</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Nick</th>
                            <th></th>
                        </tr>";
                    while($fila=$dato->fetch_array(MYSQLI_ASSOC)){
                        echo"
                            <tr class='tr_clientes'>
                                <td>$fila[Dni]</td>
                                <td>$fila[Nombre]</td>
                                <td>$fila[Telefono]</td>
                                <td>$fila[nick]</td>
                                <td class='div_botones_configuraciones'>
                                    <form style='width: 80%; margin-top: 28%;' action='configurar_dueños/modificar_dueños.php' method='post'>
                                        <input class='botones_modificar_borrar' type='submit' name='modificar' value='Modificar'>
                                        <input type='hidden' name='datos' value='$fila[Dni]'>
                                    </form>
                                </td>
                            </tr>";
                    }
                    echo"</table>";
                }
            }else{
                /* Mostrar clientes */
                    echo"<table id='tabla_clientes'>
                        <tr class='tr_clientes'>
                            <th>Dni</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Nick</th>
                            <th></th>
                        </tr>";

                        if(isset($_COOKIE['Msesion'])){
                            if($_SESSION['nombre']=="admin"){
                                $sacarDatosDueño="SELECT * FROM dueño WHERE nick!='admin' ";
                                $a=$conexion->query($sacarDatosDueño);
                                while($fila=$a->fetch_array(MYSQLI_ASSOC)){
                                    echo"
                                    <tr class='tr_clientes'>
                                        <td>$fila[Dni]</td>
                                        <td>$fila[Nombre]</td>
                                        <td>$fila[Telefono]</td>
                                        <td>$fila[nick]</td>
                                        <td class='div_botones_configuraciones'>
                                            <form style='width: 80%; margin-top: 28%;' action='configurar_dueños/modificar_dueños.php' method='post'>
                                                <input class='botones_modificar_borrar' type='submit' name='modificar' value='Modificar'>
                                                <input type='hidden' name='datos' value='$fila[Dni]'>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            }elseif($_SESSION['nombre']!="admin"){
                                $sacarDatosDueño="SELECT * FROM dueño WHERE nick='$_SESSION[nombre]'";
                                $b=$conexion->query($sacarDatosDueño);
                                if($b!=null){
                                    while($fila2=$b->fetch_Array(MYSQLI_ASSOC)){
                                        echo"
                                        <tr class='tr_clientes'>
                                            <td>$fila2[Dni]</td>
                                            <td>$fila2[Nombre]</td>
                                            <td>$fila2[Telefono]</td>
                                            <td>$fila2[nick]</td>
                                            <td class='div_botones_configuraciones'>
                                                <form style='width: 80%; margin-top: 28%;' action='configurar_dueños/modificar_dueños.php' method='post'>
                                                    <input class='botones_modificar_borrar' type='submit' name='modificar' value='Modificar'>
                                                    <input type='hidden' name='datos' value='$fila2[Dni]'>
                                                </form>
                                            </td>
                                        </tr>";
                                    }
                                }
                            }
                        }
                    echo('</table>');
            }
        ?>
    <br>
    </main>

    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>