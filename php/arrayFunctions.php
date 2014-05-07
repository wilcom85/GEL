<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class arrayFunctionsClass{
    private $arraydatos;
    private $arraydatos2;
    public function datosAArray($buscar) {

            while($datos = mysql_fetch_array($buscar)){
                $arraydatos0[] =$datos[0];

            }
            $this->arraydatos = $arraydatos0;
            return $this->arraydatos;
    }
    public function datosAArrayBid($buscar) {
            $i=0;
            $arraydatos1=array();
            while($datos = mysql_fetch_array($buscar)){
                $arraydatos1[$i][0] =$datos[0];
                $arraydatos1[$i][1] =$datos[1];
                $i++;
            }
            $this->arraydatos2 = $arraydatos1;
            return $this->arraydatos2;
    }
}
?>