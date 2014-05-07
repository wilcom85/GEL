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
include './mySqlConnectionClass.php';
ob_start();


class equiposClass {
    //put your code here
    private function consultarEquipos(){
        $misEquipos = new mySqlConnection();
        $fieldname = "";
        $tblname = "";
        $condition = "";
        $misEquipos->seleccionarDatosCondicion($fieldname, $tblname, $condition);
    }
    
}
