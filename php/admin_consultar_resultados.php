<?php

/* 
 * Consultar los resultados de todas las calificaciones
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    include './mySqlConnection.php';
    include './arrayFunctions.php';
    include './consolidar_calificacion.php';
    header('Content-Type: text/html; charset=UTF-8');
    ob_start();
        $dbconnect = new mySqlConnection();
        $dbconnect->establecerConexion();
	$host= $dbconnect->getServer();
	$username= $dbconnect->getUser(); //Nombre del usuario de MySQL
	$password= $dbconnect->getPassword(); //Clave del usuario de MySQL
	$db_name= $dbconnect->getDataBase(); //Nombre de la Base de Datos
?>      
<html lang="es">
        
    <head>  
        <link href="../css/Tablas/Tablas.css" rel="stylesheet" type="text/css" />
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
        </script>
    </head>
    <body>
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
        <table>
            <tr>
                <th colspan="15">RESULTADOS DE CALIFICACIONES</th>
            </tr>
            <tr>
                <th>
                    <p class="etiquetaEncabezado">Reto</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Equipo</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Calificación Usabilidad</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Calificación Interfaz Gráfica</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Calificación Funcionalidad</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Calificación Innovación</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Calificación Interacción con Redes Sociales</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Calificación Viabilidad</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Suma de Calificaciones</p>
                </th>
                <th>
                    <p class="etiquetaEncabezado">Calificación Total</p>
                </th>
            </tr>
            
                <?php
                
                $datosArray = new arrayFunction;
                $connection = new mySqlConnection;
                $consolidar = new consolidar_Calificacion;
                $connection->establecerConexion();
                $fieldname = "DISTINCT t1.id, t1.nombre"; 
                $tblname = "retos AS t1"; 
                $datos = $connection->seleccionarDatos($fieldname, $tblname);
                $arrayRetos = $datosArray->datosAArray($datos);
//                $calificacionUsabilidad=0.0;
//                $calificacionInterGrafica=0.0;
                $datos = $connection->seleccionarDatos($fieldname, $tblname);
                $arrayRetos = $datosArray->datosAArrayBid($datos);
//                $calificacionUsabilidad=0.0;
                $calificacionUsabilidad = 0.0;
                            $calificacionInterGrafica=0.0;
                            $calificacionFuncionalidad=0.0;
                            $calificacionInnovacion=0.0;
                            $calificacionInteredes=0.0;
                            $calificacionViabilidad=0.0;
                            $grantotal = 0.0;
//                
                for($i=0;$i<count($arrayRetos);$i++){
                    //$self = new self();
                    $fieldnameEquipo = "DISTINCT t1.id, t1.nombre";
                    $tblnameEquipo = "equipos AS t1";
                    $conditionEquipo = "t1.fk_id_reto = ".$arrayRetos[$i][0];
                    $datosEquipos=$connection->seleccionarDatosCondicion($fieldnameEquipo,$tblnameEquipo,$conditionEquipo);
                    $arrayEquipos = $datosArray->datosAArrayBid($datosEquipos);
                    $arrayCal = array();
                    for($n=0;$n<count($arrayEquipos);$n++){
                        $fieldnameCal = "t1.id";
                        $tblnameCal = "calificacion AS t1";
                        $conditionCal = "t1.fk_id_equipo = ".$arrayEquipos[$n][0];
                        $datosCal = $connection->seleccionarDatosCondicion($fieldnameCal, $tblnameCal, $conditionCal);
                        $arrayCal = $datosArray->datosAArray($datosCal);
                        ?>
                        <tr>
                            <td><?php echo $arrayRetos[$i][1]?></td>
                            <td><?php echo $arrayEquipos[$n][1]?></td>
                        <?php
                        
                        $arrayCalVal = array();
                        for($s=0;$s<count($arrayCal);$s++){
                            $fieldnameCalVal = "t1.valor_calificacion";
                            $tblnameCalVal="valor_calificacion AS t1";
                            $conditionCalVal = "fk_id_calificacion = ".$arrayCal[$s];
                            $datosCalVal = $connection->seleccionarDatosCondicion($fieldnameCalVal, $tblnameCalVal, $conditionCalVal);
                            $arrayCalVal = $datosArray->datosAArray($datosCalVal);
//                            echo "<PRE>";
//                            var_dump($arrayCalVal);
//                            echo "</PRE>";
                            
                        
                        
                            for($m=0;$m<=count($arrayCalVal[0]);$m++){
                                //$calificaciones=$consolidar->consultarIdCalificaciones($arrayEquipos[$m][0]);
                                
                                $todasCalificaciones = $consolidar->consultarResultadoCalificacion($arrayCal[$m]);
                                $totalcalificacion = $consolidar->agruparResultadosCalificacion($todasCalificaciones);
//                                echo "<PRE>";
//                                var_dump($todasCalificaciones);
//                                echo "</PRE>";
                                $calificacionUsabilidad=$calificacionUsabilidad + $totalcalificacion['usabilidad'];
                                $calificacionInterGrafica=$calificacionInterGrafica + $totalcalificacion['grafica'];
                                $calificacionFuncionalidad=$calificacionFuncionalidad + $totalcalificacion['funcionalidad'];
                                $calificacionInnovacion=$calificacionInnovacion + $totalcalificacion['innovacion'];
                                $calificacionInteredes=$calificacionInteredes + $totalcalificacion['redes'];
                                $calificacionViabilidad=$calificacionViabilidad + $totalcalificacion['viabilidad'];
                                //echo $totalcalificacion['usabilidad'];  
                                $grantotal = $grantotal + $consolidar->granTotal($todasCalificaciones); 
                                echo "<PRE>";
                                var_dump($arrayCalVal);
                                echo "</PRE>";
                                ?>


                                <?php
                            }
                            
                        }
                        ?>
                             <td><?php echo $calificacionUsabilidad; ?></td>
                            <td><?php echo $calificacionInterGrafica; ?></td>
                            <td><?php echo $calificacionFuncionalidad; ?></td>
                            <td><?php echo $calificacionInnovacion; ?></td>
                            <td><?php echo $calificacionInteredes; ?></td>
                            <td><?php echo $calificacionViabilidad; ?></td>
                            <?php
                            $sumacalificaciones = $calificacionUsabilidad + 
                                                $calificacionInterGrafica + 
                                                $calificacionFuncionalidad + 
                                                $calificacionInnovacion + 
                                                $calificacionInteredes + 
                                                $calificacionViabilidad;
                    }
                    
                }
                
                            
//                            ?>
                            <td><?php echo $grantotal ?></td>
                            <?php $total = $grantotal/3; ?>
                            <td><?php echo $total?></td>
                            <?php
                            
//                for($i=0;$i<count($arrayEquipos);$i++){
//                    $fieldnamer = "t1.nombre";
//                    $tblnamer = "retos AS t1, equipos AS t2";
//                    $conditionr = "t1.id = t2.fk_id_reto ORDER BY t1.id";
//                    $datosr = $connection->seleccionarDatosCondicion($fieldnamer, $tblnamer, $conditionr);
//                    $retoactual = $datosArray->datosAArray($datosr);
//                    ?>
                    <tr>
                    <!--<td>//< ?php echo $retoactual[$i];?></td>-->
                    //<?php 
//                        $fieldnamen = "nombre,id";
//                        $tblnamen = "equipos";
//                        $conditionn = "id = ".$arrayEquipos[$i];
//                        $datosn = $connection->seleccionarDatosCondicion($fieldnamen, $tblnamen, $conditionn);
//                        $nombreactual = $datosArray->datosAArray($datosn);
//                        $idCalificaciones = $consolidar->consultarIdCalificaciones($arrayEquipos[$i]);
//                    ?>
                    <!--<td><? php echo $nombreactual[0]; ?></td>-->
                    <?php
                    //$idCalificaciones = $consolidar->consultarIdCalificaciones($arrayEquipos[$i]);
//                    echo "<PRE>";
//                    var_dump($idCalificaciones);
//                    echo "</PRE>";
//                    $totalFinal = 0.0;
//                    $cantidad = count($idCalificaciones);
//                        for($n=0;$n<count($idCalificaciones);$n++){
//                            $calificaciones=$consolidar->consultarResultadoCalificacion($idCalificaciones[$n]);
//                            echo "<PRE>";
//                            var_dump($calificaciones);
//                            echo "</PRE>";
//                            $totalcalificacion = $consolidar->agruparResultadosCalificacion($calificaciones);
//                            $calificacionUsabilidad=$calificacionUsabilidad + $totalcalificacion['usabilidad'];
//                            $calificacionInterGrafica=$calificacionInterGrafica + $totalcalificacion['grafica'];
//                            $calificacionFuncionalidad=$calificacionFuncionalidad + $totalcalificacion['funcionalidad'];
//                            $calificacionInnovacion=$calificacionInnovacion + $totalcalificacion['innovacion'];
//                            $calificacionInteredes=$calificacionInteredes + $totalcalificacion['redes'];
//                            $calificacionViabilidad=$calificacionViabilidad + $totalcalificacion['viabilidad'];
//                            //echo $totalcalificacion['usabilidad'];  
//                            $grantotal = $grantotal + $consolidar->granTotal($calificaciones);
//                        }
                    ?>
                    
                    <!--<td><? php echo $calificacionUsabilidad; ?></td>-->
                    <!--<td>< ?php echo $calificacionInterGrafica; ?></td>-->
                    <!--<td>< ?php echo $calificacionFuncionalidad; ?></td>-->
                    <!--<td>< ?php echo $calificacionInnovacion; ?></td>-->
                    <!--<td>< ?php echo $calificacionInteredes; ?></td>-->
                    <!--<td>< ?php echo $calificacionViabilidad; ?></td>-->
                    <?php // $sumacalificaciones = $calificacionUsabilidad + 
//                                                $calificacionInterGrafica + 
//                                                $calificacionFuncionalidad + 
//                                                $calificacionInnovacion + 
//                                                $calificacionInteredes + 
//                                                $calificacionViabilidad
                    ?>
                    
                    <!--<td>< ?php echo $grantotal ?></td>-->
                    <? php $total = $grantotal/3; ?>
                    <!--<td>< ?php echo $total?></td>-->
                    <!--</tr>-->
                    <?php
//                    $calificacionUsabilidad=0.0;
//                    $calificacionInterGrafica=0.0;
//                    $calificacionFuncionalidad=0.0;
//                    $calificacionInnovacion=0.0;
//                    $calificacionInteredes=0.0;
//                    $calificacionViabilidad=0.0;
//                    $grantotal = 0.0;
//               }
//                $connection->cerrarConexion();
                ?>
            </tr>
        </table>
    </body>
</html>