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
        try{
            $nombreEquipo = $_POST['nombreEquipo'];
            $idReto = $_POST['reto'];
            $idJuradoFuncional = $_POST['juradoFuncional'];
            $idJuradoTecnico = $_POST['juradoTecnico'];
            $idJuradoExterno = $_POST['juradoExterno'];
            //SE PROTEGE LA INYECCIÓN DE MYSQL
            $nombreReto = stripslashes($nombreEquipo);
            $idReto = stripslashes($idReto);
            $idJuradoFuncional = stripslashes($idJuradoFuncional);
            $idJuradoTecnico = stripslashes($idJuradoTecnico);
            $idJuradoExterno = stripslashes($idJuradoExterno);
            $nombreReto = mysql_real_escape_string($nombreEquipo);
            $idReto = mysql_real_escape_string($idReto);
            $idJuradoFuncional = mysql_real_escape_string($idJuradoFuncional);
            $idJuradoTecnico = mysql_real_escape_string($idJuradoTecnico);
            $idJuradoExterno = mysql_real_escape_string($idJuradoExterno);
            //DEFINIR ARRAY DE CAMPOS
            $arrayCampos = array("nombre","fk_id_reto","fk_id_juradoFuncional","fk_id_juradoTecnico","fk_id_juradoExterno");
            $arrayValores = array($nombreEquipo,$idReto,$idJuradoFuncional,$idJuradoTecnico,$idJuradoExterno);
            $dbconnect->insertarDatos("equipos", $arrayCampos, $arrayValores);
            //header("location:admin_login_success.php");
        } catch (Exception $ex) {
            echo "Excepción Capturada: ", $ex->getMessage(),"\n";
        }
    ?>
