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
    private $server = "127.0.0.1:3306";
    private $username = "root";
    private $password = "80378556";
    private $dbname = "vive_gob_movil";
    private $connection;
    private $selection;
    
    //put your code here
    public function establecerConexion() {
        //Conectar al servidor de base de datos
	$this->connection = mysql_connect($this->server,$this->username,$this->password) or die("No es posible conectarse a la base de datos: ". mysql_error());
	$this->selection = mysql_select_db($this->dbname)or die("No es posible seleccionar una base de datos");
    }
    
    public function insertarDatos($tblname,$array1,$array2){
        //CONCATENA LOS CAMPOS Y LOS VALORES PARA CREAR UN QUERY DE INSERCIÓN
        $tamano1 = count($array1);
        $tamano2 = count($array2);
        $campos="";
        $valores="";
        $i=0;
        $a=0;
        //CONVERTIR ARRAY DE CAMPOS EN CADENA DE CARACTERES
        for($i = 1; $i < $tamano1;$i++){
            $campos = $campos ."'" .$array1[$i] ."',";
            echo $campos;
        }
        echo $campos;
        //CONVERTIR ARRAY DE VALORES EN CADENA DE CARACTERES
        for($a = 1; $a < $tamano2;$a++){
            $valores = $valores ."'" .$array2[$a] ."',";
        }
        echo $valores;
        //EJECUTAR QUERY
        $sql = "INSERT INTO " .$tblname ."(" .$campos .") VALUES (" .$valores .");";
        var_dump($sql);
        mysql_query($sql);
        echo "OK";
}
    
    public function seleccionarTabla($tblname){
        
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
    public function getPassword(){
        return $this->password;
    }
    public function getConnection(){
        return $this->connection;
    }
    public function getSelection(){
        return $this->selection;
    }
}
