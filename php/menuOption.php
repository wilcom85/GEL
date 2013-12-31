    <?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of opcionRetos
 *
 * @author stitc_000
 */
class menuOption{
    //put your code here
    static $CONSULTARRETO="consultar_reto.php";
    static $REGISTRARRETO="registrar_reto.php";
    public function consultarRetos(){
        $_SESSION['panel'] = $CONSULTARRETO;
    }
    public function registrarRetos(){
        $_SESSION['panel'] = $REGISTRARRETO;
    }
}
