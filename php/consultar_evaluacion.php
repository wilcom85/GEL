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
        <table border = "1" width = "100%">
            <tr>
                <th colspan="15">JURADO FUNCIONAL</th>
            </tr>
            
            
            
            <!--Encabezado de la tabla con los criterios de Evaliación-->
            <tr>
                <th>ID</th>
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
                $fieldnameevaluacion = " t1.nombre, t2.nombre";
                $tblnameevaluacion = "equipos AS t1, retos AS t2";
                $conditionevaluacion = "t1.fk_id_juradoFuncional = " .$_SESSION['$idUsuario']. " AND t1.fk_id_reto = t2.id";
                $buscarevaluacion = $dbconnect->seleccionarDatosCondicion($fieldnameevaluacion, $tblnameevaluacion, $conditionevaluacion);
                if(mysql_num_rows($buscarevaluacion) > 0){
                    while($datosevaluacion = mysql_fetch_array($buscarevaluacion)){
                        ?>
                            <td>
                                <th><?=$datosevaluacion[1]?></th>
                                <th><?=$datosevaluacion[0]?></th>
                            </td>
                        <?php
                    }
                }else{
                    echo "No se encontraron datos de evaluación";
                }
            ?>
            
            
        </table>
        <?php
    } else {
        echo "No se encontraron datos en la base de datos";
    }
    ob_end_flush();
    $dbconnect->cerrarConexion();
 ?>
