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
            $fieldnameid = "id";
            $tblnameid = "equipos";
            $conditionid = "nombre = '" .$nombreReto ."'";
            $idequipo = $dbconnect->seleccionarDatosCondicion($fieldnameid, $tblnameid, $conditionid);
            $datosequipo = mysql_fetch_array($idequipo);
            
            //Insertar valores en la tabla de calificaciones - Jurado Funcional.
            try{
                $arrayCamposCalf = array("fk_id_equipo","fk_id_jurado");
                $arrayValoresCalf = array($datosequipo[0],$idJuradoFuncional);
                $dbconnect->insertarDatos("calificacion", $arrayCamposCalf, $arrayValoresCalf);
                //Crear set de calificaciones funcionales para el equipo.
                $fieldnamecalf = "id";
                $tblnamecalf = "calificacion";
                $conditioncalf = "fk_id_equipo = '" .$datosequipo[0] ."' AND fk_id_jurado = '".$idJuradoFuncional ."'";
                $idcalf = $dbconnect->seleccionarDatosCondicion($fieldnamecalf, $tblnamecalf, $conditioncalf);
                $datoscalf = mysql_fetch_array($idcalf);
                for($i=0;$i<=15;$i++){
                    $arrayCamposValf = array("fk_id_criterio","fk_id_calificacion","valor_calificacion");
                    $arrayValoresCalf2 = array($i,$datoscalf[0],"0");
                    $dbconnect->insertarDatos("valor_calificacion", $arrayCamposValf, $arrayValoresCalf2);
                }
            }
            catch (Exception $ex) {
                echo "Excepción Capturada: ", $ex->getMessage(),"\n";
            }
            
            //Insertar valores en la tabla de calificaciones - Jurado Tecnico.
            try{
                $arrayCamposCalt = array("fk_id_equipo","fk_id_jurado");
                $arrayValoresCalt = array($datosequipo[0],$idJuradoTecnico);
                $dbconnect->insertarDatos("calificacion", $arrayCamposCalt, $arrayValoresCalt); 
                
                //Crear set de calificaciones tecnicas para el equipo.
                $fieldnamecalt = "id";
                $tblnamecalt = "calificacion";
                $conditioncalt = "fk_id_equipo = '" .$datosequipo[0] ."' AND fk_id_jurado = '".$idJuradoTecnico ."'";
                $idcalt = $dbconnect->seleccionarDatosCondicion($fieldnamecalt, $tblnamecalt, $conditioncalt);
                $datoscalt = mysql_fetch_array($idcalt);
                for($i=0;$i<=15;$i++){
                    $arrayCamposValt = array("fk_id_criterio","fk_id_calificacion","valor_calificacion");
                    $arrayValoresCalt2 = array($i,$datoscalt[0],"0");
                    $dbconnect->insertarDatos("valor_calificacion", $arrayCamposValt, $arrayValoresCalt2);
                }
            }
            catch (Exception $ex) {
                echo "Excepción Capturada: ", $ex->getMessage(),"\n";
            }
            
            //Insertar valores en la tabla de calificaciones - Jurado Tecnico.
            try{
                $arrayCamposCale = array("fk_id_equipo","fk_id_jurado");
                $arrayValoresCale = array($datosequipo[0],$idJuradoExterno);
                $dbconnect->insertarDatos("calificacion", $arrayCamposCale, $arrayValoresCale); 
                
                //Crear set de calificaciones externas para el equipo.
                $fieldnamecale = "id";
                $tblnamecale = "calificacion";
                $conditioncale = "fk_id_equipo = '" .$datosequipo[0] ."' AND fk_id_jurado = '".$idJuradoExterno ."'";
                $idcale = $dbconnect->seleccionarDatosCondicion($fieldnamecale, $tblnamecale, $conditioncale);
                $datoscale = mysql_fetch_array($idcale);
                for($i=0;$i<=15;$i++){
                    $arrayCamposVale = array("fk_id_criterio","fk_id_calificacion","valor_calificacion");
                    $arrayValoresCale2 = array($i,$datoscale[0],"0");
                    $dbconnect->insertarDatos("valor_calificacion", $arrayCamposVale, $arrayValoresCale2);
                }
            }
            catch (Exception $ex) {
                echo "Excepción Capturada: ", $ex->getMessage(),"\n";
            }
        } catch (Exception $ex) {
            echo "Excepción Capturada: ", $ex->getMessage(),"\n";
        }
    ob_end_flush();
    $dbconnect->cerrarConexion();
    ?>
