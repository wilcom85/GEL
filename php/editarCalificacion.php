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
        echo $_POST['numero'];
        $numero = $_POST['numero'];
        $item1 = $_POST['item1'];
        $item2 = $_POST['item2'];
        $item3 = $_POST['item3'];
        $item4 = $_POST['item4'];
        $item5 = $_POST['item5'];
        $item6 = $_POST['item6'];        
        $item7 = $_POST['item7'];
        $item8 = $_POST['item8'];
        $item9 = $_POST['item9'];
        $item10 = $_POST['item10'];
        $item0 = $_POST['item0'];
        //$combinacion = $_POST['combinacion'];
//        $renovacion = $_POST['renovacion'];
//        $integraredes = $_POST['integraredes'];
//        $funsociales = $_POST['funsociales'];
//        $auteredes = $_POST['auteredes'];
        $numero = stripslashes($numero);
        $item1 = stripslashes($item1);
        $item2 = stripslashes($item2);
        $item3 = stripslashes($item3);
        $item4 = stripslashes($item4);
        $item5 = stripslashes($item5);
        $item6 = stripslashes($item6);
        $item7 = stripslashes($item7);
        $item8 = stripslashes($item8);
        $item9 = stripslashes($item9);
        $item10 = stripslashes($item10);
        $item0 = stripslashes($item0);
//        $innovacion = stripslashes($innovacion);
//        $combinacion = stripslashes($combinacion);
//        $renovacion = stripslashes($renovacion);
//        $integraredes = stripslashes($integraredes);
//        $funsociales = stripslashes($funsociales);
//        $auteredes = stripslashes($auteredes);
        $numero = mysql_real_escape_string($numero);
        $item1 = mysql_real_escape_string($item1);
        $item2 = mysql_real_escape_string($item2);
        $item3 = mysql_real_escape_string($item3);
        $item4 = mysql_real_escape_string($item4);
        $item5 = mysql_real_escape_string($item5);
        $item6 = mysql_real_escape_string($item6);
        $item7 = mysql_real_escape_string($item7);
        $item8 = mysql_real_escape_string($item8);
        $item9 = mysql_real_escape_string($item9);
        $item10 = mysql_real_escape_string($item10);
        $item0 = mysql_real_escape_string($item0);
//        $combinacion = mysql_real_escape_string($combinacion);
//        $renovacion = mysql_real_escape_string($renovacion);
//        $integraredes = mysql_real_escape_string($integraredes);
//        $funsociales = mysql_real_escape_string($funsociales);
//        $auteredes = mysql_real_escape_string($auteredes);
        $arrayActualizacionCal = array(0=>$item0,
                                        1=>$item1,
                                        2=>$item2,
                                        3=>$item3,
                                        4=>$item4,
                                        5=>$item5,
                                        6=>$item6, 
                                        7=>$item7, 
                                        8=>$item8,
                                        9=>$item9,
                                        10=>$item10); 
        
        for($i=0;$i<=10;$i++){
//            echo $arrayActualizacionCal[$i];
//           echo "<script type='text/javascript'>alert('$arrayActualizacionCal[$i]');</script>";
//          Guardar datos en la base de datos de calificaciones.    
            $tabla="valor_calificacion";
            $campo="valor_calificacion";
            $dato = $arrayActualizacionCal[$i];
            $condicion = "fk_id_calificacion = ".$numero." AND fk_id_criterio = ".$i;
            $dbconnect->actualizarDato($tabla, $campo, $dato, $condicion);
            $totalcalificacion = $arrayActualizacionCal[$i]*2;
            $aspectos = $dbconnect->consultaTodosOrdenada("valor_pregunta", "aspectos_calificacion", "id");
            while($datosaspectos = mysql_fetch_array($aspectos))
            {
                    $arraydatosaspectos[] = $datosaspectos[0];
                    
            }
            
            if ($i==0 or $i==1){
                $totalcalificacion = $totalcalificacion * ($arraydatosaspectos[0]/10) ;
            }
            if ($i==2 or $i==3){
                $totalcalificacion = $totalcalificacion * ($arraydatosaspectos[1]/10) ;
            }
            if ($i==4 or $i==5){
                $totalcalificacion = $totalcalificacion * ($arraydatosaspectos[2]/10) ;
            }
            if ($i==6 or $i==7){
                $totalcalificacion = $totalcalificacion * ($arraydatosaspectos[3]/10) ;
            }
            if ($i==8){
                $totalcalificacion = $totalcalificacion * ($arraydatosaspectos[4]/10) ;
            }
            if ($i==9 or $i==10){
                $totalcalificacion = $totalcalificacion * ($arraydatosaspectos[5]/10) ;
            }
            $tablacal="valor_calificacion";
            $campocal=" total_calificacion ";
            $dbconnect->actualizarDato($tablacal, $campocal, $totalcalificacion, $condicion);
        }   
         header("location: consultar_evaluacion.php");
         ob_end_flush();
         $dbconnect->cerrarConexion();
