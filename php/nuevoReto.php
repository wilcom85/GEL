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
        $tbl_name = "members"; //nombre de la tabla
        $dbconnect->establecerConexion($tbl_name);
	$host= $dbconnect->getServer();
	$username= $dbconnect->getUser(); //Nombre del usuario de MySQL
	$password= $dbconnect->getPassword(); //Clave del usuario de MySQL
	$db_name= $dbconnect->getDataBase(); //Nombre de la Base de Datos
        //SE RECIBEN DATOS DEL FORMULARIO
        $nombreReto = $_POST['nombreReto'];
        $numeroReto = $_POST['iteracion'];
        //SE PROTEGE LA INYECCIÓN DE MYSQL
        $nombreReto = stripslashes($nombreReto);
	$numeroReto = stripslashes($numeroReto);
        $nombreReto = mysql_real_escape_string($nombreReto);
	$numeroReto = mysql_real_escape_string($numeroReto);
        //DEFINIR ARRAY DE CAMPOS
        $arrayCampos = array("nombre","iteracion");
        var_dump($arrayCampos);
        $arrayValores = array($nombreReto,$numeroReto);
        var_dump($arrayValores);
        $dbconnect->insertarDatos($tbl_name, $arrayCampos, $arrayValores);     
?>
