<?php
    //Forzar el uso de codificación utf-8
    header('Content-Type: text/html; charset=UTF-8');    

    include 'mySqlConnection.php';
    
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
    $buscar = mysql_query("SELECT * FROM " .$tbl_name);
    if(mysql_num_rows($buscar) > 0){
    ?>
        <table border = "1" width = "100%">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Reto</th>
                <th>Jurado Funcional</th>
                <th>Jurado Técnico</th>
                <th>Jurado Externo</th>
            </tr>
            <?php
                while ($datos = mysql_fetch_array($buscar)){
                    ?>
                    <tr>
                    <td> <?=$datos["id"]?> </td>
                    <td> <?=$datos["nombre"]?> </td>
                    <!--Imprime el nombre del reto-->
                    <?php
                        $buscar2= $dbconnect->seleccionarDatosCondicion("nombre", "retos", "id=" .$datos["fk_id_reto"]);
                        $datos2 = mysql_fetch_array($buscar2);
                    ?>
                    <td> <?=$datos2["nombre"]?> </td>
                    <!--Imprime el nombre del Jurado Funcional-->
                    <?php
                        $buscar3 = $dbconnect->seleccionarDatosCondicion("nombre,apellido", "persona", "id=" .$datos["fk_id_juradoFuncional"]);
                        $datos3 = mysql_fetch_array($buscar3);
                    ?>
                    <td> <?=$datos3["nombre"]?> <?=$datos3["apellido"]?></td>
                    <!--I?=$datos3["nombre"]?>mprime el nombre del Jurado Tecnico-->
                    <?php
                        $buscar4 = $dbconnect->seleccionarDatosCondicion("nombre,apellido", "persona", "id=" .$datos["fk_id_juradoTecnico"]);
                        $datos4 = mysql_fetch_array($buscar4);
                    ?>
                    <td> <?=$datos4["nombre"]?> <?=$datos4["apellido"]?></td>
                    <!--Imprime el nombre del Jurado Externo-->
                    <?php
                        $buscar5 = $dbconnect->seleccionarDatosCondicion("nombre,apellido", "persona", "id=" .$datos["fk_id_juradoExterno"]);
                        $datos5 = mysql_fetch_array($buscar5);
                    ?>
                    <td> <?=$datos5["nombre"]?> <?=$datos5["apellido"]?></td>
                    </tr>
                    <?php
                }
                mysql_free_result($buscar);
                mysql_free_result($buscar2);
            ?>
        </table>
        <?php
    } else {
        echo "No se encontraron datos en la base de datos";
    }
    ob_end_flush();
    $dbconnect->cerrarConexion();
 ?>
