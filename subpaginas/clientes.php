<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Clientes</title>
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
                                <input id='buscador' type='search' name='buscador' placeholder='Nombre Mascota/Nombre Dueño'>
                                <input id='boton_buscador' type='submit' name='buscar' value='Buscar'>
                            </form>
                        </div>";
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Clientes</u></h1>
                            <a href='configurar_clientes/insertar_clientes.php'><button class='boton_añadir'>Añadir cliente</button></a>
                        </div>";
                }else{
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Mis mascotas</u></h1>
                        </div>";
                }
            }
        ?>
        <br>

        <?php
            if(isset($_POST['buscar'])){
                $buscado=$_POST['buscador'];

                $consulta2="SELECT c.Nombre,c.Edad,c.Tipo,c.Foto,d.Nombre dueño_nombre,c.ID 
                            FROM cliente c,dueño d 
                            WHERE c.Dni_dueño=d.dni AND c.Nombre LIKE '%$buscado%' OR d.Nombre LIKE '%$buscado%' OR d.Telefono LIKE '%$buscado%' AND d.nick!='admin'";
                $dato=$conexion->query($consulta2);

                if($dato!=null){
                    echo"<table id='tabla_clientes'>
                        <tr class='tr_clientes'>
                            <th>Foto Mascota</th>
                            <th>Nombre Mascota</th>
                            <th>Edad Mascota</th>
                            <th>Raza Mascota</th>
                            <th>Nombre Dueño</th>
                            <th></th>
                        </tr>";
                    while($fila=$dato->fetch_array(MYSQLI_ASSOC)){
                        echo"
                            <tr class='tr_clientes'>
                                <td class='td_imags'><img class='img_clientes' src='../assets/Imagenes/img/$fila[Foto]' alt='imagen no disponible'></td>
                                <td>$fila[Nombre]</td>
                                <td>$fila[Edad]</td>
                                <td>$fila[Tipo]</td>
                                <td>$fila[dueño_nombre]</td>
                                <td class='div_botones_configuraciones'>
                                    <form style='width: 80%; margin-top: 28%;' action='configurar_clientes/modificar_clientes.php' method='post'>
                                        <input class='botones_modificar_borrar' type='submit' name='modificar' value='Modificar'>
                                        <input type='hidden' name='datos' value='$fila[ID]'>
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
                            <th>Foto Mascota</th>
                            <th>Nombre Mascota</th>
                            <th>Edad Mascota</th>
                            <th>Raza Mascota</th>
                            <th>Nombre Dueño</th>
                            <th></th>
                        </tr>";
                                if(isset($_COOKIE['Msesion'])){
                                    if($_SESSION['nombre']=="admin"){
                                        $sacarClienteDueño="SELECT c.Nombre,c.Foto,c.Edad,c.Tipo,d.Nombre dueño_nombre,c.ID FROM cliente c,dueño d WHERE c.Dni_dueño=d.Dni";
                                        $a=$conexion->query($sacarClienteDueño);
                                        while($fila=$a->fetch_array(MYSQLI_ASSOC)){
                                            echo"<tr class='tr_clientes'>";
                                            echo"<td class='td_imags'><img class='img_clientes' src='../assets/Imagenes/img/$fila[Foto]' alt='imagen no disponible'></td>
                                            <td>$fila[Nombre]</td>
                                            <td>$fila[Edad]</td>
                                            <td>$fila[Tipo]</td>
                                            <td>$fila[dueño_nombre]</td>";
                                            echo"<td class='div_botones_configuraciones'>";
                                                    echo"<form style='width: 80%; margin-top: 28%;' action='configurar_clientes/modificar_clientes.php' method='post'>
                                                            <input class='botones_modificar_borrar' type='submit' name='modificar' value='Modificar'>
                                                            <input type='hidden' name='datos' value='$fila[ID]'>
                                                        </form>
                                                </td>";
                                            echo"</tr>";
                                        }
                                    }elseif($_SESSION['nombre']!="admin"){
                                        $sacarClienteDueño="SELECT c.Nombre,c.Edad,c.Tipo,c.Foto,d.Nombre dueño_nombre FROM cliente c,dueño d WHERE c.Dni_dueño=d.Dni AND d.nick='$_SESSION[nombre]'";
                                        $b=$conexion->query($sacarClienteDueño);

                                        if($b!=null){
                                            while($fila2=$b->fetch_array(MYSQLI_ASSOC)){
                                                echo"<tr class='tr_clientes'>";
                                                echo"<td class='td_imags'><img class='img_clientes' src='../assets/Imagenes/img/$fila2[Foto]' alt='imagen no disponible'></td>
                                                    <td>$fila2[Nombre]</td>
                                                    <td>$fila2[Edad]</td>
                                                    <td>$fila2[Tipo]</td>
                                                    <td>$fila2[dueño_nombre]</td>";
                                                echo"</tr>";
                                            }
                                        }
                                    }
                                }
                                
                                
                            echo"</tr>";
                    
                    echo"</table>";
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