<?php
session_start();
    $cnacimiento = $_GET["cnacimiento"];
    $cidentidad = $_GET["cidentidad"];
    $sql ="update bd_academicos.alumno set ";
    $sql.="cnacimiento='$cnacimiento', cidentidad='$cidentidad' ";
    $sql.="where id=".$_SESSION["id"];
    $resultado = mysqli_query($con,$sql);
?>