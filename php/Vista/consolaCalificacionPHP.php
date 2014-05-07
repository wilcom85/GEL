<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Clases/miCalificacionClass.php';
include_once '../Clases/criteriosClass.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mis Calificaciones</title>
        <link rel="stylesheet" href="../../skins/jquery-ui-1.10.4.custom/css/redmond/jquery-ui-1.10.4.custom.css">
    </head>
    <body>
        <table id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
            <thead class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
            <td>
                    <h4 class="demoHeaders">Criterios</h4>
                </td>
                <td colspan="20">
                    <h4 class="demoHeaders" >Equipos</h4>
                </td>
            </thead>
            <tr>
                
                <td>
                    <?php
                        
                        session_start();
                        $idUsuario = $_SESSION['$idUsuario'];
                        $misCalificaciones = new miCalificacionClass();
                        $equipos = $misCalificaciones->misCalificaciones($idUsuario);
                        for($i=0;$i<count($equipos);$i++){
                            $nombreEquipo = $misCalificaciones->getNombreEquipo($equipos[$i][1]);
                            echo '<td>';
                            echo $nombreEquipo;
                            echo '</td>';
                        }
                    ?>
                </td>
            </tr>
            <form name="calificacion" method="post" action="../Controlador/editarCalificacion.php">
                <?php

                    $criterios = new criteriosClass();
                    $misCriterios = $criterios->getCriterios();
                    for($n=0;$n<count($misCriterios);$n++){
                        echo '<tr>';
                            echo '<td>';
                            echo $misCriterios[$n];
                            echo '</td>';
                            $calificacion = new miCalificacionClass();
                            for($m=0;$m<count($equipos);$m++){
                                //Obtener las calificaciones del equipo
                                $miCalificacion[$m]=$calificacion->getCalificacionJurado($idUsuario, $equipos[$m][1], $n);
                                var_dump($miCalificacion);
                                echo '<td>';
                                echo '<select name="item'.$n.'team'.$m.'">';
                                    $valor = "";
                                    $calificacion = new miCalificacionClass();
                                    for($a=0;$a<=5;$a++){                                  
                                        echo '<option value="'.$a.'"';
                                            if($miCalificacion[$m][0]==$a){
                                                echo "selected";
                                            }
                                        echo '>'.$a .'</option>';
                                    }
                                echo '</select>';
                                echo '</td>';
                            }
                        echo '</tr>';
                    }
                    echo '<tr>';
                        echo '<td colspan="21">';
                        echo '<input type="submit" value="Guardar" name="button" />';
                        echo '</td>';
                    echo '</tr>';
                ?>
            </form>
        </table>
    </body>
</html>