<?php
    //Forzar el uso de codificación utf-8
    header('Content-Type: text/html; charset=UTF-8');    

    include 'mySqlConnection.php';
    include './arrayFunctions.php';
    session_start();
    //Definición de Variables
    ob_start();
    $dbconnect = new mySqlConnection();
    $dbconnect->establecerConexion();
    $host = $dbconnect -> getServer(); //Nombre del Host
    $username = $dbconnect -> getUser(); //Nombre del usuario de MySQL
    $password = $dbconnect -> getPassword(); //Clave del usuario de MySQL
    $db_name = $dbconnect -> getDataBase(); //Nombre de la Base de Datos
     //Nombre de la Tabla
    
    //DATOS PARA LA TABLA DE CALIFICACION DE JURADOS
    $idJurado;
    $idequipo;
    $arrayCalificaciones;
    
    
    
    ?>
    <html lang="es">
        
        <head>  
            <link href="../css/Tablas/Tablas.css" rel="stylesheet" type="text/css" />
            <meta meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
            <script type="text/javascript">    
                function validarEnvioFuncional(){
                document.calificacionesFuncional.submit();
            }
            function validarEnvioTecnico(){
                document.calificacionesTecnica.submit();
            }
            function validarEnvioExterno(){
                document.calificacionesExterna.submit();
            }
        </script>
        </head>
