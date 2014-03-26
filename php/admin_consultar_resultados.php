<?php

/* 
 * Consultar los resultados de todas las calificaciones
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
        
    
