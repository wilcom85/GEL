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
        $idPersona = $_POST['cedulaPersona'];
        $nombrePersona = $_POST['nombrePersona'];
        $apellidoPersona = $_POST['apellidoPersona'];
        $usuarioPersona = $_POST['usuarioPersona'];
        $clavePersona = $_POST['clavePersona'];
        $tipoUsuario = $_POST['tipoUsuario'];
        //SE PROTEGE LA INYECCIÓN DE MYSQL
        $idPersona = stripslashes($idPersona);
        $nombrePersona = stripslashes($nombrePersona);
	$apellidoPersona = stripslashes($apellidoPersona);
        $usuarioPersona = stripslashes($usuarioPersona);
        $clavePersona = stripslashes($clavePersona);
        $tipoUsuario = stripslashes($tipoUsuario);
        $idPersona = mysql_real_escape_string($idPersona);
        $nombrePersona = mysql_real_escape_string($nombrePersona);
	$apellidoPersona = mysql_real_escape_string($apellidoPersona);
        $usuarioPersona = mysql_real_escape_string($usuarioPersona);
        $clavePersona = mysql_real_escape_string($clavePersona);
        $tipoUsuario = mysql_real_escape_string($tipoUsuario);
        //DEFINIR ARRAY DE CAMPOS
        $arrayCampos = array("id","nombre","apellido","usuario","clave","tipo");
        $arrayValores = array($idPersona,$nombrePersona,$apellidoPersona,$usuarioPersona,$clavePersona,$tipoUsuario);
        $dbconnect->insertarDatos("persona", $arrayCampos, $arrayValores);
        //header("location:admin_login_success.php");
?>
