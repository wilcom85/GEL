<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/html; charset=UTF-8');    

//include 'mySqlConnection.php';
//include 'arrayFunctions.php';
class consolidar_Calificacion{
    
    private $dbconnect;
    private $arrayManagement;
    
    private function conexion (){
        $this->dbconnect = new mySqlConnection();
        $this->dbconnect->establecerConexion();  
    }
    
    function consultarIdCalificaciones ($idEquipo){
        $self = new self();
        $self->conexion();
//session_start();
        //Definición de Variables
        //  
        $fieldname="id";
        $tblname="calificacion";
        $condition = "fk_id_equipo = " .$idEquipo;
        $buscar = $self->dbconnect->seleccionarDatosCondicion($fieldname, $tblname, $condition);
        $arrayManagement = new arrayFunction;
        //Se usa la clase arrayFunction para obtener un array con los elementos de la consulta.
        $arrayIdCalificacion = $arrayManagement->datosAArray($buscar);
        return $arrayIdCalificacion;
        $self->dbconnect->cerrarConexion();
        ob_end_flush();
    }
    
    function consultarResultadoCalificacion($idCalificacion){
        ob_start();
        $self = new self();
        $self->conexion();
//        $dbconnect = new mySqlConnection();
//        $dbconnect->establecerConexion();
        $fieldname="t1.total_calificacion";
        $tblname="valor_calificacion AS t1";
        $condition = "fk_id_calificacion= " .$idCalificacion ." ORDER BY fk_id_criterio";
        $buscar = $self->dbconnect->seleccionarDatosCondicion($fieldname, $tblname, $condition);
        $self-> arrayManagement = new arrayFunction;
        //Se usa la clase arrayFunction para obtener un array con los elementos de la consulta.
        $arrayValorCalificacion = $self->arrayManagement->datosAArray($buscar);       
        return$arrayValorCalificacion;
       
        
        
        $self->dbconnect->cerrarConexion();
        ob_end_flush();
    }
    
    function agruparResultadosCalificacion($arrayValoresCalif){
        $calificacionUsabilidad=0.0;
        $calificacionInterGrafica=0.0;
        $calificacionFuncionalidad=0.0;
        $calificacionInnovacion=0.0;
        $calificacionInteredes=0.0;
        $calificacionViabilidad=0.0;
        for($i=0; $i<count($arrayValoresCalif);$i++){
            if($i==0 or $i==1){
                
                $calificacionUsabilidad = $calificacionUsabilidad + $arrayValoresCalif[$i];
            }
            if($i==2 or $i==3){
                $calificacionInterGrafica = $calificacionInterGrafica + $arrayValoresCalif[$i];
            }
            if($i==4 or $i==5){
                $calificacionFuncionalidad = $calificacionFuncionalidad + $arrayValoresCalif[$i];
            }
            if($i==6 or $i==7){
                $calificacionInnovacion = $calificacionInnovacion + $arrayValoresCalif[$i];
            }
            if($i==8){
                $calificacionInteredes = $arrayValoresCalif[$i];
            }
            if($i==9 or $i==10){
                $calificacionViabilidad = $calificacionViabilidad + $arrayValoresCalif[$i];
            }
            //echo $arrayValoresCalif[$i];
        }
        $calificacionUsabilidad = $calificacionUsabilidad/2;
        $calificacionInterGrafica = $calificacionInterGrafica/2;
        $calificacionFuncionalidad = $calificacionFuncionalidad/2;
        $calificacionInnovacion = $calificacionInnovacion/2;
        $calificacionViabilidad = $calificacionViabilidad/2;
        //echo $calificacionUsabilidad;
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

