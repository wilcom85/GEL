<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of equiposClass
 *
 * @author Wilmer Amézquita
 */
include_once 'mySqlConnectionClass.php';
include_once 'arrayFunctionsClass.php';

class equiposClass {
    //put your code here
    private function consultarEquipos($idJurado){
        $misEquipos = new mySqlConnection();
        $miArray = new arrayFunction();
        $campoEquipo = "idCalificacion";
        $tablaEquipo = "calificacion";
        $condicionEquipo = "fk_id_jurado = ".$idJurado;
        $buscarEquipos = $misEquipos->seleccionarDatosCondicion($campoEquipo, $tablaEquipo, $condicionEquipo);
        $arrayEquipos = $miArray->datosAArray($buscarEquipos);
        return $arrayEquipos;
    }
    
    private function consultarNumEquipos($idJurado) {
        $misEquipos = new mySqlConnection();
        $miArray = new arrayFunction();
        $campoEquipo = "idCalificacion";
        $tablaEquipo = "calificacion";
        $condicionEquipo = "fk_id_jurado = ".$idJurado;
        $buscarEquipos = $misEquipos->seleccionarDatosCondicion($campoEquipo, $tablaEquipo, $condicionEquipo);
        $arrayEquipos = $miArray->datosAArray($buscarEquipos);
        return count($arrayEquipos);
    }
    
    public function getNumEquipos($idJurado) {
        $numEquipos = equiposClass::consultarNumEquipos($idJurado);
        return $numEquipos;
    }
}
