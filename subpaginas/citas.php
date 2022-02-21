<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Citas</title>
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

    <!-- Borrar cita futura -->
    <?php
        if(isset($_POST['borrar'])){
            $borrar_cita_idCliente=$_POST['borrar_cita_idCliente'];
            $borrar_cita_idServicio=$_POST['borrar_cita_idServicio'];
            $borrar_cita_fecha=$_POST['borrar_cita_fecha'];
            $borrar_cita_hora=$_POST['borrar_cita_hora'];

            $borrarCita="DELETE FROM citas 
                         WHERE cliente='$borrar_cita_idCliente' AND servicio='$borrar_cita_idServicio' AND Fecha='$borrar_cita_fecha' AND Hora='$borrar_cita_hora'";

            $consulta=$conexion->query($borrarCita);
        }
    ?>

    <main class="main_configuraciones">
        <div class="div_buscador">
            <form id="form_clientes" action="#" method="post">
                <label for="buscar">Introduce la cita buscada:</label>
                <input id="buscador" type="search" name="buscador" placeholder="Nombre cliente/fecha cita/Descripcion servicio">
                <input id="boton_buscador" type="submit" name="buscar" value="Buscar">
            </form>
        </div>
        <?php
            if(isset($_COOKIE['Msesion'])){
                if($_SESSION['nombre']=="admin"){
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Citas</u></h1>
                            <a href='configurar_citas/insertar_citas.php'><button class='boton_añadir'>Añadir cita</button></a>
                        </div>";
                }else{
                    echo"<div class='div_h1_boton'>
                            <h1 style='margin-left: 5%;'><u>Citas</u></h1>
                        </div>";
                }
            }
        ?>

        <!-- CALENDARIO -->
        <?php
        $dias_semana=["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];

        $añoActual=date("Y");
        $mesActual=date("m");
        $diaActual=date("d");


        if(isset($_POST['retroceder'])){
            $añoActual=$_POST['año_atras'];

            $mesActual=$_POST['atras'];
        }

        if(isset($_POST['avanzar'])){
            $añoActual=$_POST['año_siguiente'];

            $mesActual=$_POST['siguiente'];
        }

        $mesAtras=$mesActual-1;
        $mesSiguiente=$mesActual+1;
        $añoSiguiente=$añoActual;
        $añoAnterior=$añoActual;

        if(($mesActual-1)<1){
            $añoAnterior=$añoActual-1;
            $mesAtras=12;
        }elseif(($mesActual+1)>12){
            $mesSiguiente=1;
            $añoSiguiente=$añoActual+1;
        }

        $tiempoActual=mktime(0,0,0,$mesActual,1,$añoActual);

        $dias_meses=date("t",$tiempoActual);
        
        $dia=date("N",$tiempoActual);

        setlocale(LC_ALL,"es-ES");
        $nombreMes=strftime("%B",$tiempoActual);

        echo"<div class='alinear_calendario'>";

            echo"<form action='#' method='POST'>
                    <input class='botones_avanzar_retroceder' type='submit' name='retroceder' value='<'>
                    <input type='hidden' name='atras' value='".$mesAtras."'>
                    <input type='hidden' name='año_atras' value='$añoAnterior'>
                </form>";

            echo"<h2>$nombreMes de $añoActual</h2>";

            echo"<form action='#' method='POST'>
                    <input class='botones_avanzar_retroceder' type='submit' name='avanzar' value='>'>
                    <input type='hidden' name='siguiente' value='".$mesSiguiente."'>
                    <input type='hidden' name='año_siguiente' value='$añoSiguiente'>
                </form>";

        echo"</div>";
   
        echo"<div class='centrar_caledandario'>";

            $celda=0;
            echo("<table border><tr>");
            for($dias=0;$dias<7;$dias++){
                echo("<th>$dias_semana[$dias]</th>");
                $celda++;
                if($celda==7){
                    echo("</tr><tr>");
                    $celda=0;
                }
            }
            for($i=1;$i<$dia;$i++){
                echo"<td></td>";
                $celda++;
                if($celda==7){
                    echo("</tr><tr>");
                    $celda=0;
                }
            }
            for($i=1;$i<=$dias_meses;$i++){
                echo("<td>$i</td>");
                $celda++;
                if($celda==7){
                    echo("</tr><tr>");
                    $celda=0;
                }
            }
            echo("</table>");
        echo"</div>";
    ?>

    <!-- BUSCAR U OBSERVAR LAS CITAS -->

    <?php
        if(isset($_POST['buscar'])){
            $buscado=$_POST['buscador'];

            $datos_citas_buscado="SELECT c.Nombre, s.Descripcion, ci.Fecha, ci.Hora, ci.cliente, ci.servicio
                                  FROM cliente c, servicio s, citas ci
                                  WHERE c.Id=ci.cliente AND s.ID=ci.servicio AND c.Nombre LIKE '%$buscado%' OR s.Descripcion LIKE '%$buscado%' OR ci.Fecha LIKE '%$buscado%'";
            
            $sacar_datos_buscado=$conexion->query($datos_citas_buscado);

            $fecha_actual=date("Y-m-d");

            if($sacar_datos_buscado!=null){
                while($fila=$sacar_datos_buscado->fetch_array()){
                    if($fecha_actual<$fila["Fecha"]){
                        echo"<div class='datos_citas'>
                                <h3>Cliente: $fila[Nombre]</h3>
                                <h3>Servicio: $fila[Descripcion]</h3>
                                <h3>Fecha de la cita: ".convertir_fecha($fila['Fecha'])."</h3>
                                <h3>Hora de la cita: $fila[Hora]</h3>
                                <form action='#' method='post'>
                                    <input type='hidden' name='borrar_cita_idCliente' value='$fila[cliente]'>
                                    <input type='hidden' name='borrar_cita_idServicio' value='$fila[servicio]'>
                                    <input type='hidden' name='borrar_cita_fecha' value='$fila[Fecha]'>
                                    <input type='hidden' name='borrar_cita_hora' value='$fila[Hora]'>
                                    <input style='margin-top: 7px; margin-right: 30px;' class='botones_modificar_borrar' type='submit' name='borrar' value='Borrar'>
                                </form>
                            </div>";
                    }else{
                        echo"<div class='datos_citas'>
                            <h3>Cliente: $fila[Nombre]</h3>
                            <h3>Servicio: $fila[Descripcion]</h3>
                            <h3>Fecha de la cita: $fila[Fecha]</h3>
                            <h3>Hora de la cita: $fila[Hora]</h3>
                        </div>";
                    }
                }
            }

        }else{
            if(isset($_COOKIE['Msesion'])){
                if($_SESSION['nombre']=="admin"){
                    $datos_citas="SELECT c.Nombre, s.Descripcion, ci.Fecha, ci.Hora, ci.cliente, ci.servicio
                          FROM cliente c, servicio s, citas ci
                          WHERE c.Id=ci.cliente AND s.ID=ci.servicio
                          ORDER BY Fecha ASC";

                    $sacar_datos=$conexion->query($datos_citas);

                    $fecha_actual=date("Y-m-d");

                    if($sacar_datos!=null){
                        while($fila=$sacar_datos->fetch_array()){
                            $fila['Fecha'];
                            if($fecha_actual<$fila["Fecha"]){
                                echo"<div class='datos_citas'>
                                        <h3>Cliente: $fila[Nombre]</h3>
                                        <h3>Servicio: $fila[Descripcion]</h3>
                                        <h3>Fecha de la cita: ".convertir_fecha($fila['Fecha'])."</h3>
                                        <h3>Hora de la cita: $fila[Hora]</h3>
                                        <form action='#' method='post'>
                                            <input type='hidden' name='borrar_cita_idCliente' value='$fila[cliente]'>
                                            <input type='hidden' name='borrar_cita_idServicio' value='$fila[servicio]'>
                                            <input type='hidden' name='borrar_cita_fecha' value='$fila[Fecha]'>
                                            <input type='hidden' name='borrar_cita_hora' value='$fila[Hora]'>
                                            <input style='margin-top: 7px; margin-right: 30px;' class='botones_modificar_borrar' type='submit' name='borrar' value='Borrar'>
                                        </form>
                                    </div>";
                            }else{
                                echo"<div class='datos_citas'>
                                    <h3>Cliente: $fila[Nombre]</h3>
                                    <h3>Servicio: $fila[Descripcion]</h3>
                                    <h3>Fecha de la cita: ".convertir_fecha($fila['Fecha'])."</h3>
                                    <h3>Hora de la cita: $fila[Hora]</h3>
                                </div>";
                            }
                        }
                    }
                }elseif($_SESSION['nombre']!="admin"){
                    $datos_citas="SELECT c.Nombre, s.Descripcion, ci.Fecha, ci.Hora, ci.cliente, ci.servicio
                                  FROM cliente c, servicio s, citas ci, dueño d
                                  WHERE c.Id=ci.cliente AND s.ID=ci.servicio AND c.Dni_dueño=d.Dni AND d.nick='$_SESSION[nombre]'
                                  ORDER BY Fecha ASC";

                    $sacar_datos=$conexion->query($datos_citas);

                    $fecha_actual=date("Y-m-d");

                    if($sacar_datos!=null){
                        while($fila=$sacar_datos->fetch_array()){
                            echo"<div class='datos_citas'>
                                    <h3>Cliente: $fila[Nombre]</h3>
                                    <h3>Servicio: $fila[Descripcion]</h3>
                                    <h3>Fecha de la cita: ".convertir_fecha($fila['Fecha'])."</h3>
                                    <h3>Hora de la cita: $fila[Hora]</h3>
                                    <form action='#' method='post'>
                                        <input type='hidden' name='borrar_cita_idCliente' value='$fila[cliente]'>
                                        <input type='hidden' name='borrar_cita_idServicio' value='$fila[servicio]'>
                                        <input type='hidden' name='borrar_cita_fecha' value='$fila[Fecha]'>
                                        <input type='hidden' name='borrar_cita_hora' value='$fila[Hora]'>
                                    </form>
                                </div>";
                        }
                    }
                }
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