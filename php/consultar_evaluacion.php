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
    ?>
    <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>
<?php
    //$conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
    //mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
    $fieldnamefuncional = "fk_id_juradoFuncional ";
    $tblnamefuncional = "equipos";
    $conditionfuncional = $_SESSION['$idUsuario'] . " = " . $fieldnamefuncional;
    $buscar = $dbconnect->seleccionarDatosCondicion($fieldnamefuncional, $tblnamefuncional, $conditionfuncional);
    if(mysql_num_rows($buscar) > 0){
    ?>       
        <body>
            <div>
                <table border = "1" width = "100%">
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
                                                $fieldnamecalif1 = "t1.valor_calificacion, t2.id";
                                                $tblnamecalif1 = "valor_calificacion AS t1, calificacion AS t2";
                                                $conditioncalif1 = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacion[0] ."'";
                                                $buscarcalif1 = $dbconnect->seleccionarDatosCondicion($fieldnamecalif1, $tblnamecalif1, $conditioncalif1);
                                                $contadorcalif1 = 0;
                                                $arraydatoscalif1 = array();
                                                while($datoscalif1 = mysql_fetch_array($buscarcalif1)){
                                                    $arraydatoscalif1[] =$datoscalif1[0];      
                                                    //echo $arraydatoscalif[$contadorcalif];
                                                    $contadorcalif1 ++ ;
                                                }
                                                ?>
                                                <form name="calificaciones" method="post" action="editarCalificacion.php">
                                                    <th>
                                                        <select name="tiemporespuesta<?php echo $contadorregistros ?>" >
                                                            <option <?php if($arraydatoscalif1[0]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[0]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[0]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[0]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[0]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[0]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="presentacion<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[1]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[1]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[1]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[1]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[1]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[1]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="trespuesta<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[2]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[2]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[2]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[2]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[2]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[2]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="lgrafico<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[3]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[3]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[3]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[3]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[3]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[3]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="ucolores<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[4]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[4]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[4]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[4]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[4]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[4]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="nitidez<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[5]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[5]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[5]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[5]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[5]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[5]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="problematica<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[6]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[6]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[6]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[6]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[6]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[6]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="viabilidad<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[7]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[7]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[7]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[7]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[7]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[7]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="completitud<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[8]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[8]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[8]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[8]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[8]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[8]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="innovacion<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[9]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[9]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[9]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[9]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[9]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[9]==='5'){echo "selected";}?>>5</option>
                                                        </select>                                        
                                                    </th>
                                                    <th>
                                                        <select name="combinacion<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[10]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[10]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[10]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[10]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[10]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[10]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="renovacion<?php echo $contadorregistros ?>">
                                                            <option <?php if($arraydatoscalif1[11]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif1[11]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif1[11]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif1[11]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif1[11]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif1[11]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="submit" value="Guardar"/>
                                                    </th>
                                                </form>               
                                           </tr>
                                    <?php
                                }
                                $contadorregistros++;
                            }else{
                                echo "No se encontraron datos de evaluación";
                            }
                        ?>
                    </table>
                    <?php
                } else {
                    echo "Usted no ha sido asignado como jurado funcional.";
                }
            ?>
            <br>
            
            <?php
                //$conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
                //mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
                $fieldnametecnico = "fk_id_juradoTecnico ";
                $tblnametecnico = "equipos";
                $conditiontecnico = $_SESSION['$idUsuario'] . " = " . $fieldnametecnico;
                $buscart = $dbconnect->seleccionarDatosCondicion($fieldnametecnico, $tblnametecnico, $conditiontecnico);
                if(mysql_num_rows($buscart) > 0){
                ?>

                    <body>
                        <table border = "1" width = "100%">
                        <tr>
                            <th colspan="15">MI CALIFICACION TECNICA</th>
                        </tr>



                        <!--Encabezado de la tabla con los criterios de Evaliación-->
                        <tr>
                            <th>Reto</th>
                            <th>Equipo</th>
                        <?php
                            $fieldnamet = "*";
                            $tblnamet = "criterios";
                            $buscarcriteriost = $dbconnect->seleccionarDatos($fieldnamet, $tblnamet);
                            if(mysql_num_rows($buscarcriteriost) > 0){
                                while($datoscriteriost = mysql_fetch_array($buscarcriteriost)){
                                ?>
                                    <th class="ui-widget-header"><?=$datoscriteriost["criterio"]?></th>
                                    <?php
                                }
                            }
                        ?>

                        <!--Contenido de la tabla-->
                        <?php
                            $fieldnameevaluaciont = " t1.fk_id_juradoTecnico, t1.nombre, t2.nombre";
                            $tblnameevaluaciont = "equipos AS t1, retos AS t2";
                            $conditionevaluaciont = "t1.fk_id_juradoTecnico = " .$_SESSION['$idUsuario']. " AND t1.fk_id_reto = t2.id";
                            $buscarevaluaciont = $dbconnect->seleccionarDatosCondicion($fieldnameevaluaciont, $tblnameevaluaciont, $conditionevaluaciont);
                            if(mysql_num_rows($buscarevaluaciont) > 0){
                                $contadorregistrost = 0;
                                while($datosevaluaciont = mysql_fetch_array($buscarevaluaciont)){
                                    ?>
                                        <tr>
                                            <th><?=$datosevaluaciont[2]?></th>
                                            <th><?=$datosevaluaciont[1]?></th>
                                            <?php
                                                $fieldnamecalif3 = "t1.valor_calificacion, t2.id";
                                                $tblnamecalif3 = "valor_calificacion AS t1, calificacion AS t2";
                                                $conditioncalif3 = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluaciont[0] ."'";
                                                $buscarcalif3 = $dbconnect->seleccionarDatosCondicion($fieldnamecalif3, $tblnamecalif3, $conditioncalif3);
                                                $contadorcalif3 = 0;
                                                $arraydatoscalif3 = array();
                                                while($datoscalif3 = mysql_fetch_array($buscarcalif3)){
                                                    $arraydatoscalif3[] =$datoscalif3[0];      
                                                    //echo $arraydatoscalif[$contadorcalif];
                                                    $contadorcalif3 ++ ;
                                                }
                                                ?>
                                                <form name="calificaciones" method="post" action="editarCalificacion.php">
                                                    <th>
                                                        <select name="tiemporespuesta<?php echo $contadorregistrost ?>" >
                                                            <option <?php if($arraydatoscalif3[0]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[0]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[0]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[0]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[0]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[0]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="presentacion<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[1]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[1]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[1]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[1]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[1]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[1]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="trespuesta<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[2]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[2]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[2]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[2]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[2]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[2]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="lgrafico<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[3]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[3]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[3]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[3]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[3]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[3]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="ucolores<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[4]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[4]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[4]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[4]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[4]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[4]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="nitidez<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[5]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[5]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[5]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[5]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[5]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[5]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="problematica<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[6]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[6]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[6]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[6]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[6]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[6]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="viabilidad<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[7]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[7]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[7]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[7]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[7]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[7]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="completitud<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[8]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[8]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[8]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[8]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[8]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[8]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="innovacion<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[9]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[9]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[9]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[9]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[9]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[9]==='5'){echo "selected";}?>>5</option>
                                                        </select>                                        
                                                    </th>
                                                    <th>
                                                        <select name="combinacion<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[10]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[10]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[10]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[10]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[10]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[10]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="renovacion<?php echo $contadorregistrost ?>">
                                                            <option <?php if($arraydatoscalif3[11]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif3[11]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif3[11]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif3[11]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif3[11]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif3[11]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="submit" value="Guardar"/>
                                                    </th>
                                                </form>               
                                           </tr>
                                    <?php
                                }
                                $contadorregistrost++;
                            }else{
                                echo "No se encontraron datos de evaluación";
                            }
                        ?>
                    </table>
                    <?php
                } else {
                    echo "Usted no ha sido asignado como jurado Técnico.";
                }

            ?>
            <br>
            <?php
                //$conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
                //mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
                $fieldnameext = "fk_id_juradoExterno ";
                $tblnameext = "equipos";
                $conditionext = $_SESSION['$idUsuario'] . " = " . $fieldnameext;
                $buscare = $dbconnect->seleccionarDatosCondicion($fieldnameext, $tblnameext, $conditionext);
                if(mysql_num_rows($buscare) > 0){
                ?>

                    <body>
                        <table border = "1" width = "100%">
                        <tr>
                            <th colspan="15">MI CALIFICACION EXTERNA</th>
                        </tr>



                        <!--Encabezado de la tabla con los criterios de Evaliación-->
                        <tr>
                            <th>Reto</th>
                            <th>Equipo</th>
                        <?php
                            $fieldnamee = "*";
                            $tblnamee = "criterios";
                            $buscarcriteriose = $dbconnect->seleccionarDatos($fieldnamee, $tblnamee);
                            if(mysql_num_rows($buscarcriteriose) > 0){
                                while($datoscriteriose = mysql_fetch_array($buscarcriteriose)){
                                ?>
                                    <th class="ui-widget-header"><?=$datoscriteriose["criterio"]?></th>
                                    <?php
                                }
                            }
                        ?>
                        
                        <!--Contenido de la tabla-->
                        <?php
                            $fieldnameevaluacione = " t1.fk_id_juradoExterno, t1.nombre, t2.nombre";
                            $tblnameevaluacione = "equipos AS t1, retos AS t2";
                            $conditionevaluacione = "t1.fk_id_juradoExterno = " .$_SESSION['$idUsuario']. " AND t1.fk_id_reto = t2.id";
                            $buscarevaluacione = $dbconnect->seleccionarDatosCondicion($fieldnameevaluacione, $tblnameevaluacione, $conditionevaluacione);
                            if(mysql_num_rows($buscarevaluacione) > 0){
                                $contadorregistrose = 0;
                                while($datosevaluacione = mysql_fetch_array($buscarevaluacione)){
                                    ?>
                                        <tr>
                                            <th><?=$datosevaluacione[2]?></th>
                                            <th><?=$datosevaluacione[1]?></th>
                                            <?php
                                                $fieldnamecalif2 = "t1.valor_calificacion, t2.id";
                                                $tblnamecalif2 = "valor_calificacion AS t1, calificacion AS t2";
                                                $conditioncalif2 = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacione[0] ."'";
                                                $buscarcalif2 = $dbconnect->seleccionarDatosCondicion($fieldnamecalif2, $tblnamecalif2, $conditioncalif2);
                                                $contadorcalif2 = 0;
                                                $arraydatoscalif2 = array();
                                                while($datoscalif2 = mysql_fetch_array($buscarcalif2)){
                                                    $arraydatoscalif2[] =$datoscalif2[0];      
                                                    //echo $arraydatoscalif[$contadorcalif];
                                                    $contadorcalif2 ++ ;
                                                }
                                                ?>
                                                <form name="calificaciones" method="post" action="editarCalificacion.php">
                                                    <th>
                                                        <select name="tiemporespuesta<?php echo $contadorregistrose ?>" >
                                                            <option <?php if($arraydatoscalif2[0]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[0]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[0]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[0]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[0]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[0]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="presentacion<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[1]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[1]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[1]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[1]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[1]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[1]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="trespuesta<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[2]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[2]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[2]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[2]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[2]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[2]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="lgrafico<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[3]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[3]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[3]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[3]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[3]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[3]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="ucolores<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[4]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[4]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[4]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[4]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[4]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[4]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="nitidez<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[5]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[5]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[5]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[5]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[5]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[5]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="problematica<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[6]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[6]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[6]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[6]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[6]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[6]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="viabilidad<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[7]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[7]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[7]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[7]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[7]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[7]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="completitud<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[8]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[8]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[8]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[8]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[8]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[8]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="innovacion<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[9]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[9]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[9]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[9]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[9]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[9]==='5'){echo "selected";}?>>5</option>
                                                        </select>                                        
                                                    </th>
                                                    <th>
                                                        <select name="combinacion<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[10]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[10]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[10]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[10]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[10]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[10]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="renovacion<?php echo $contadorregistrose ?>">
                                                            <option <?php if($arraydatoscalif2[11]==='0'){echo "selected";}?>>0</option>
                                                            <option <?php if($arraydatoscalif2[11]==='1'){echo "selected";}?>>1</option>
                                                            <option <?php if($arraydatoscalif2[11]==='2'){echo "selected";}?>>2</option>
                                                            <option <?php if($arraydatoscalif2[11]==='3'){echo "selected";}?>>3</option>
                                                            <option <?php if($arraydatoscalif2[11]==='4'){echo "selected";}?>>4</option>
                                                            <option <?php if($arraydatoscalif2[11]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="submit" value="Guardar"/>
                                                    </th>
                                                </form>               
                                           </tr>
                                    <?php
                                }
                                $contadorregistrose++;
                            }else{
                                echo "No se encontraron datos de evaluación";
                            }
                        ?>
                    </table>
                    <?php
                } else {
                    echo "Usted no ha sido asignado como jurado Externo.";
                }   
                ob_end_flush();
                $dbconnect->cerrarConexion();
             ?>
            </div>
        </body>
    </html>