<?php
    //$conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
    //mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
    $fieldnamefuncional = "fk_id_juradoFuncional ";
    $tblnamefuncional = "equipos";
    $conditionfuncional = $fieldnamefuncional ." = '" . $_SESSION['$idUsuario']."'";
    $buscar = $dbconnect->seleccionarDatosCondicion($fieldnamefuncional, $tblnamefuncional, $conditionfuncional);
    $referenciaId = 0;
    if(mysql_num_rows($buscar) > 0){
    //Variable que lleva el conteo del id de la ultima calificación para evitar que se trunque.
    
    
    ?>       
        <body>
            <div clas="funcional">
                <table>
                    <tr>
                        <th colspan="15">MI CALIFICACION</th>
                    </tr>
                        
                        <!--Encabezado de la tabla con los criterios de Evaliación-->
                    <tr>
                            <th rowspan="2"><p class="etiquetaEncabezado">Reto</p></th>
                            <th rowspan="2"><p class="etiquetaEncabezado">Equipo</p></th>
                            <th rowspan="2" style="display:none;"><p class="etiquetaEncabezado">Número</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Usabilidad</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Interfaz Gráfica</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Funcionalidad</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Innovación</p></th>
                            <th><p class="etiquetaEncabezado">Integración con Redes Sociales</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Viabilidad</p></th>
                            <th rowspan="2"><p class="etiquetaEncabezado">Guardar</p></th>
                    </tr>    
                    <tr>
                            
                            
                        <?php
                            $fieldname = "*";
                            $tblname = "criterios";
                            $condition1 = "'fk_id_aspectos'"; 
                            $buscarcriterios = $dbconnect->consultaTodosOrdenada($fieldname, $tblname,$condition1);
                            if(mysql_num_rows($buscarcriterios) > 0){
                                while($datoscriterios = mysql_fetch_array($buscarcriterios)){
                                ?>
                                    <th class="ui-widget-header"><p class="etiquetaEncabezado"><?=$datoscriterios["criterio"]?></p></th>
                                    <?php
                                }
                            }
                        ?>
                        
                    </tr>


                        <!--Contenido de la tabla-->
                        <?php
                            $fieldnameevaluacion = " t1.fk_id_juradoFuncional, t1.nombre, t2.nombre";
                            $tblnameevaluacion = "equipos AS t1, retos AS t2";
                            $conditionevaluacion = "t1.fk_id_juradoFuncional = '" .$_SESSION['$idUsuario']. "' AND t1.fk_id_reto = t2.id";
                            $buscarevaluacion = $dbconnect->seleccionarDatosCondicion($fieldnameevaluacion, $tblnameevaluacion, $conditionevaluacion);
                            if(mysql_num_rows($buscarevaluacion) > 0){
                                $contadorregistros = 0;
                                $arrayIdCal ;
                                while($datosevaluacion = mysql_fetch_array($buscarevaluacion)){
                                    //
                                    $idJurado = $datosevaluacion[0];
                                    //
                                    $datosaArray = new arrayFunction;
                                    
                                    ?>
                                        <tr>
                                            <td><?=$datosevaluacion[2]?></td>
                                            <td><?=$datosevaluacion[1]?></td>
                                            <?php 
                                                $fieldnamecalif1 = "t1.valor_calificacion, t2.id";
                                                $tblnamecalif1 = "valor_calificacion AS t1, calificacion AS t2";
                                                $conditioncalif1 = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacion[0] ."' AND t2.id >".$referenciaId;
                                                $buscarcalif1 = $dbconnect->seleccionarDatosCondicion($fieldnamecalif1, $tblnamecalif1, $conditioncalif1);
                                                $contadorcalif1 = 0;
                                                $arraydatoscalif1 = array();
                                                while($datoscalif1 = mysql_fetch_array($buscarcalif1)){
                                                    $arraydatoscalif1[] =$datoscalif1[0];
                                                    $arrayidcalif[]=$datoscalif1[1];
                                                    //echo $arraydatoscalif[$contadorcalif];
                                                    $contadorcalif1 ++ ;
                                                }
                                                if($contadorregistros == 0){
                                                    $fieldnamecal="distinct t2.id";
                                                    $tblnamecal = "calificacion AS t2,valor_calificacion AS t1";
                                                    $conditioncal="t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacion[0] ."' AND t2.id >".$referenciaId;
                                                    $idscalif= $dbconnect->seleccionarDatosCondicion($fieldnamecal, $tblnamecal, $conditioncal);
                                                    $arrayIdCal = $datosaArray->datosAArray($idscalif);
                                                    //Array de Ids de equipos
                                                    $fieldIdReto="fk_id_equipo";
                                                    $tblnmReto = "calificacion";
                                                    $conditionIdReto = "fk_id_jurado = ".$datosevaluacion[0];
                                                    $idsEquipos=$dbconnect->seleccionarDatosCondicion($fieldIdReto, $tblnmReto, $conditionIdReto);
                                                    $arrayIdEquipos = $datosaArray->datosAArray($idsEquipos);
                                                }
                                                ?>
                                                <form name="calificacionesFuncional" method="post" action="editarCalificacion.php">
                                                    <td style="display:none;">
                                                        <input type="text" name="nombreReto" readonly="readonly" value="<?php echo $datosevaluacion[2]?>">
                                                        <input type="text" name="nombreEquipo" readonly="readonly" value="<?php echo $datosevaluacion[1]?>">
                                                        
                                                        <?php $jurado=$dbconnect->seleccionarDatosCondicion("nombre, apellido","persona","id = ".$datosevaluacion[0]);?>
                                                        <?php $nombreJurado = mysql_fetch_array($jurado)?>
                                                        <?php echo "<PRE>";
                                                        var_dump($arrayIdCal);
                                                        echo "</PRE>"; ?>
                                                        <input type="text" name="nombreJurado" readonly="readonly" value="<?php echo $nombreJurado[0]." ".$nombreJurado[1]?>">
                                                        <input type="text" name="numero" readonly="readonly" value="<?php echo $arrayIdCal[$contadorregistros]; ?>" size="4"/>
                                                        <?php 
                                                            $referenciaId=$arrayIdCal[$contadorregistros];
//                                                            $contadorTotal=$contadorTotal + 3;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <select name="item0<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[0]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[0]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[0]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[0]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[0]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[0]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item1<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[1]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[1]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[1]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[1]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[1]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[1]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item2<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[2]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[2]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[2]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[2]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[2]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[2]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item3<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[3]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[3]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[3]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[3]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[3]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[3]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td> 
                                                    <td>
                                                        <select name="item4<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[4]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[4]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[4]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[4]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[4]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[4]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>  
                                                    <td>
                                                        <select name="item5<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[5]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[5]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[5]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[5]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[5]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[5]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>                                                    
                                                    <td>
                                                        <select name="item6<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[6]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[6]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[6]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[6]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[6]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[6]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item7<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[7]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[7]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[7]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[7]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[7]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[7]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item8<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[8]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[8]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[8]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[8]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[8]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[8]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item9<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[9]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[9]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[9]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[9]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[9]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[9]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item10<?php echo $arrayIdCal[$contadorregistros]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif1[10]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif1[10]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif1[10]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif1[10]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif1[10]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif1[10]==='5'){echo "selected";}?>>5</option>
                                                        </select>                                        
                                                    </td>
                                                    <td>
                                                        <input type="submit" value="Guardar" name="button" />
                                                    </td>
                                                </form>               
                                           </tr>
                                    <?php
                                $contadorregistros++;    
                                }
                                
                            }else{
                                echo "No se encontraron datos de evaluación";
                            }
                        ?>
                    </table>
            </div>
                    <?php
                } else {
                    //echo "Usted no ha sido asignado como jurado funcional.";
                }
            ?>
            <br>
            
            <?php
                //$conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
                //mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
                $fieldnametecnico = "fk_id_juradoTecnico ";
                $tblnametecnico = "equipos";
                $conditiontecnico ="'". $_SESSION['$idUsuario'] . "' = " . $fieldnametecnico;
                $buscart = $dbconnect->seleccionarDatosCondicion($fieldnametecnico, $tblnametecnico, $conditiontecnico);
                if(mysql_num_rows($buscart) > 0){
                ?>

                     <div>
                        <table>
                        <tr>
                            <th colspan="15">MI CALIFICACION</th>
                        </tr>



                        <!--Encabezado de la tabla con los criterios de Evaliación-->
                        <tr>
                            <th rowspan="2"><p class="etiquetaEncabezado">Reto</p></th>
                            <th rowspan="2"><p class="etiquetaEncabezado">Equipo</p></th>
                            <th rowspan="2" style="display: none"><p class="etiquetaEncabezado">Número</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Usabilidad</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Interfaz Gráfica</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Funcionalidad</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Innovación</p></th>
                            <th><p class="etiquetaEncabezado">Integración con Redes Sociales</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Viabilidad</p></th>
                            <th rowspan="2"><p class="etiquetaEncabezado">Guardar</p></th>
                        </tr>    
                        <tr>
                        <?php
                            $fieldnamet = "*";
                            $tblnamet = "criterios";
                            $conditiont = "fk_id_aspectos"; 
                            $buscarcriteriost = $dbconnect->consultaTodosOrdenada($fieldnamet, $tblnamet,$conditiont);
                            if(mysql_num_rows($buscarcriteriost) > 0){
                                while($datoscriteriost = mysql_fetch_array($buscarcriteriost)){
                                ?>
                                    
                                    <th class="ui-widget-header"><p class="etiquetaEncabezado"><?=$datoscriteriost["criterio"]?></p></th>
                                    <?php
                                }
                            }
                        ?>

                        <!--Contenido de la tabla-->
                        <?php
                            $fieldnameevaluaciont = " t1.fk_id_juradoTecnico, t1.nombre, t2.nombre";
                            $tblnameevaluaciont = "equipos AS t1, retos AS t2";
                            $conditionevaluaciont = "t1.fk_id_juradoTecnico = '" .$_SESSION['$idUsuario']. "' AND t1.fk_id_reto = t2.id";
                            $buscarevaluaciont = $dbconnect->seleccionarDatosCondicion($fieldnameevaluaciont, $tblnameevaluaciont, $conditionevaluaciont);
                            if(mysql_num_rows($buscarevaluaciont) > 0){
                                $datosaArray2 = new arrayFunction;
                                $contadorregistrost = 0;
                                $arrayIdCalt;
                                $arraydatoscalif3=array();
                                while($datosevaluaciont = mysql_fetch_array($buscarevaluaciont)){
                                     
                                    ?>
                                        <tr class="alt">
                                            <td><?=$datosevaluaciont[2]?></td>
                                            <td><?=$datosevaluaciont[1]?></td>
                                       <?php
                                           $fieldnamecalif3 = "t1.valor_calificacion, t2.id";
                                                $tblnamecalif3 = "valor_calificacion AS t1, calificacion AS t2";
                                                $conditioncalif3 = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = " .$datosevaluaciont[0] ." AND t2.id > ".$referenciaId;
                                                $buscarcalif3 = $dbconnect->seleccionarDatosCondicion($fieldnamecalif3, $tblnamecalif3, $conditioncalif3);
                                                $contadorcalif3 = 0;
                                                //$arraydatoscalif3 = array();
                                                //Obtener 
                                                
                                                                                              
                                                
                                                while($datoscalif3 = mysql_fetch_array($buscarcalif3)){
                                                    $arraydatoscalif3[] =$datoscalif3[0]; 
                                                    $arraydcalif3[]=$datoscalif3[1];
                                                    //echo $arraydatoscalif[$contadorcalif];
                                                    $contadorcalif3 ++ ;
                                                    
                                                }
                                                
                                                if($contadorregistrost == 0){
                                                    $fieldnamecalt="distinct t2.id";
                                                    $tblnamecalt = "calificacion AS t2,valor_calificacion AS t1";
                                                    $conditioncalt="t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluaciont[0] ."' AND t2.id > ".$referenciaId;
                                                    $idscalift= $dbconnect->seleccionarDatosCondicion($fieldnamecalt, $tblnamecalt, $conditioncalt);
                                                    $arrayIdCalt = $datosaArray2->datosAArray($idscalift);
                                                }
                                                ?>
                                                
                                                
                                                <form action="editarCalificacion.php" method="post" name="calificacionesTecnica" >
                                                    <td style="display:none;">
                                                        <input type="text" name="nombreReto" readonly="readonly" value="<?php echo $datosevaluaciont[2]?>">
                                                        <input type="text" name="nombreEquipo" readonly="readonly" value="<?php echo $datosevaluaciont[1]?>">
                                                        
                                                        <?php $jurado=$dbconnect->seleccionarDatosCondicion("nombre, apellido","persona","id = ".$datosevaluaciont[0]);?>
                                                        <?php $nombreJuradot = mysql_fetch_array($jurado)?>
                                                        <?php echo "<PRE>";
                                                        var_dump($arrayIdCalt);
                                                        echo "</PRE>"; ?>
                                                        <input type="text" name="nombreJurado" readonly="readonly" value="<?php echo $nombreJuradot[0]." ".$nombreJuradot[1]?>">
                                                        
                                                        <input type="text" name="numero" readonly="readonly" value="<?php echo $arrayIdCalt[$contadorregistrost]?>" size="4"/>
                                                        <?php 
                                                            $referenciaId=$arrayIdCalt[$contadorregistrost];
//                                                            $contadorTotal=$contadorTotal+3;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <select name="item0<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0" <?php if($arraydatoscalif3[0]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1" <?php if($arraydatoscalif3[0]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2" <?php if($arraydatoscalif3[0]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3" <?php if($arraydatoscalif3[0]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4" <?php if($arraydatoscalif3[0]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5" <?php if($arraydatoscalif3[0]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item1<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0" <?php if($arraydatoscalif3[1]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1" <?php if($arraydatoscalif3[1]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2" <?php if($arraydatoscalif3[1]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3" <?php if($arraydatoscalif3[1]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4" <?php if($arraydatoscalif3[1]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5" <?php if($arraydatoscalif3[1]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item2<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[2]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[2]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[2]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[2]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[2]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[2]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item3<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[3]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[3]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[3]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[3]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[3]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[3]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td> 
                                                    <td>
                                                        <select name="item4<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[4]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[4]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[4]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[4]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[4]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[4]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>  
                                                    <td>
                                                        <select name="item5<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[5]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[5]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[5]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[5]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[5]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[5]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>                                                    
                                                    <td>
                                                        <select name="item6<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[6]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[6]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[6]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[6]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[6]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[6]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item7<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[7]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[7]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[7]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[7]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[7]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[7]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item8<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[8]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[8]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[8]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[8]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[8]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[8]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item9<?php echo $arrayIdCalt[$contadorregistrost]; ?>">
                                                            <option value="0"<?php if($arraydatoscalif3[9]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[9]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[9]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[9]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[9]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[9]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item10<?php echo $arrayIdCalt[$contadorregistrost]; ?>" >
                                                            <option value="0"<?php if($arraydatoscalif3[10]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if($arraydatoscalif3[10]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if($arraydatoscalif3[10]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if($arraydatoscalif3[10]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if($arraydatoscalif3[10]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if($arraydatoscalif3[10]==='5'){echo "selected";}?>>5</option>
                                                        </select>                                        
                                                    </td>
                                                    <td>
                                                        <input type="submit" value="Guardar" name="button1" />
                                                    </td>
                                                </form>               
                                           </tr>
                                    <?php
                                $contadorregistrost++;    
                                }
                                
                            }else{
                                echo "No se encontraron datos de evaluación";
                            }
                        ?>
                    </table>
                     </div>
                    <?php
                } else {
                    //echo "Usted no ha sido asignado como jurado Técnico.";
                }

            ?>
            <br>
            <?php
                //$conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
                //mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
                $fieldnameext = "fk_id_juradoExterno ";
                $tblnameext = "equipos";
                $conditionext = "'".$_SESSION['$idUsuario'] . "' = " . $fieldnameext;
                $buscare = $dbconnect->seleccionarDatosCondicion($fieldnameext, $tblnameext, $conditionext);
                if(mysql_num_rows($buscare) > 0){
                ?>

                    <div>
                        <table>
                        <tr>
                            <th colspan="15">MI CALIFICACION</th>
                        </tr>



                        <!--Encabezado de la tabla con los criterios de Evaliación-->
                        <tr>
                            <th rowspan="2"><p class="etiquetaEncabezado">Reto</p></th>
                            <th rowspan="2"><p class="etiquetaEncabezado">Equipo</p></th>
                            <th rowspan="2" style="display: none"><p class="etiquetaEncabezado">Número</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Usabilidad</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Interfaz Gráfica</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Funcionalidad</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Innovación</p></th>
                            <th><p class="etiquetaEncabezado">Integración con Redes Sociales</p></th>
                            <th colspan="2"><p class="etiquetaEncabezado">Viabilidad</p></th>
                            <th rowspan="2"><p class="etiquetaEncabezado">Guardar</p></th>
                        </tr>    
                        <tr> 
                        <?php header('Content-Type: text/html; charset=UTF-8');  
                            $fieldnamee = "*";
                            $tblnamee = "criterios";
                            $conditione = "fk_id_aspectos"; 
                            $buscarcriteriose = $dbconnect->consultaTodosOrdenada($fieldnamee, $tblnamee,$conditione);
                            if(mysql_num_rows($buscarcriteriose) > 0){
                                while($datoscriteriose = mysql_fetch_array($buscarcriteriose)){
                                ?>
                                    <th class="ui-widget-header"><p class="etiquetaEncabezado"><?=$datoscriteriose["criterio"]?></p></th>
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
                                $arrayIdCale;
                                while($datosevaluacione = mysql_fetch_array($buscarevaluacione)){
                                    $datosaArray3 = new arrayFunction; 
                                    ?>
                                        <tr class="alt">
                                            <td><?=$datosevaluacione[2]?></td>
                                            <td><?=$datosevaluacione[1]?></td>
                                            <?php 
                                                $fieldnamecalif2 = "t1.valor_calificacion, t2.id";
                                                $tblnamecalif2 = "valor_calificacion AS t1, calificacion AS t2";
                                                $conditioncalif2 = "t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacione[0] ."' AND t2.id > ".$referenciaId;
                                                $buscarcalif2 = $dbconnect->seleccionarDatosCondicion($fieldnamecalif2, $tblnamecalif2, $conditioncalif2);
                                                $contadorcalif2 = 0;
                                                $arraydatoscalif2= array();
                                                while($datoscalif2 = mysql_fetch_array($buscarcalif2)){
                                                    $arraydatoscalif2[] =$datoscalif2[0];      
                                                    $arraydcalif2[]=$datoscalif2[1];
                                                    //echo $arraydatoscalif[$contadorcalif];
                                                    $contadorcalif2 ++ ;
                                                    
                                                }
                                                if($contadorregistrose == 0){
                                                    $fieldnamecale="distinct t2.id";
                                                    $tblnamecale = "calificacion AS t2,valor_calificacion AS t1";
                                                    $conditioncale="t1.fk_id_calificacion = t2.id AND t2.fk_id_jurado = '" .$datosevaluacione[0] ."' AND t2.id > ".$referenciaId;
                                                    $idscalife= $dbconnect->seleccionarDatosCondicion($fieldnamecale, $tblnamecale, $conditioncale);
                                                    $arrayIdCale = $datosaArray3->datosAArray($idscalife);
                                                    
                                                }
                                                
                                                ?>
                                                
                                                <form name="calificacionesExterna" method="post" action="editarCalificacion.php">
                                                    <td style="display:none;">
                                                        <input type="text" name="nombreReto" readonly="readonly" value="<?php echo $datosevaluacione[2]?>">
                                                        <input type="text" name="nombreEquipo" readonly="readonly" value="<?php echo $datosevaluacione[1]?>">
                                                        
                                                        <?php $jurado=$dbconnect->seleccionarDatosCondicion("nombre, apellido","persona","id = ".$datosevaluacione[0]);?>
                                                        <?php $nombreJuradoe = mysql_fetch_array($jurado)?>
                                                        <?php echo "<PRE>";
                                                        var_dump($arrayIdCale);
                                                        echo "</PRE>"; ?>
                                                        <input type="text" name="nombreJurado" readonly="readonly" value="<?php echo $nombreJuradoe[0]." ".$nombreJuradoe[1]?>">
                                                        
                                                        <input type="text" name="numero" readonly="readonly" value="<?php echo $arrayIdCale[$contadorregistrose]?>" size="4">
                                                        <?php 
                                                            $referenciaId=$arrayIdCale[$contadorregistrose];
//                                                            $contadorTotal=$contadorTotal+3;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <select name="item0<?php echo $arrayIdCale[$contadorregistrose]; ?>" >
                                                            <option value="0"<?php if( $arraydatoscalif2[0]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[0]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[0]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[0]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[0]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[0]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item1<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[1]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[1]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[1]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[1]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[1]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[1]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item2<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[2]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[2]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[2]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[2]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[2]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[2]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item3<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[3]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[3]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[3]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[3]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[3]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[3]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td> 
                                                    <td>
                                                        <select name="item4<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[4]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[4]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[4]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[4]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[4]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[4]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>  
                                                    <td>
                                                        <select name="item5<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[5]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[5]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[5]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[5]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[5]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[5]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>                                                    
                                                    <td>
                                                        <select name="item6<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[6]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[6]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[6]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[6]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[6]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[6]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        
                                                        <select name="item7<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[7]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[7]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[7]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[7]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[7]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[7]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item8<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[8]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[8]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[8]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[8]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[8]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[8]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item9<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[9]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[9]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[9]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[9]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[9]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[9]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item10<?php echo $arrayIdCale[$contadorregistrose]; ?>">
                                                            <option value="0"<?php if( $arraydatoscalif2[10]==='0'){echo "selected";}?>>0</option>
                                                            <option value="1"<?php if( $arraydatoscalif2[10]==='1'){echo "selected";}?>>1</option>
                                                            <option value="2"<?php if( $arraydatoscalif2[10]==='2'){echo "selected";}?>>2</option>
                                                            <option value="3"<?php if( $arraydatoscalif2[10]==='3'){echo "selected";}?>>3</option>
                                                            <option value="4"<?php if( $arraydatoscalif2[10]==='4'){echo "selected";}?>>4</option>
                                                            <option value="5"<?php if( $arraydatoscalif2[10]==='5'){echo "selected";}?>>5</option>
                                                        </select>                                        
                                                    </td>
<!--                                                    <td>
                                                        <select name="combinacion">
                                                            <option <-?php if( $arraydatoscalif2[11]==='0'){echo "selected";}?>>0</option>
                                                            <option <-?php if( $arraydatoscalif2[11]==='1'){echo "selected";}?>>1</option>
                                                            <option <-?php if( $arraydatoscalif2[11]==='2'){echo "selected";}?>>2</option>
                                                            <option <-?php if( $arraydatoscalif2[11]==='3'){echo "selected";}?>>3</option>
                                                            <option <-?php if( $arraydatoscalif2[11]==='4'){echo "selected";}?>>4</option>
                                                            <option <-?php if( $arraydatoscalif2[11]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="renovacion">
                                                            <option <-?php if( $arraydatoscalif2[12]==='0'){echo "selected";}?>>0</option>
                                                            <option <-?php if( $arraydatoscalif2[12]==='1'){echo "selected";}?>>1</option>
                                                            <option <-?php if( $arraydatoscalif2[12]==='2'){echo "selected";}?>>2</option>
                                                            <option <-?php if( $arraydatoscalif2[12]==='3'){echo "selected";}?>>3</option>
                                                            <option <-?php if( $arraydatoscalif2[12]==='4'){echo "selected";}?>>4</option>
                                                            <option <-?php if( $arraydatoscalif2[12]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="integraredes">
                                                            <option <-?php if( $arraydatoscalif2[13]==='0'){echo "selected";}?>>0</option>
                                                            <option <-?php if( $arraydatoscalif2[13]==='1'){echo "selected";}?>>1</option>
                                                            <option <-?php if( $arraydatoscalif2[13]==='2'){echo "selected";}?>>2</option>
                                                            <option <-?php if( $arraydatoscalif2[13]==='3'){echo "selected";}?>>3</option>
                                                            <option <-?php if( $arraydatoscalif2[13]==='4'){echo "selected";}?>>4</option>
                                                            <option <-?php if( $arraydatoscalif2[13]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="funsociales">
                                                            <option <-?php if( $arraydatoscalif2[14]==='0'){echo "selected";}?>>0</option>
                                                            <option <-?php if( $arraydatoscalif2[14]==='1'){echo "selected";}?>>1</option>
                                                            <option <-?php if( $arraydatoscalif2[14]==='2'){echo "selected";}?>>2</option>
                                                            <option <-?php if( $arraydatoscalif2[14]==='3'){echo "selected";}?>>3</option>
                                                            <option <-?php if( $arraydatoscalif2[14]==='4'){echo "selected";}?>>4</option>
                                                            <option <-?php if( $arraydatoscalif2[14]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="auteredes">
                                                            <option <-?php if( $arraydatoscalif2[15]==='0'){echo "selected";}?>>0</option>
                                                            <option <-?php if( $arraydatoscalif2[15]==='1'){echo "selected";}?>>1</option>
                                                            <option <-?php if( $arraydatoscalif2[15]==='2'){echo "selected";}?>>2</option>
                                                            <option <-?php if( $arraydatoscalif2[15]==='3'){echo "selected";}?>>3</option>
                                                            <option <-?php if( $arraydatoscalif2[15]==='4'){echo "selected";}?>>4</option>
                                                            <option <-?php if( $arraydatoscalif2[15]==='5'){echo "selected";}?>>5</option>
                                                        </select>
                                                    </th>-->
                                                    <td>
                                                        <input type="submit" value="Guardar" name="button2"/>
                                                    </td>
                                                </form>               
                                           </tr>
                                    <?php
                                $contadorregistrose++;    
                                }
                                
                            }else{
                                echo "No se encontraron datos de evaluación";
                            }
                        ?>
                    </table>
                    <?php
                } else {
                    //echo "Usted no ha sido asignado como jurado Externo.";
                }   
                ob_end_flush();
                $dbconnect->cerrarConexion();
             ?>
            </div>
        </body>
    </html>