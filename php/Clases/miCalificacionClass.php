<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newCalificacionClass
 *
 * @author stitc_000
 */
 include_once 'mySqlConnectionClass.php';
 include_once 'arrayFunctionsClass.php';
 include_once 'criteriosClass.php';
 
class miCalificacionClass {
    //put your code here
   
   private function conectar(){
       $dbconnect = new mySqlConnection();
       $dbconnect->establecerConexion();
   }

    private function consultarNumMisCalificaciones($idUsuario){
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $campoCalificacion = "fk_id_jurado, fk_id_equipo";
        $tablaCalificacion = "calificacion";
        $condicionCalificacion = "fk_id_jurado = '" .$idUsuario ."' ORDER BY idCalificacion";
        $buscarCalificacion = $dbconnect->seleccionarDatosCondicion($campoCalificacion, $tablaCalificacion, $condicionCalificacion);
        $dbconnect->cerrarConexion();
        return mysql_num_rows($buscarCalificacion);    
    }
    
    public function cantidadMisCalificaciones($idUsuario){
        $cantidad = miCalificacionClass::consultarNumMisCalificaciones($idUsuario);
        return $cantidad;
    }
    
    private function consultarMisCalificaciones($idUsuario) {
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $campoCalificacion = "fk_id_jurado, fk_id_equipo, idCalificacion";
        $tablaCalificacion = "calificacion";
        $condicionCalificacion = "fk_id_jurado = '" .$idUsuario ."' ORDER BY idCalificacion";;
        $buscarCalificacion = $dbconnect->seleccionarDatosCondicion($campoCalificacion, $tablaCalificacion, $condicionCalificacion);
        $arrayCalificaciones = new arrayFunction();
        $misCalificaciones = $arrayCalificaciones->datosAArrayTri($buscarCalificacion);
        $dbconnect->cerrarConexion();
        return $misCalificaciones;
    }

    public function misCalificaciones($idUsuario){
        $calificaciones = miCalificacionClass::consultarMisCalificaciones($idUsuario);
        return $calificaciones;
    }
    
    private function consultarNombreEquipo($idEquipo){
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $arrayNombre = new arrayFunction();
        $campoEquipo = "nombreEquipo";
        $tablaEquipo = "equipo";
        $condicionEquipo = "idEquipo = ".$idEquipo;
        $buscarEquipo = $dbconnect->seleccionarDatosCondicion($campoEquipo, $tablaEquipo, $condicionEquipo);
        $equipo = $arrayNombre->datosAArray($buscarEquipo);
        $dbconnect->cerrarConexion();
        return $equipo[0];
    }
    
    public function getNombreEquipo($idEquipo){
        $nombreEquipo = miCalificacionClass::consultarNombreEquipo($idEquipo);
        return $nombreEquipo;
    }
    
    private function calificacionJuradoArray($idJurado, $idEquipo){
        $array2 = new arrayFunction();
        $arrayCalificaciones = array();
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $criterios = new criteriosClass();
        $numCriterios = $criterios->getNumCriterios();
        for($i=0;$i<$numCriterios;$i++){
            $campoCriterio = "valorCalificacion".$i;
            $tablaCriterio = "calificacion";
            $condicionCriterio = "fk_id_jurado = ".$idJurado." AND fk_id_equipo = ".$idEquipo;
            $consultaCriterio = $dbconnect->seleccionarDatosCondicion($campoCriterio, $tablaCriterio, $condicionCriterio);
            echo $dbconnect->getSql();
            $arrayCalificaciones[$i] = $array2->datosAArray($consultaCriterio);
        }
        $dbconnect->cerrarConexion();
        return $arrayCalificaciones;
    }
    
        private function calificacionJuradoCriterio($idJurado, $idEquipo, $idCriterio){
        $array2 = new arrayFunction();
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
//        $criterios = new criteriosClass();
        $campoCriterio = "valorCalificacion".$idCriterio;
        $tablaCriterio = "calificacion";
        $condicionCriterio = "fk_id_jurado = ".$idJurado." AND fk_id_equipo = ".$idEquipo;
        $consultaCriterio = $dbconnect->seleccionarDatosCondicion($campoCriterio, $tablaCriterio, $condicionCriterio);
        //echo $dbconnect->getSql();
        $arrayCalificaciones = $array2->datosAArray($consultaCriterio);
        $dbconnect->cerrarConexion();
        return  $arrayCalificaciones;
    }
    
    public function getCalificacionJurado($idJurado, $idEquipo, $idCriterio){
        $arrayCalificacionJurado = miCalificacionClass::calificacionJuradoCriterio($idJurado, $idEquipo, $idCriterio);
        return $arrayCalificacionJurado;
    }
    
    private function consultarEquiposJurado($idJurado){
        
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $array = new arrayFunction();
        $tablaEquipos="calificacion";
        $campoEquipos="fk_id_equipo, fk_id_reto";
        $condicionEquipos="fk_id_jurado = ".$idJurado;
        $consultaEquipos = $dbconnect->seleccionarDatosCondicion($campoEquipos, $tablaEquipos, $condicionEquipos);
        $arrayMisEquipos = $array->datosAArray($consultaEquipos);
        return $arrayMisEquipos;
        $dbconnect->cerrarConexion();
    }
    
    public function getEquiposJurado($idJurado){
        $arrayEquiposJurado = miCalificacionClass::consultarEquiposJurado($idJurado);
        return $arrayEquiposJurado;
    }
    
    private function ordenarCalificaciones($arrayCalificaciones, $numEquipo, $numCriterios){
        for($i=0;$i<$numCriterios;$i++){
            $calificacionesOrdenadas[$i]=$arrayCalificaciones[$i][$numEquipo];
        }
        return $calificacionesOrdenadas;
    }
    
    public function setCalificacionesOrdenadas($arrayCalificaciones, $numEquipo, $numCriterios) {
        $arrayOrdenado = miCalificacionClass::ordenarCalificaciones($arrayCalificaciones,$numEquipo,$numCriterios);
        return $arrayOrdenado;
    }
    
    private function guardarCalificacionEquipo($arrayCalificaciones, $numCriterios,$idCalificacion){
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
        $tabla = "calificacion";
        for($i=0;$i<$numCriterios;$i++){
            $campo = "valorCalificacion".$i;
            $dato = $arrayCalificaciones[$i];
            $condicion = "idCalificacion = ".$idCalificacion;
            $dbconnect->actualizarDato($tabla, $campo, $dato, $condicion);
        }
        
    }
    
    public function setCalificacionEquipo($arrayCalificaciones, $numCriterios,$idCalificacion){ 
        try
        {
            miCalificacionClass::guardarCalificacionEquipo($arrayCalificaciones,$numCriterios,$idCalificacion);
            $msg="ok";
        }
        catch (Exception $e){
            $msg = "Error: ". $e->getMessage();
        }
        return $msg;
        echo $msg;
    }
}





