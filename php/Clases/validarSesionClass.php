<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validarSesionClass
 *
 * @author stitc_000
 */
class validarSesionClass {
    //put your code here
    //Formato de variables cs#
    public function  crearSesion(){
        $csGenerarId = new validarSesionClass();
        $csIdSesion = $csGenerarId->generarIdSesion();
        $cstable="";
        $csarray1=array("idsesion","estado");
        $csarray2=array($csIdSesion,1);
        $csconnection = new mySqlConnection();
        $csconnection->insertarDatos($cstable, $array1, $array2);
        $csconnection->cerrarConexion();
        return $csIdSesion;
    }
    
    ////Formato de variables gis#
    public function generarIdSesion(){
        $gisArrayDate = getdate();
        $gisidsesion = $gisArrayDate['seconds'].$gisArrayDate['minutes'].$gisArrayDate['hours'].$gisArrayDate[0];
        echo $gisidsesion;
        return $gisidsesion;
    }
    
    ////Formato de variables vs#
    public function validarSesion($idSesion){
        $vsTable = "sesiones";
        $vsField=" * ";
        $vsCondition="idsesion = '".$idSesion."' AND estado = 1";
        $vsConnect = new mySqlConnection();
        $vsConnect->seleccionarDatosCondicion($vsField, $vsTable, $vsCondition);
        
    }
}
