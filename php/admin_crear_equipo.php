<?php
    include 'mySqlConnection.php';
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
                if(document.crearEquipo.nombreEquipo.value.length==0){
                    alert("El campo Nombre de Equipo es obligatorio")
                    document.crearEquipo.nombreEquipo.focus();
                    return(0);
                }
                if(document.crearEquipo.reto.value.length==0){
                    alert("Por favor seleccione un reto para el equipo")
                    document.crearEquipo.reto.focus();
                    return(0);
                }
                if(document.crearEquipo.juradoFuncional.value.length==0){
                    alert("Por favor seleccione un Jurado Funcional para el equipo")
                    document.crearEquipo.juradoFuncional.focus();
                    return(0);
                }
                if(document.crearEquipo.juradoTecnico.value.length==0){
                    alert("Por favor seleccione un Jurado Técnico para el equipo")
                    document.crearEquipo.juradoTecnico.focus();
                    return(0);
                }
                if(document.crearEquipo.juradoExterno.value.length==0){
                    alert("Por favor seleccione un Jurado Externo para el equipo")
                    document.crearEquipo.juradoExterno.focus();
                    return(0);
                }
                document.crearEquipo.submit();
            }
        </script>
    </head>
    <body>
        <div>
            <!--Muestra el nombre del usuario que tiene abierta la sesión-->
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
            <h1>CONSORCIO SOFTWARE 2012</h1>
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
                    <form name="crearEquipo" method="post" action="nuevoEquipo.php">
                        <table class="tablaformulario" id="tablacrearReto">
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Nombre del Equipo:</p>
                                </td>
                                <td>
                                    <input name="nombreEquipo" type="text" id="nombreEquipo">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Nombre del reto:</p>
                                </td>
                                <td>
                                    <select name="reto">
                                        <option value="">Seleccione</option>
                                        <!-- llenado automático del drop down list -->
                                        <?php
                                            $fieldname = "id,nombre";
                                            $tblname = "retos";
                                            $connection = new mySqlConnection();
                                            $connection -> establecerConexion();
                                            $resultQry = $connection->seleccionarDatos($fieldname, $tblname);
                                            //validar si ls consulta SQL arroja resultados
                                            if (mysql_num_rows($resultQry)==0){ 
                                                echo "no existen datos";exit(0);
                                            }
                                            echo mysql_num_rows($resultQry);
                                            while($row = mysql_fetch_array($resultQry)){
                                                    echo ("<option  VALUE=\"$row[0]\" " . ($resultQry == $row[0] ? " selected" : "") . ">$row[1]</option>");
                                            }
                                        ?>
                                    </select>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Jurado Funcional:</p>
                                </td>
                                <td>
                                    <select name="juradoFuncional">
                                        <option value="">Seleccione</option>
                                        <!-- llenado automático del drop down list -->
                                        <?php
                                            $fieldname = "id,nombre,apellido";
                                            $tblname = "persona";
                                            $condition="tipo = 'jurado'";
                                            $connection = new mySqlConnection();
                                            $connection->establecerConexion();
                                            $resultQry = $connection->seleccionarDatosCondicion($fieldname, $tblname, $condition);
                                            //validar si ls consulta SQL arroja resultados
                                            if (mysql_num_rows($resultQry)==0){ 
                                                echo "no existen datos";exit(0);
                                            }
                                            echo mysql_num_rows($resultQry);
                                            while($row = mysql_fetch_array($resultQry)){
                                                    echo ("<option  VALUE=\"$row[0]\" " . ($resultQry == $row[0] ? " selected" : "") . ">$row[1] $row[2]</option>");
                                            }
                                        ?>
                                    </select>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Jurado Técnico:</p>
                                </td>
                                <td>
                                    <select name="juradoTecnico">
                                        <option value="">Seleccione</option>
                                        <!-- llenado automático del drop down list -->
                                        <?php
                                            $fieldname = "id,nombre,apellido";
                                            $tblname = "persona";
                                            $condition="tipo = 'jurado'";
                                            $connection = new mySqlConnection();
                                            $connection->establecerConexion();
                                            $resultQry = $connection->seleccionarDatosCondicion($fieldname, $tblname, $condition);
                                            //validar si ls consulta SQL arroja resultados
                                            if (mysql_num_rows($resultQry)==0){ 
                                                echo "no existen datos";exit(0);
                                            }
                                            echo mysql_num_rows($resultQry);
                                            while($row = mysql_fetch_array($resultQry)){
                                                    echo ("<option  VALUE=\"$row[0]\" " . ($resultQry == $row[0] ? " selected" : "") . ">$row[1] $row[2]</option>");
                                            }
                                        ?>
                                    </select>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Jurado Externo:</p>
                                </td>
                                <td>
                                    <select name="juradoExterno">
                                        <option value="">Seleccione</option>
                                        <!-- llenado automático del drop down list -->
                                        <?php
                                            $fieldname = "id,nombre,apellido";
                                            $tblname = "persona";
                                            $condition="tipo = 'jurado'";
                                            $connection = new mySqlConnection();
                                            $connection->establecerConexion();
                                            $resultQry = $connection->seleccionarDatosCondicion($fieldname, $tblname, $condition);
                                            //validar si ls consulta SQL arroja resultados
                                            if (mysql_num_rows($resultQry)==0){ 
                                                echo "no existen datos";exit(0);
                                            }
                                            echo mysql_num_rows($resultQry);
                                            while($row = mysql_fetch_array($resultQry)){
                                                    echo ("<option  value=\"$row[0]\" " . ($resultQry == $row[0] ? " selected" : "") . ">$row[1] $row[2]</option>");
                                            }
                                        ?>
                                    </select>
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
            <p>Consorcio Software 2012 - wilcom1</p>
        </footer>
    </body>
</html>