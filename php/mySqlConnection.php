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
include './dialogue.php';

class mySqlConnection {
    private $server = "127.0.0.1:3306";
    private $username = "root";
    private $password = "";
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
        for($i = 0; $i < $tamano1;$i++){
            $campos = $campos .$array1[$i];
            if ($i<$tamano1-1){
                $campos=$campos.",";
            }
        }
        //CONVERTIR ARRAY DE VALORES EN CADENA DE CARACTERES
        for($a = 0; $a < $tamano2;$a++){
            $valores = $valores ."'" .$array2[$a]."'";
            if ($a<$tamano2-1){
                $valores=$valores .",";
            }
        }
        //EJECUTAR QUERY
            
        $dialogue = new dialogue();
        $sql = "INSERT INTO " .$tblname ."(" .$campos .") VALUES (" .$valores .");";
        try{
            $result = mysql_query($sql);
            If ($result == 1){
                $dialogue->dialogueSuccess("El nuevo registro se ha creado exitosamente");
                //echo "<div id='dialog' title='Exito'><p>El nuevo registro se ha creado exitosamente</p></div>";
            }else{
                $dialogue->dialogueError("Falló la creación del registro");
                //echo "<div id='dialog' title='Fallo'><p>falló la creación del registro</p></div>";
            }
        } catch (Exception $ex) {
            $dialogue->dialogueError('Excepción capturada: ', $ex->getMessage() ,  '\n');
            //echo "<div id='dialog' title='Fallo'><p></p></div>";
        }
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
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/jquery/jquery-ui.css">
        <script src="../jquery/jquery-1.10.2.js"></script>
        <script src="../jquery/jquery-ui.js"></script>
        <!--Script de cuadro de dialogo-->
        <script>
            $(function() {
                $( "#dialog" ).dialog({
                    width: 960,
                    hide: 'slide',
                    position: 'top',
                    show: 'slide',
                    close: function(event, ui) { location.href = 'admin_login_success.php' }
                });
            });
        </script>
    </head>
</html>