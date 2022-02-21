<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A´sM | Página principal</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/iconos/favicon.png" type="image/x-icon">
    <!-- Tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Antique+Soft&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="style/style.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- JS -->
    <script type="text/javascript" src="js/app_index.js" defer></script>
</head>
<body>
    <?php
        require_once("funciones_php/funciones.php");
        $conexion=conectarServidor();
        
        $parametro1="";
        $parametro2="subpaginas/";
        $parametro3="assets/";
        echo mostrarNav($parametro1,$parametro2,$parametro3);
    ?>

    <main>
        <div><img id="imagen_principal" src="assets/home/imagen_principal.jpg" alt="Imagen no disponible"></div>

        <!------------------ NOTICIAS ------------------>
        <br><br>
        <h2 id="titulo_contacto"><u>Noticias</u></h2>
        <?php
            $mostrarNoticias="SELECT * FROM noticia ORDER BY fecha_publicacion DESC LIMIT 0,3";

            $datos=$conexion->query($mostrarNoticias);

            $fechaActual=date("Y/m/d");

            if($datos!=null){
                echo("<section id='noticias_index'>");
                echo"<div class='container'>
                        <div class='row'>";
                while($fila=$datos->fetch_array(MYSQLI_ASSOC)){
                    if($fechaActual>=$fila['fecha_publicacion']){
                        echo("
                            <div class='col-4'>
                                <article class='article_noticias_página'>
                                    <img class='img_noticias' src='$fila[imagen]' alt='Imgen no disponible'>
                                    <h3>$fila[titulo]</h3>
                                    <p id='contenido_noticias'>$fila[contenido]</p>
                                    <p class='p_noticias'>".convertir_fecha($fila['fecha_publicacion'])."</p>
                                </article>
                            </div>"
                            );
                    }
                }
                echo("
                </div>
            </div></section>");
            }
        ?>
        <br>

        <!------------------ ÚLITMOS CLIENTES ------------------>
        <h2 id="titulo_contacto"><u>Últimos clientes</u></h2>
        <div class="container">
            <div class="row my-5" id="ult_clientes">

            </div>
        </div>

        <!------------------ TESTIMONIO ------------------>
        <h2 id="titulo_contacto"><u>Testimonios</u></h2>
            <?php

                
                $consulta="SELECT d.Nombre,t.Contenido,t.fecha FROM testimonio t,dueño d WHERE t.Dni_autor=d.Dni ORDER BY rand() LIMIT 1";  

                $datos=$conexion->query($consulta);
                if($datos!=null){
                    while($fila=$datos->fetch_array(MYSQLI_ASSOC)){
                        echo"<div class='div_testimonios'>
                                <h2>$fila[Nombre]</h2>
                                <p>$fila[Contenido]</p>
                                <span>$fila[fecha]</span>
                            </div><br>";
                    }        
                }
            ?>
        <br><br>

        <!------------------ CONTACTO ------------------>
        <h2 id="titulo_contacto"><u>Contacto</u></h2>
        <form id="contacto" action="#" method="post">
            <input class="input_contacto" type="text" name="nombre" placeholder="Nombre" required>
            <br><br>
            <input class="input_contacto" type="text" name="apellidos" placeholder="Apellidos" required>
            <br><br>
            <input class="input_contacto" type="number" maxlength="9" minlength="9" max name="apellidos" placeholder="Telefono" required>
            <br><br>
            <textarea name="consulta" id="textarea_contacto" maxlength="300" cols="30" rows="10" placeholder="Consulta"></textarea>
            <br>
            <input id="input_enviar" type="submit" name="enviar">
        </form>
        <br>
    </main>

    <?php
        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>