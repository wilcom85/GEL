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
            </tr>
            <?php
                while ($datos = mysql_fetch_array($buscar)){
                    ?>
                    <tr>
                    <td> <?=$datos["id"]?> </td>
                    <td> <?=$datos["nombre"]?> </td>
                    </tr>
                    <?php
                }
                mysql_free_result($buscar);
            ?>
        </table>
        <?php
    } else {
        echo "No se encontraron datos en la base de datos";
    }
    ob_end_flush();
 ?>
