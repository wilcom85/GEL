<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    header('Content-Type: text/html; charset=UTF-8');    

    include 'mySqlConnection.php';
    include 'arrayFunctions.php';
class consolidar_Calificacion{
    
    function consultarIdCalificaciones ($idEquipo){
        session_start();
        //Definición de Variables
        ob_cleanob_start();
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $fieldname="id";
        $tblname="calificacion";
        $condition = "fk_id_equipo = " .$idEquipo;
        $buscar = $dbconnect->seleccionarDatosCondicion($fieldname, $tblname, $condition);
        $arrayManagement = new arrayFunction;
        //Se usa la clase arrayFunction para obtener un array con los elementos de la consulta.
        $arrayIdCalificacion = $arrayManagement->datosAArray($buscar);
        $dbconnect->cerrarConexion();
    }
    
    function consultarResultadoCalificacion($idCalificacion){
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $fieldname="t1.valor_calificacion, t1.total_calificacion";
        $tblname="valor_calificacion";
        $condition = "fk_id_calificacion= " .$idCalificacion ."ORDER BY fk_id_criterio";
        $buscar = $dbconnect->seleccionarDatosCondicion($fieldname, $tblname, $condition);
        $arrayManagement = new arrayFunction;
        //Se usa la clase arrayFunction para obtener un array con los elementos de la consulta.
        $arrayValorCalificacion = $arrayManagement->datosAArray($buscar);
        $dbconnect->cerrarConexion();
    }
    
    function agruparResultadosCalificacion($arrayValoresCalif){
        $calificacionUsabilidad;
        $calificacionInterGrafica;
        $calificacionFuncionalidad;
        $calificacionInnovacion;
        $calificacionInteredes;
        $calificacionViabilidad;
        for($i==0; $i<count($arrayValoreCalif);$i++){
            if($i==0 or $i==1){
                $calificacionUsabilidad = $calificacionUsabilidad + $arrayValoreCalif[$i];
            }
            if($i==2 or $i==3){
                $calificacionInterGrafica = $calificacionInterGrafica + $arrayValoreCalif[$i];
            }
            if($i==4 or $i==5){
                $calificacionFuncionalidad = $calificacionFuncionalidad + $arrayValoreCalif[$i];
            }
            if($i==6 or $i==7){
                $calificacionInnovacion = $calificacionInnovacion + $arrayValoreCalif[$i];
            }
            if($i==8){
                $calificacionInteredes = $arrayValoreCalif[$i];
            }
            if($i==9 or $i==10){
                $calificacionViabilidad = $calificacionViabilidad + $arrayValoreCalif[$i];
            }
        }
        $calificacionUsabilidad = $calificacionUsabilidad/2;
        $calificacionInterGrafica = $calificacionInterGrafica/2;
        $calificacionFuncionalidad = $calificacionFuncionalidad/2;
        $calificacionInnovacion = $calificacionInnovacion/2;
        $calificacionViabilidad = $calificacionViabilidad/2;
        
        $arrayCalifAgrupadas = array('usabilidad'=>$calificacionUsabilidad,
                                     'grafica'=>$calificacionInterGrafica,
                                     'funcionalidad'=>$calificacionFuncionalidad,
                                     'innovacion'=>$calificacionInnovacion,
                                     'redes'=>$calificacionInteredes,
                                     'viabilidad'=>$calificacionViabilidad);
        return $arrayCalifAgrupadas;
    } 
}
 ?>

