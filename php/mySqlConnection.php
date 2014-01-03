<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mySqlConnection
 *
 * @author stitc_000
 */
class mySqlConnection {
    private $server = "localhost:3306";
    private $username = "root";
    private $password = "";
    private $dbname = "vive_gob_movil";
    
    //put your code here
    public function establecerConexion() {
        //Conectar al servidor de base de datos
	mysql_connect($this->server,$this->username,$this->password) or die("No es posible conectarse a la base de datos: ". mysql_error());
	mysql_select_db($this->dbname)or die("No es posible seleccionar una base de datos");
    }
    
    public function insertarDatos($tblname,$array1,$array2){
        $tamano1 = count($array1)+1;
        $tamano2 = count($array2)+1;
        $campos;
        $valores;
        for($i = 0; $i < $tamano1;$i++){
            $campos = $campos ."'" .$tamano1[i] ."',";
            echo $campos;
        }
        for($i = 0; $i < $tamano2;$i++){
            $valores = $valores ."'" .$tamano2[i] ."',";
        }
        $sql = "INSERT INTO " .$tblname ." (" .$campos .") VALUES (" .$valores .");";
    }
    
    
    
    
    public function getServer() {
        return $this->server;
    }
    public function getUser() {
        return $this->username;
    }
    public function getDataBase(){
        return $this->dbname;
    }
}
