<?php
    //Iniciamos sesion 
    session_start();
    echo "Bienvenido :".$_SESSION["id"];
    echo "<br>";
    $sql = "select * from bd_academicos.alumno where id =".$_SESSION["id"];
    $resultado = mysqli_query($con, $sql);
    $fila = mysqli_fetch_array($resultado);
    $nombrecompleto=$fila["nombrecompleto"];
?>