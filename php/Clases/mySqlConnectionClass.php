<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mySqlConnection
 *
 * 
 */
//include '../Vista/dialogue.php';

class mySqlConnection {
    private $server = "127.0.0.1:3306";
    private $username = "root";
    private $password = "";
    private $dbname = "mydb";
    private $connection;
    private $selection;
    private $dialogue;
    private $sql;
    
    //PERMITE CONECTARSE A LA BASE DE DATOSd
    public function establecerConexion() {
        //Conectar al servidor de base de datos
	$this->connection = mysql_connect($this->server,$this->username,$this->password) or die("No es posible conectarse a la base de datos: ". mysql_error());
	$this->selection = mysql_select_db($this->dbname)or die("No es posible seleccionar una base de datos");

    }
    //PERMITE INSERTAR DATOS EN UNA TABLA
    public function insertarDatos($tblname,$array1,$array2){
        $self = new self();
        $self->dialogue = new dialogue();
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
            
        //$self-> dialogue = new dialogue();
        $sql = "INSERT INTO " .$tblname ."(" .$campos .") VALUES (" .$valores .");";
        $this->sql = $sql;
        try{
            $result = mysql_query($sql)or die ("Error en: $sql:" . mysql_error());
            //If ($result == 1){
//                $self-> dialogue->dialogueSuccess("El nuevo registro se ha creado exitosamente");
//                echo "<div id='dialog' title='Exito'><p>El nuevo registro se ha creado exitosamente</p></div>";
//            }else{
//                $self->dialogue->dialogueError("Falló la creación del registro");
//                echo "<div id='dialog' title='Fallo'><p>falló la creación del registro</p></div>";
//            }
        } catch (Exception $ex) {
            $result = 'Excepción capturada: '.$ex->getMessage();
        }
        return $result;
        mysql_free_result($result);
    }
    /*
    * 
    * ---DEVUELVE UN ARRAY CON EL RESULTADO DE UNA CONSULTA SIN CONDICION---
    * 
    */
    public function seleccionarDatos($fieldname,$tblname){
//        $self=new self();
//        $self->dialogue = new dialogue();
        $sql = "SELECT " .$fieldname ." FROM " .$tblname .";";
        $this->sql = $sql;
        try{
            $result = mysql_query($sql) or die ("Error en: $sql:" . mysql_error());
        } catch (Exception $ex) {
            $result = 'Excepción capturada: '. $ex->getMessage();
        }
        return $result;
        mysql_free_result($result);
    }  

    /*
    * 
    * ---DEVUELVE UN ARRAY CON EL RESULTADO DE UNA CONSULTA CONDICIONADA---
    * 
    */
    public function seleccionarDatosCondicion($fieldname,$tblname,$condition){
        //$self = new self();
        //$self->dialogue = new dialogue();
        $mensaje;
        $sql = "SELECT " .$fieldname ." FROM " .$tblname ." WHERE " .$condition .";";
        $this->sql = $sql;
        try{
            $result = mysql_query($sql) or die ("Error en: $sql:" . mysql_error());
            
        } catch (Exception $ex) {
            $result = 'Excepción capturada: ' .$ex->getMessage();
            
        }
        return $result;
        mysql_free_result($result);
    }
    
    public function consultaTodosOrdenada($fieldname,$tblname,$orderby){
        $self = new self();
        $this->dialogue = new dialogue();
        $sql = "SELECT " .$fieldname ." FROM " .$tblname ." ORDER BY " .$orderby .";";
        $this->sql = $sql;
        try{
            $result = mysql_query($sql) or die ("Error en: $sql:" . mysql_error());
            return $result;
        } catch (Exception $ex) {
            $self->dialogue->dialogueError('Excepción capturada: ', $ex->getMessage() ,  '\n');
        }
        mysql_free_result($result);
    }
    
    public function actualizarDato($tabla,$campo,$dato,$condicion){
        $self = new self();
        $self->dialogue = new dialogue();
        $sql = "UPDATE ".$tabla ." SET ".$campo." = ".$dato." WHERE ".$condicion.";";
        $this->sql = $sql;
        //echo $sql;
        try{
            $result = mysql_query($sql) or die ("Error en: $sql:" .mysql_error());
            return $result;
        } catch (Exception $ex) {
            $self->dialogue->dialogueError('Excepción capturada: ', $ex->getMessage() ,  '\n');
        }
        mysql_free_result($result);
    }
    
    public function cerrarConexion(){
        mysql_close($this->connection);
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
    public function getSql(){
        return $this->sql;
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