<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of criteriosClass
 *
 * @author stitc_000
 */
include_once 'mySqlConnectionClass.php';
include_once 'arrayFunctionsClass.php';
class criteriosClass {
    //put your code here
    private function arrayCriterios() {
        $connect = new mySqlConnection();
        $connect->establecerConexion();
        $campoCriterios="criterio";
        $tablaCriterios="criterios";
        $misCriterios = $connect->seleccionarDatos($campoCriterios, $tablaCriterios);
        $array = new arrayFunction();
        $arrayCriterios = $array->datosAArray($misCriterios);
        return $arrayCriterios;
        $connect->cerrarConexion();
    }
    
    public function getCriterios(){
        $criterios = criteriosClass::arrayCriterios();
        return $criterios;
    }
    
    public function getNumCriterios(){
        $criterios = criteriosClass::arrayCriterios();
        return count($criterios);
    }
}

