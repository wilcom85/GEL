<!--
    Código que permite ejecutar la validación de usuarios del sistema
-->
<?php
    include '../Vista/dialogue.php';
    include '../Clases/CheckLoginClass.php';
    include '../Clases/validarSesionClass.php';
    
    $checkLogIn = new CheckLoginClass(); 
    $myusername=$_POST['myusername'];
    $mypassword=$_POST['mypassword'];
    
    $checkLogIn->recibirDatosLogin($myusername, $mypassword);
    $resultadoValidacion = $checkLogIn->validarUsuario();
    echo $resultadoValidacion;
    if($resultadoValidacion == 1){
        //Si el resultado de la validación es 0, se direcciona al usuario a la 
        //vista de administrador 
        header("location:../Vista/admin_login_success.php");
        echo "0";
    }else if($resultadoValidacion == 0){
        //Si el resultado de la validación es 1, se direcciona al usuario a la 
        //vista de administrador
        header("location:../Vista/user_login_success.php");
        echo "1";
    }else{
        $message = "Usuario o clave inválidos";
        $redir = "../../index.php";
        $dialogue = new dialogue();
        $dialogue->dialogueWarning($message,$redir);
    }    
?> 