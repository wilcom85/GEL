<?php
    //Forzar el uso de codificación utf-8
    header('Content-Type: text/html; charset=UTF-8');
    //Definición de Variables
    ob_start();
    $host="localhost:3306"; //Nombre del Host
    $username="root"; //Nombre del usuario de MySQL
    $password=""; //Clave del usuario de MySQL
    $db_name="vive_gob_movil"; //Nombre de la Base de Datos
    $tbl_name="retos";  //Nombre de la Tabla
    $conexion= mysqli_connect("$host","$username","$password") or die("No es posible conectarse a la base de datos: ". mysql_error());
    mysqli_select_db($conexion ,$db_name )or die("No es posible seleccionar una base de datos");
    $buscar = mysqli_query($conexion, "SELECT * FROM retos");
    if(mysqli_num_rows($buscar) > 0){
        ?>
        <table border = "1" width = "100%">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
            <?php
                while ($datos = mysqli_fetch_array($buscar)){
                    ?>
                    <tr>
                    <td> <?=$datos["id"]?> </td>
                    <td> <?=$datos["nombre"]?> </td>
                    </tr>
                    <?php
                }
                mysqli_free_result($buscar);
            ?>
        </table>
        <?php
    } else {
        echo "No se encontraron datos en la base de datos";
    }
    ob_end_flush();
 ?>