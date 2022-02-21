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
    <title>A´sM | Noticias</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/iconos/favicon.png" type="image/x-icon">
    <!-- Tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Antique+Soft&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../style/style.css">
    <!-- JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="../js/toast.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/app_noticias.js" defer></script>
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
        <!-- <div class="div_h1_boton">
            <h1 style="margin-left: 5%;"><u>Noticias</u></h1>
            <a href="#"><button class="boton_añadir" id="boton_añadir">Añadir noticia</button></a>
        </div> -->

        <?php
            echo"<div class='div_h1_boton'>
                    <h1 style='margin-left: 5%;'><u>Noticias</u></h1>";
            if(isset($_SESSION['nombre'])){
                if($_SESSION['nombre']=="admin"){
                    echo"<div class='div_h1_boton'>
                            <a href='#'><button class='boton_añadir' id='boton_añadir'>Añadir noticia</button></a>
                        </div>";
                    // Formulario de inserción 
                    echo"<div class='container d-flex justify-content-center d-none' id='añadir_formulario'>
                            <form class='col-6' id='formu' method='POST'>
                                <div class='mb-3'>
                                    <label for='titulo' class='form-label'>Título de la noticia</label>
                                    <input type='text' class='form-control' id='titulo' name='titulo'>
                                </div>
                                <div class='mb-3'>
                                    <label for='contenido' class='form-label'>Contenido de la noticia</label>
                                    <textarea class='form-control' id='contenido' name='contenido' rows='3'></textarea>
                                </div>
                                <div class='mb-3'>
                                    <label for='imagen' class='form-label'>URL imagen</label>
                                    <input type='text' class='form-control' id='imagen' name='imagen' placeholder='URL...'>
                                </div>
                                <div class='mb-3'>
                                    <label for='fecha' class='form-label'>Fecha de la publicacion</label>
                                    <input type='date' class='form-control' id='fecha' name='fecha'>
                                </div>
                                <div class='mb-3'>
                                    <input type='submit' id='añadir_prod' class='form-control btn-outline-success' name='enviar' value='Añadir noticia'>
                                </div>
                            </form>
                        </div>";
                }
            }
            echo"</div>";
        ?>

        

        <div class="container" id="nuevasNoticias">
            
        </div>

        <!-- Mensaje informativo -->
        <div id="mensaje" style="z-index: 9999;" class="fixed-top  mx-auto mt-5 toast text-center" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header w-100">
            <strong class="w-100 mr-auto">Mensaje informativo</strong>
          </div>
        </div>

    </main>

    <?php

        echo mostrarFooter($parametro1,$parametro2);
        
        $conexion=desconectarServidor();
    ?>
</body>
</html>