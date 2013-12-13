<?php
	//Forzar el uso de codificación utf-8
	header('Content-Type: text/html; charset=UTF-8');
	//Definición de Variables
	ob_start();
	$host="localhost:3306"; //Nombre del Host
	$username="root"; //Nombre del usuario de MySQL
	$password=""; //Clave del usuario de MySQL
	$db_name="vive_gob_movil"; //Nombre de la Base de Datos
	$tbl_name="members";  //Nombre de la Tabla
	//Conectar al servidor de base de datos
	mysql_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
	mysql_select_db("$db_name")or die("No es posible seleccionar una base de datos");
	//Usuario y clave enviados desde el formulario
	$myusername=$_POST['myusername'];
	$mypassword=$_POST['mypassword'];
	//Proteger inyección de MySQL
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$sql="SELECT * FROM $tbl_name WHERE username = '$myusername' and password='$mypassword'";
	$result = mysql_query($sql);
	//Mysql_num_row cuenta la fila de la tabla
	$count = mysql_num_rows($result);
	//Si el resultado coincide entre $myusername y $mypassword, la cantidad de filas de tabla debe ser 1.
	if($count==1){
		//Guardar los datos de la fila en un array
		$row = mysql_fetch_array($result);
		
		//Si el usuario es administrador, ingresa al home de Admin
		if($row[3] == 'administrador' ){
			//Registrar $myusername y $mypassword y redireccionar al home del usuario logueado.
			session_start();
			$_SESSION['$usuario'] = $myusername;
			$_SESSION['$clave'] = $mypassword;
                        $_SESSION['$panel'] = "panelAdmin.html";
			header("location:admin_login_success.php");
		}
		if($row[3] == 'jurado' ){
			//Registrar $myusername y $mypassword y redireccionar al home del usuario logueado.
			session_start();
			$_SESSION['$usuario'] = $myusername;
			$_SESSION['$clave'] = $mypassword;
                        $_SESSION['$panel'] = "panelUser.html";
			header("location:user_login_success.php");
		}
	}
	else{
		echo "Usuario o clave inválidos";
	}
	ob_end_flush();
?> 