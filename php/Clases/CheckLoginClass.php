<?php

/*
 * Clase para validar el login de los usuarios.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase para validar el login de los usuarios.
 *
 * @author Wilmer Amézquita
 */
include '../Clases/mySqlConnectionClass.php';
//include '../Clases/validarSesionClass.php';

class CheckLoginClass {
    private $myusername;
    private $mypassword;
    private $sql;
    private $count;
    private $connection;
    
    public function recibirDatosLogin($myusername, $mypassword){
	//Proteger inyección de MySQL
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
        $myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
        $this->myusername = $myusername;
        $this->mypassword = $mypassword;
    }
    
   public function validarUsuario(){
        $connection = new mySqlConnection;
        $connection->establecerConexion();
        $sql = "Select * from persona WHERE usuarioPersona = '". $this->myusername. "' and clavePersona ='". $this->mypassword."'";
        $result=  mysql_query($sql) or die ("Error en: $sql:" . mysql_error());
	//Si el resultado coincide entre $myusername y $mypassword, la cantidad de filas de tabla debe ser 1.
	if(mysql_num_rows($result)==1){
		//Guardar los datos de la fila en un array
		$row = mysql_fetch_array($result);
		//Si el usuario es administrador, ingresa al home de Admin
		if($row[5] == 0 ){
			//Registrar $myusername y $mypassword y redireccionar al home del usuario logueado.
                        $adminls = new validarSesionClass();    
			session_start();
                        $_SESSION['$idUsuario'] = $row[0];
			$_SESSION['$usuario'] = $this->myusername;
			$_SESSION['$clave'] = $this->mypassword;
                        $_SESSION['$idSesion'] = $adminls-> crearSesion();
                        $_SESSION['$rol'] = $row[5];
			return 0;
		}
		if($row[5] == 1 ){
			//Registrar $myusername y $mypassword y redireccionar al home del usuario logueado.
			session_start();
                        $_SESSION['$idUsuario'] = $row[0];
			$_SESSION['$usuario'] = $this->myusername;
			$_SESSION['$clave'] = $this->mypassword;
                        $_SESSION['$panel'] = "panelUser.html";
                        $_SESSION['$rol'] = $row[5];
                        return 1;
		}
	}
	else{
		return 2;
	}
        $connection->cerrarConexion();
    }
    
    public function destruirSesion(){
        ob_start();
        $_SESSION['$rol']="";
        session_destroy();
        header("location:../../index.php");
        ob_get_flush();
    }
    //put your code here
}
