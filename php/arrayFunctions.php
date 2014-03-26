<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class arrayFunction{
    
    
    public function datosAArray($buscar) {
            while($datos = mysql_fetch_array($buscar)){
                $arraydatos[] =$datos[0];
            }
            return $arraydatos;
    }
}
    ?>