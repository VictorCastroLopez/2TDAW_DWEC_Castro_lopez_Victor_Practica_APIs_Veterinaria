<?php
    //Cabeceras
	header('Content-Type: application/json');
	header("Access-Control-Allow-Origin: *");

    require_once("../../funciones_php/funciones.php");

    $conexion = conectarServidor();

    $noticias=[];
    $consulta=$conexion->query("SELECT * FROM noticia");

    while($fila=$consulta->fetch_assoc()){
        $noticias[]=$fila;
    }

    // echo($noticias);

    echo json_encode($noticias);
?>