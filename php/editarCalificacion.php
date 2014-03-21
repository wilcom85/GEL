<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './mySqlConnection.php';
header('Content-Type: text/html; charset=UTF-8');
ob_start();
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
	$host= $dbconnect->getServer();
	$username= $dbconnect->getUser(); //Nombre del usuario de MySQL
	$password= $dbconnect->getPassword(); //Clave del usuario de MySQL
	$db_name= $dbconnect->getDataBase(); //Nombre de la Base de Datos
        //SE RECIBEN DATOS DEL FORMULARIO
        $numero = $_POST['numero'];
        $usofacil = $_POST['usofacil'];
        $presentacion = $_POST['presentacion'];
        $trespuesta = $_POST['trespuesta'];
        $saccesibilidad = $_POST['saccessibilidad'];
        $ucolores = $_POST['ucolores'];
        $nitidez = $_POST['nitidez'];        
        $lgrafico = $_POST['lgrafico'];
        $problematica = $_POST['problematica'];
        $viabilidad = $_POST['viabilidad'];
        $completitud = $_POST['completitud'];
        $innovacion = $_POST['innovacion'];
        $combinacion = $_POST['combinacion'];
        $renovacion = $_POST['renovacion'];
        $integraredes = $_POST['integraredes'];
        $funsociales = $_POST['funsociales'];
        $auteredes = $_POST['auteredes'];
        $numero = stripslashes($numero);
        $usofacil = stripslashes($usofacil);
        $presentacion = stripslashes($presentacion);
        $trespuesta = stripslashes($trespuesta);
        $saccesibilidad = stripcslashes($saccesibilidad);
        $ucolores = stripslashes($ucolores);
        $nitidez = stripslashes($nitidez);
        $lgrafico = stripslashes($lgrafico);
        $problematica = stripslashes($problematica);
        $viabilidad = stripslashes($viabilidad);
        $completitud = stripslashes($completitud);
        $innovacion = stripslashes($innovacion);
        $combinacion = stripslashes($combinacion);
        $renovacion = stripslashes($renovacion);
        $integraredes = stripslashes($integraredes);
        $funsociales = stripslashes($funsociales);
        $auteredes = stripslashes($auteredes);
        $numero = mysql_real_escape_string($numero);
        $usofacil = mysql_real_escape_string($usofacil);
        $presentacion = mysql_real_escape_string($presentacion);
        $trespuesta = mysql_real_escape_string($trespuesta);
        $saccesibilidad = mysql_real_escape_string($saccesibilidad);
        $ucolores = mysql_real_escape_string($ucolores);
        $nitidez = mysql_real_escape_string($nitidez);
        $lgrafico = mysql_real_escape_string($lgrafico);
        $problematica = mysql_real_escape_string($problematica);
        $viabilidad = mysql_real_escape_string($viabilidad);
        $completitud = mysql_real_escape_string($completitud);
        $innovacion = mysql_real_escape_string($innovacion);
        $combinacion = mysql_real_escape_string($combinacion);
        $renovacion = mysql_real_escape_string($renovacion);
        $integraredes = mysql_real_escape_string($integraredes);
        $funsociales = mysql_real_escape_string($funsociales);
        $auteredes = mysql_real_escape_string($auteredes);
        $arrayActualizacionCal = array($usofacil,$presentacion,$trespuesta,$saccesibilidad,$ucolores,$nitidez,
                                            $lgrafico, $problematica, $viabilidad,$completitud,$innovacion,$combinacion,$renovacion,
                                            $integraredes,$funsociales,$auteredes);
        
        for($i=0;$i===15;$i++){
            
        }
        