<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dialogue
 *
 * @author stitc_000
 */
class dialogue {
    //put your code here
    public function dialogueError($message){
        echo "<div id='dialog' title='Fallo'><p><img src='../img/Error-32.png'>" .$message ."</p></div>";
    }
    public function dialogueSuccess($message){
        echo "<div id='dialog' title='Exito'><p><img src='../img/Tick-48.png'>" .$message ."</p></div>";
    }
}
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/jquery/jquery-ui.css">
        <script src="../jquery/jquery-1.10.2.js"></script>
        <script src="../jquery/jquery-ui.js"></script>
        <!--Script de cuadro de dialogo-->
        <script>
            $(function() {
                $( "#dialog" ).dialog({
                    width: 960,
                    hide: 'slide',
                    position: 'top',
                    show: 'slide',
                    close: function(event, ui) { location.href = 'admin_login_success.php' }
                });
            });
        </script>
    </head>
</html>