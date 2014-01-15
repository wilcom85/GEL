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
        $nombrePersona = $_POST['nombrePersona'];
        $apellidoPersona = $_POST['apellidoPersona'];
        //SE PROTEGE LA INYECCIÓN DE MYSQL
        $nombrePersona = stripslashes($nombrePersona);
	$apellidoPersona = stripslashes($apellidoPersona);
        $nombrePersona = mysql_real_escape_string($nombrePersona);
	$apellidoPersona = mysql_real_escape_string($apellidoPersona);
        //DEFINIR ARRAY DE CAMPOS
        $arrayCampos = array("nombre","apellido");
        $arrayValores = array($nombrePersona,$apellidoPersona);
        $dbconnect->insertarDatos("persona", $arrayCampos, $arrayValores);
        //header("location:admin_login_success.php");
?>
