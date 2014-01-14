<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include './mySqlConnection.php';
	//Forzar el uso de codificación utf-8
	header('Content-Type: text/html; charset=UTF-8');
	//Definición de Variables
	ob_start();
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
	$host= $dbconnect->getServer();
	$username= $dbconnect->getUser(); //Nombre del usuario de MySQL
	$password= $dbconnect->getPassword(); //Clave del usuario de MySQL
	$db_name= $dbconnect->getDataBase(); //Nombre de la Base de Datos
        //SE RECIBEN DATOS DEL FORMULARIO
        $nombreEquipo = $_POST['nombreEquipo'];
        $idReto = $_POST['reto'];
        //SE PROTEGE LA INYECCIÓN DE MYSQL
        $nombreReto = stripslashes($nombreEquipo);
	$numeroReto = stripslashes($idReto);
        $nombreReto = mysql_real_escape_string($nombreEquipo);
	$numeroReto = mysql_real_escape_string($idReto);
        //DEFINIR ARRAY DE CAMPOS
        $arrayCampos = array("nombre","fk_id_reto");
        $arrayValores = array($nombreEquipo,$idReto);
        $dbconnect->insertarDatos("equipos", $arrayCampos, $arrayValores);
        //header("location:admin_login_success.php");
?>
