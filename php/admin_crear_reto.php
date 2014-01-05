<?php
    session_start();
    if(!$_SESSION["usuario"]= "myusername"){
        header("location:\\index.php");
    }
    //Forzar el uso de codificación utf-8
    header('Content-Type: text/html; charset=UTF-8');
?>
<html>
    <head>
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
        <div>
            <?php echo "Usted se ha registrado como: " .$_SESSION['$usuario']; ?> 
        </div>
        <header id="logo">
            <div align="center">
               <img src="../img/logoMinTIC.png" width="254" height="65">
               <img src="../img/ospinternational.jpg" width="137" height="67">
               <img src="../img/devant.jpg" width="137" height="67">
            </div>
        </header>
        <article id="featured-wrapper">
            <h1>CONSORCIO SOFTWARE 2012</h1>
            <p>Calificación de Aplicaciones - Proyecto Vive Gobierno Móvil</p>
            <a href="admin_login_success.php">
                    <img src="../img/Home-48.png" />
                    <p>Regresar</p>
            </a>
        </article>
            <div id="page-wrapper">
                <nav>    
                </nav>
                <article id="page-wrapper">
                    <form name="crearReto" method="post" action="nuevoReto.php">
                        <table class="tablaformulario" id="tablacrearReto">
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Nombre del Reto:</p>
                                </td>
                                <td>
                                    <input name="nombreReto" type="text" id="nombreReto">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="etiquetaForm">Iteración:</p>
                                </td>
                                <td>                                        
                                    <input type="number" name="iteracion" id="iteracion" ><br>
                                </td>
                            </tr>
                            <tr class="trBotones">
                                <td>
                                    <input type="button" title="cancelar" value="Cancelar">
                                </td>
                                <td>                                        
                                    <input type="submit" name="guardar" value="Guardar">
                                </td>
                            </tr>
                        </table>
                    </form>
                </article>
            </div>
        <footer id="copyright">
            <p>Consorcio Software 2012 - wilcom1</p>
        </footer>
    </body>
</html>