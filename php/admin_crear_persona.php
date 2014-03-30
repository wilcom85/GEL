<?php
    session_start();
    try{
        if($_SESSION['$rol']<> "administrador"){
            header("location:../index.php");
        }
    }catch(Exeption $e){
        
    }
    //Forzar el uso de codificación utf-8
    header('Content-Type: text/html; charset=UTF-8');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
        <link href="../css/estilo/default.css" rel="stylesheet" type="text/css" media="all" />
        <link href="../css/estilo/fonts.css" rel="stylesheet" type="text/css" media="all" />
        <!-- Start css3menu.com HEAD section -->
        <link rel="stylesheet" href="admin_login_success_files/css3menu0/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
        <!-- End css3menu.com HEAD section -->
        <!--Scripts-->
        <script type="text/javascript" src="../js/myJs/refrescar_iframe.js"></script>
        <script type="text/javascript">
            refrescar = new refrescarFrame('AllInfo');
            //Función que valida los campos del formulario
            function validarEnvio(){
                if(document.crearPersona.cedulaPersona.value.length==0){
                    alert("El campo Cédula es obligatorio")
                    document.crearPersona.cedulaPersona.focus();
                    return(0);
                }
                if(document.crearPersona.nombrePersona.value.length==0){
                    alert("El campo Nombre es obligatorio")
                    document.crearPersona.nombrePersona.focus();
                    return(0);
                }
                if(document.crearPersona.apellidoPersona.value.length==0){
                    alert("El campo Apellido es obligatorio")
                    document.crearPersona.apellidoPersona.focus();
                    return(0);
                }
                if(document.crearPersona.clavePersona.value != document.crearPersona.conficlavePersona.value){
                    alert("La clave y la confirmación no coinciden")
                    document.crearPersona.clavePersona.focus();
                    return(0);
                }
                document.crearPersona.submit();
            }
        </script>
    </head>
    <body>
        <div>
            <?php echo "Usted se ha registrado como: " .$_SESSION['$usuario']; ?> 
        </div>
        <header id="logo">
            <div align="center">
               <img src="../img/logoMinTIC.png" width="254" height="65">
               <img src="../img/ospinternational.jpg" width="137" height="67">
               <img src="../img/devant.jpg" width="137" height="67">
            </div>
        </header>
        <article id="featured-wrapper">
            <h1>5a. Convocatoria Vive Gobierno Móvil</h1>
            <p>Calificación de Aplicaciones - Proyecto Vive Gobierno Móvil</p>
            <a href="admin_login_success.php">
                    <img src="../img/Home-48.png" />
                    <p>Regresar</p>
            </a>
        </article>
            <div id="page-wrapper">
                <nav>    
                </nav>
                <article id="page-wrapper">
                    <form name="crearPersona" method="post" action="nuevaPersona.php">
                        <table class="tablaformulario" id="tablacrearPersona">
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Cédula:</p>
                                </td>
                                <td>
                                    <input name="cedulaPersona" type="text" id="cedulaPersona">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Nombre:</p>
                                </td>
                                <td>
                                    <input name="nombrePersona" type="text" id="nombrePersona">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Apellido:</p>
                                </td>
                                <td>                                        
                                    <input type="text" name="apellidoPersona" id="apellidoPersona" ><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Usuario:</p>
                                </td>
                                <td>                                        
                                    <input type="text" name="usuarioPersona" id="usuarioPersona" ><br>
                                </td>
                            </tr>   
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Clave:</p>
                                </td>
                                <td>                                        
                                    <input type="password" name="clavePersona" id="clavePersona" ><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Confirmar Clave:</p>
                                </td>
                                <td>                                        
                                    <input type="password" name="conficlavePersona" id="conficlavePersona" ><br>
                                </td>
                            </tr>    
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Tipo Usuario:</p>
                                </td>
                                <td>                                        
                                    <select name="tipoUsuario">
                                        <option value="administrador">Administrador</option>
                                        <option value="jurado">Jurado</option>
                                    </select><br>
                                </td>
                            </tr> 
                            <tr class="trBotones">
                                <td>
                                    <input type="button" title="cancelar" value="Cancelar" onclick = "location.href='admin_login_success.php'">
                                </td>
                                <td>                                        
                                    <input type="button" name="guardar" value="Guardar" onClick="validarEnvio()">
                                </td>
                            </tr>
                        </table>
                    </form>
                </article>
            </div>
        <footer id="copyright">
            <p>5a. Convocatoria Vive Gobierno Móvil - wilcom1</p>
        </footer>
    </body>
</html>
