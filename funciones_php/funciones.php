
    <?php
        // Funcion para conectar al servidor
        function conectarServidor(){
            $conexion=new mysqli("localhost","root","","veterinaria");
            $conexion->set_charset("utf8");

            return $conexion;
        }

        // Funcion para mostrar el menu
        function mostrarNav($parametro1="../",$parametro2="",$parametro3="../"){
            echo"<nav id='menu'>
                        <img id='logo' src='$parametro3"."logo_small.png' alt='Imagen no disponible'>

                        <div class='enlaces_menu'>";
                            if(!isset($_SESSION['nombre'])){
                                echo"<a href='$parametro1"."index.php'>Home</a>
                                <a href='$parametro2"."noticias.php'>Noticias</a>
                                <a href='$parametro2"."productos.php'>Productos</a>
                                <a href='$parametro2"."servicios.php'>Servicios</a>
                                |
                                <a style='margin-left: 6%;' href='$parametro2"."log_in.php'>Iniciar sesión</a>";
                            }elseif($_SESSION['nombre']!="admin"){
                                echo"<a href='$parametro1"."index.php'>Home</a>
                                <a href='$parametro2"."noticias.php'>Noticias</a>
                                <a href='$parametro2"."clientes.php'>Mis mascotas</a>
                                <a href='$parametro2"."dueños.php'>Mis datos personales</a>
                                <a href='$parametro2"."productos.php'>Productos</a>
                                <a href='$parametro2"."servicios.php'>Servicios</a>
                                <a style='margin-right: -2%;' href='$parametro2"."citas.php'>Mis citas</a>
                                |
                                <a style='margin-left: 6%;' href='$parametro2"."destruir_sesion.php'>Cerrar sesión</a>";
                            }elseif($_SESSION['nombre']=="admin"){
                                echo"<a href='$parametro1"."index.php'>Home</a>
                                <a href='$parametro2"."noticias.php'>Noticias</a>
                                <a href='$parametro2"."clientes.php'>Clientes</a>
                                <a href='$parametro2"."dueños.php'>Dueños</a>
                                <a href='$parametro2"."productos.php'>Productos</a>
                                <a href='$parametro2"."servicios.php'>Servicios</a>
                                <a href='$parametro2"."testimonios.php'>Testimonios</a>
                                <a style='margin-right: -2%;' href='$parametro2"."citas.php'>Citas</a>
                                |
                                <a style='margin-left: 6%;' href='$parametro2"."destruir_sesion.php'>Cerrar sesión</a>";
                            }
                        echo"</div>
                       </nav>";
        }

        // Funcion para insertar el id
        function insertarId(){
            $insertarId="SELECT auto_increment
                        FROM information_schema.tables
                        WHERE table_schema='veterinaria'";

            return $insertarId;
        }

        // Funcion para pasar las fechas a formato español
        function convertir_fecha($fecha){
            return date("d/m/Y",strtotime($fecha));
        } 

        // Funcion para mostrar el footer
        function mostrarFooter($parametro1="../",$parametro2=""){
            echo"<footer>
                    <br>
                    <nav id='menu_footer'>
                        <h4><u>Enlaces a las diferentes partes de la página</u></h4>
                        <br>";
                        if(!isset($_SESSION['nombre'])){
                            echo"
                            <div class='enlaces_footer'>
                                <a href='$parametro1"."index.php'>Home</a>
                                <a href='$parametro2"."productos.php'>Productos</a>
                                <a href='$parametro2"."servicios.php'>Servicios</a>
                            </div>";
                        }elseif($_SESSION['nombre']!="admin"){
                            echo"
                            <div class='enlaces_footer'>
                                <a href='$parametro1"."index.php'>Home</a>
                                <a href='$parametro2"."clientes.php'>Mis mascotas</a>
                                <a href='$parametro2"."dueños.php'>Mis datos personales</a>
                                <a href='$parametro2"."productos.php'>Productos</a>
                                <a href='$parametro2"."servicios.php'>Servicios</a>
                                <a href='$parametro2"."citas.php'>Mis citas</a>
                            </div>";
                        }elseif($_SESSION['nombre']=="admin"){
                            echo"
                            <div class='enlaces_footer'>
                                <a href='$parametro1"."index.php'>Home</a>
                                <a href='$parametro2"."noticias.php'>Noticias</a>
                                <a href='$parametro2"."clientes.php'>Clientes</a>
                                <a href='$parametro2"."dueños.php'>Dueños</a>
                                <a href='$parametro2"."productos.php'>Productos</a>
                                <a href='$parametro2"."servicios.php'>Servicios</a>
                                <a href='$parametro2"."testimonios.php'>Testimonios</a>
                                <a href='$parametro2"."citas.php'>Citas</a>
                            </div>";
                        }
                    echo"</nav>
                    <br><br>
                    <span>
                        &copy;Copyright 2021-2022&nbsp;&nbsp;&nbsp;  -&nbsp;&nbsp;&nbsp;  Victor Castro López&nbsp;&nbsp;&nbsp;  -&nbsp;&nbsp;&nbsp;  Correo: <a id='correo' href='mailto:victorcastro31@outlook.es'>victorcastro31@outlook.es</a>
                    </span>
                    <br><br>
                </footer>";
        }
        
        // Funcion para desconectar del servidor
        function desconectarServidor(){
            $conexion=new mysqli("localhost","root","","veterinaria");
            $conexion->set_charset("utf8");
            $conexion->close();

            return $conexion;
        }
    ?>