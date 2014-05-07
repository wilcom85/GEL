<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../Clases/miCalificacionClass.php';
include_once '../Clases/criteriosClass.php';
include_once '../Clases/equiposClass.php';
include_once '../Clases/sessionClass.php';
include_once '../Vista/dialogue.php';

$criterios = new criteriosClass();
$numeroCriterios = $criterios->getNumCriterios();
$equipos = new equiposClass();
$sesion = new sessionClass();
$calificaciones = new miCalificacionClass();
session_start();
$idJurado = $sesion->getIdUsuario();
$numeroEquipos = $equipos->getNumEquipos($idJurado);
$arrayMisCalificaciones = $calificaciones->misCalificaciones($idJurado);

for($i=0;$i<$numeroCriterios;$i++){
    for($n=0;$n<$numeroEquipos;$n++){
        $arrayCalificacionesEquipo[$i][$n] = $_POST['item'.$i.'team'.$n];
        $arrayCalificacionesEquipo[$i][$n] = stripslashes($arrayCalificacionesEquipo[$i][$n]);
        $arrayCalificacionesEquipo[$i][$n] = mysql_real_escape_string($arrayCalificacionesEquipo[$i][$n]);
    }
}

for($n=0;$n<$numeroEquipos;$n++){
    $array[$n] = $calificaciones->setCalificacionesOrdenadas($arrayCalificacionesEquipo, $n, $numeroCriterios);
    $calificaciones->setCalificacionEquipo($array[$n], $numeroCriterios, $arrayMisCalificaciones[$n][2]);
}

$dialogue = new dialogue();
$message = "Su calificaci&oacuten se guard&oacute correctamente";
$redir='../Vista/user_login_success.php';
$dialogue->dialogueSuccess($message, $redir);

