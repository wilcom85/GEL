<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sessionClass
 *
 * @author stitc_000
 */
class sessionClass {
    private $idUsuario;
    
    private function consultarIdUsuario(){
        session_start();
        $this->idUsuario = $_SESSION['$idUsuario'];
        ob_clean();
    }


    public function getIdUsuario() {
        sessionClass::consultarIdUsuario();
        return $this->idUsuario;
    }
    //put your code here
}
