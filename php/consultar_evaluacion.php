<?php
    //Forzar el uso de codificación utf-8
    header('Content-Type: text/html; charset=UTF-8');    

    include 'mySqlConnection.php';
    session_start();
    //Definición de Variables
    ob_start();
    $dbconnect = new mySqlConnection();
    $dbconnect->establecerConexion();
    $host = $dbconnect -> getServer(); //Nombre del Host
    $username = $dbconnect -> getUser(); //Nombre del usuario de MySQL
    $password = $dbconnect -> getPassword(); //Clave del usuario de MySQL
    $db_name = $dbconnect -> getDataBase(); //Nombre de la Base de Datos
    $tbl_name ="equipos";  //Nombre de la Tabla
    //$conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
    //mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
    $fieldnamefuncional = "fk_id_juradoFuncional ";
    $tblnamefuncional = "equipos";
    $conditionfuncional = $_SESSION['$idUsuario'] . " = " . $fieldnamefuncional;
    $buscar = $dbconnect->seleccionarDatosCondicion($fieldnamefuncional, $tblnamefuncional, $conditionfuncional);
    if(mysql_num_rows($buscar) > 0){
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
        <link href="../css/estilo/default.css" rel="stylesheet" type="text/css" media="all" />
        <link href="../css/estilo/fonts.css" rel="stylesheet" type="text/css" media="all" />
        <!-- Start css3menu.com HEAD section -->
        <link rel="stylesheet" href="admin_login_success_files/css3menu0/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
         <style>
            #resizable { width: 150px; height: 150px; padding: 0.5em; }
            #resizable h3 { text-align: center; margin: 0; }
        </style>
        <script>
            $(function() {
            $( "#resizable" ).resizable();
            });
        </script>
        </head>
        
        <body>
        <table border = "1" width = "100%"  id="resizable" class="ui-widget-content">
            <tr>
                <th colspan="15">MI CALIFICACION FUNCIONAL</th>
            </tr>
            
            
            
            <!--Encabezado de la tabla con los criterios de Evaliación-->
            <tr>
                <th>Reto</th>
                <th>Equipo</th>
            <?php
                $fieldname = "*";
                $tblname = "criterios";
                $buscarcriterios = $dbconnect->seleccionarDatos($fieldname, $tblname);
                if(mysql_num_rows($buscarcriterios) > 0){
                    while($datoscriterios = mysql_fetch_array($buscarcriterios)){
                    ?>
                        <th class="ui-widget-header"><?=$datoscriterios["criterio"]?></th>
                        <?php
                    }
                }
            ?>
            </tr>
            
            
            <!--Contenido de la tabla-->
            <?php
                $fieldnameevaluacion = " t1.fk_id_juradoFuncional, t1.nombre, t2.nombre";
                $tblnameevaluacion = "equipos AS t1, retos AS t2";
                $conditionevaluacion = "t1.fk_id_juradoFuncional = " .$_SESSION['$idUsuario']. " AND t1.fk_id_reto = t2.id";
                $buscarevaluacion = $dbconnect->seleccionarDatosCondicion($fieldnameevaluacion, $tblnameevaluacion, $conditionevaluacion);
                if(mysql_num_rows($buscarevaluacion) > 0){
                    $contadorregistros = 0;
                    while($datosevaluacion = mysql_fetch_array($buscarevaluacion)){
                        ?>
                            <tr>
                                <th><?=$datosevaluacion[2]?></th>
                                <th><?=$datosevaluacion[1]?></th>
                                <?php
                                    $fieldnamecalif = "t1.valor_calificacion, t2.id";
                                    $tblnamecalif = "valor_calificacion AS t1, calificacion AS t2";
                                    $conditioncalif = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacion[0] ."'";
                                    $buscarcalif = $dbconnect->seleccionarDatosCondicion($fieldnamecalif, $tblnamecalif, $conditioncalif);
                                    $contadorcalif = 0;
                                    $arraydatoscalif = array();
                                    while($datoscalif = mysql_fetch_array($buscarcalif)){
                                        $arraydatoscalif[] =$datoscalif[0];      
                                        //echo $arraydatoscalif[$contadorcalif];
                                        $contadorcalif ++ ;
                                    }
                                    ?>
                                    <form name="calificaciones" method="post" action="editarCalificacion.php">
                                        <th>
                                            <select name="tiemporespuesta<?php echo $contadorregistros ?>" >
                                                <option <?php if($arraydatoscalif[0]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[0]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[0]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[0]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[0]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[0]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="presentacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[1]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[1]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[1]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[1]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[1]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[1]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="trespuesta<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[2]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[2]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[2]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[2]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[2]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[2]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="lgrafico<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[3]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[3]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[3]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[3]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[3]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[3]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="ucolores<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[4]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[4]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[4]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[4]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[4]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[4]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="nitidez<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[5]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[5]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[5]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[5]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[5]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[5]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="problematica<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[6]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[6]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[6]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[6]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[6]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[6]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="viabilidad<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[7]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[7]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[7]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[7]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[7]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[7]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="completitud<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[8]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[8]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[8]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[8]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[8]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[8]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="innovacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[9]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[9]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[9]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[9]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[9]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[9]==='5'){echo "selected";}?>>5</option>
                                            </select>                                        
                                        </th>
                                        <th>
                                            <select name="combinacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[10]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[10]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[10]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[10]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[10]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[10]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="renovacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[11]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[11]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[11]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[11]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[11]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[11]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <input type="submit" value="Guardar"/>
                                        </th>
                                    </form>               
                                </tr>
                        <?php
                    }
                }else{
                    echo "No se encontraron datos de evaluación";
                }
            ?>
        </table>
        <?php
    } else {
        echo "Usted no ha sido asignado como jurado funcional.";
    }
    
    echo "</br>";
    //Tabla de calificación técnica
    $fieldnamefuncionalt = "fk_id_juradoTecnico ";
    $tblnamefuncionalt = "equipos";
    $conditionfuncionalt = $_SESSION['$idUsuario'] . " = " . $fieldnamefuncionalt;
    $buscart = $dbconnect->seleccionarDatosCondicion($fieldnamefuncionalt, $tblnamefuncionalt, $conditionfuncionalt);
    if(mysql_num_rows($buscart) > 0){
    ?>
        <table border = "1" width = "100%">
            <tr>
                <th colspan="15">MI CALIFICACION TECNICA</th>
            </tr>
            
            
            
            <!--Encabezado de la tabla con los criterios de Evaliación-->
            <tr>
                <th>Reto</th>
                <th>Equipo</th>
            <?php
                $fieldname = "*";
                $tblname = "criterios";
                $buscarcriterios = $dbconnect->seleccionarDatos($fieldname, $tblname);
                if(mysql_num_rows($buscarcriterios) > 0){
                    while($datoscriterios = mysql_fetch_array($buscarcriterios)){
                    ?>
                        <th><?=$datoscriterios["criterio"]?></th>
                        <?php
                    }
                }
            ?>
            </tr>
            
            
            <!--Contenido de la tabla-->
            <?php
                $fieldnameevaluacion = " t1.fk_id_juradoTecnico, t1.nombre, t2.nombre";
                $tblnameevaluacion = "equipos AS t1, retos AS t2";
                $conditionevaluacion = "t1.fk_id_juradoTecnico = " .$_SESSION['$idUsuario']. " AND t1.fk_id_reto = t2.id";
                $buscarevaluacion = $dbconnect->seleccionarDatosCondicion($fieldnameevaluacion, $tblnameevaluacion, $conditionevaluacion);
                if(mysql_num_rows($buscarevaluacion) > 0){
                    $contadorregistros = 0;
                    while($datosevaluacion = mysql_fetch_array($buscarevaluacion)){
                        ?>
                            <tr>
                                <th><?=$datosevaluacion[2]?></th>
                                <th><?=$datosevaluacion[1]?></th>
                                <?php
                                    $fieldnamecalif = "t1.valor_calificacion, t2.id";
                                    $tblnamecalif = "valor_calificacion AS t1, calificacion AS t2";
                                    $conditioncalif = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacion[0] ."'";
                                    $buscarcalif = $dbconnect->seleccionarDatosCondicion($fieldnamecalif, $tblnamecalif, $conditioncalif);
                                    $contadorcalif = 0;
                                    $arraydatoscalif = array();
                                    while($datoscalif = mysql_fetch_array($buscarcalif)){
                                        $arraydatoscalif[] =$datoscalif[0];      
                                        //echo $arraydatoscalif[$contadorcalif];
                                        $contadorcalif ++ ;
                                    }
                                    ?>
                                    <form name="calificaciones" method="post" action="editarCalificacion.php">
                                        <th>
                                            <select name="tiemporespuesta<?php echo $contadorregistros ?>" >
                                                <option <?php if($arraydatoscalif[0]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[0]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[0]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[0]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[0]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[0]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="presentacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[1]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[1]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[1]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[1]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[1]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[1]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="trespuesta<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[2]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[2]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[2]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[2]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[2]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[2]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="lgrafico<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[3]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[3]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[3]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[3]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[3]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[3]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="ucolores<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[4]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[4]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[4]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[4]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[4]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[4]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="nitidez<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[5]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[5]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[5]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[5]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[5]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[5]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="problematica<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[6]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[6]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[6]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[6]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[6]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[6]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="viabilidad<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[7]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[7]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[7]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[7]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[7]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[7]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="completitud<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[8]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[8]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[8]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[8]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[8]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[8]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="innovacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[9]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[9]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[9]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[9]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[9]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[9]==='5'){echo "selected";}?>>5</option>
                                            </select>                                        
                                        </th>
                                        <th>
                                            <select name="combinacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[10]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[10]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[10]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[10]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[10]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[10]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="renovacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[11]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[11]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[11]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[11]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[11]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[11]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <input type="submit" value="Guardar"/>
                                        </th>
                                    </form>               
                                </tr>
                        <?php
                    }
                }else{
                    echo "No se encontraron datos de evaluación";
                }
            ?>
        </table>
        <?php
    } else {
        echo "Usted no ha sido asignado como jurado técnico";
    }
    
    echo "</br>";
    //Tabla de calificación externa
    $fieldnamefuncionale = "fk_id_juradoExterno";
    $tblnamefuncionale = "equipos";
    $conditionfuncionale = $_SESSION['$idUsuario'] . " = " . $fieldnamefuncionale;
    $buscare = $dbconnect->seleccionarDatosCondicion($fieldnamefuncionale, $tblnamefuncionale, $conditionfuncionale);
    if(mysql_num_rows($buscare) > 0){
    ?>
        <table border = "1" width = "100%">
            <tr>
                <th colspan="15">MI CALIFICACION EXTERNA</th>
            </tr>
            
            
            
            <!--Encabezado de la tabla con los criterios de Evaliación-->
            <tr>
                <th>Reto</th>
                <th>Equipo</th>
            <?php
                $fieldname = "*";
                $tblname = "criterios";
                $buscarcriterios = $dbconnect->seleccionarDatos($fieldname, $tblname);
                if(mysql_num_rows($buscarcriterios) > 0){
                    while($datoscriterios = mysql_fetch_array($buscarcriterios)){
                    ?>
                        <th><?=$datoscriterios["criterio"]?></th>
                        <?php
                    }
                }
            ?>
            </tr>
            
            
            <!--Contenido de la tabla-->
            <?php
                $fieldnameevaluacion = " t1.fk_id_juradoExterno, t1.nombre, t2.nombre";
                $tblnameevaluacion = "equipos AS t1, retos AS t2";
                $conditionevaluacion = "t1.fk_id_juradoExterno = " .$_SESSION['$idUsuario']. " AND t1.fk_id_reto = t2.id";
                $buscarevaluacion = $dbconnect->seleccionarDatosCondicion($fieldnameevaluacion, $tblnameevaluacion, $conditionevaluacion);
                if(mysql_num_rows($buscarevaluacion) > 0){
                    $contadorregistros = 0;
                    while($datosevaluacion = mysql_fetch_array($buscarevaluacion)){
                        ?>
                            <tr>
                                <th><?=$datosevaluacion[2]?></th>
                                <th><?=$datosevaluacion[1]?></th>
                                <?php
                                    $fieldnamecalif = "t1.valor_calificacion, t2.id";
                                    $tblnamecalif = "valor_calificacion AS t1, calificacion AS t2";
                                    $conditioncalif = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacion[0] ."'";
                                    $buscarcalif = $dbconnect->seleccionarDatosCondicion($fieldnamecalif, $tblnamecalif, $conditioncalif);
                                    $contadorcalif = 0;
                                    $arraydatoscalif = array();
                                    while($datoscalif = mysql_fetch_array($buscarcalif)){
                                        $arraydatoscalif[] =$datoscalif[0];      
                                        //echo $arraydatoscalif[$contadorcalif];
                                        $contadorcalif ++ ;
                                    }
                                    ?>
                                    <form name="calificaciones" method="post" action="editarCalificacion.php">
                                        <th>
                                            <select name="tiemporespuesta<?php echo $contadorregistros ?>" >
                                                <option <?php if($arraydatoscalif[0]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[0]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[0]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[0]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[0]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[0]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="presentacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[1]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[1]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[1]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[1]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[1]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[1]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="trespuesta<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[2]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[2]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[2]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[2]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[2]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[2]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="lgrafico<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[3]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[3]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[3]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[3]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[3]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[3]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="ucolores<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[4]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[4]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[4]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[4]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[4]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[4]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="nitidez<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[5]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[5]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[5]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[5]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[5]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[5]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="problematica<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[6]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[6]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[6]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[6]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[6]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[6]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="viabilidad<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[7]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[7]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[7]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[7]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[7]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[7]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="completitud<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[8]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[8]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[8]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[8]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[8]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[8]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="innovacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[9]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[9]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[9]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[9]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[9]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[9]==='5'){echo "selected";}?>>5</option>
                                            </select>                                        
                                        </th>
                                        <th>
                                            <select name="combinacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[10]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[10]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[10]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[10]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[10]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[10]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="renovacion<?php echo $contadorregistros ?>">
                                                <option <?php if($arraydatoscalif[11]==='0'){echo "selected";}?>>0</option>
                                                <option <?php if($arraydatoscalif[11]==='1'){echo "selected";}?>>1</option>
                                                <option <?php if($arraydatoscalif[11]==='2'){echo "selected";}?>>2</option>
                                                <option <?php if($arraydatoscalif[11]==='3'){echo "selected";}?>>3</option>
                                                <option <?php if($arraydatoscalif[11]==='4'){echo "selected";}?>>4</option>
                                                <option <?php if($arraydatoscalif[11]==='5'){echo "selected";}?>>5</option>
                                            </select>
                                        </th>
                                        <th>
                                            <input type="submit" value="Guardar"/>
                                        </th>
                                    </form>               
                                </tr>
                        <?php
                    }
                }else{
                    echo "No se encontraron datos de evaluación";
                }
            ?>
        </table>
        <?php
    } else {
        echo "Usted no ha sido asignado como jurado externo.";
    }
    
    ob_end_flush();
    $dbconnect->cerrarConexion();
 ?>
        </body>
    </html>