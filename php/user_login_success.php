<?php
session_start();
if(!$_SESSION["usuario"]= "myusername"){
header("location:\\index.php");
}
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
        </article>
            <div id="page-wrapper">
                <nav>
                    <div class="menu">
                        <!-- Start css3menu.com BODY section -->
                        <ul id="css3menu0" class="topmenu">
                        <li class="topfirst"><a href="#" style="width:180px;"><span><img src="admin_login_success_files/css3menu0/122.png" alt=""/>Mis Retos</span></a>
                            <ul>
                                <li><a href="">Mis Retos</a></li>           
                            </ul>
                        </li>
                        <li class="topmenu"><a href="#" style="width:180px;"><span><img src="admin_login_success_files/css3menu0/54.png" alt=""/>Mis Equipos</span></a>
                            <ul>
                                    <li><a href="#">Mis Evaliaciones</a></li>
                            </ul>
                        <li class="topmenu"><a href="#" style="width:180px;"><span><img src="admin_login_success_files/css3menu0/2.png" alt=""/>Mis Evaluaciones</span></a>
                        <ul>
                                <li><a href="#">Consultar Evaluaciones</a></li>
                                <li><a href="#">Nueva Evaluacion</a></li>
                        </ul></li>
                        <li class="toplast"><a href="#" style="width:180px;"><span><img src="admin_login_success_files/css3menu0/81.png" alt=""/>Resultados</span></a>
                        <ul>
                                <li><a href="#">Consultar Resultados</a></li>
                        </ul></li>
                        </ul><p class="_css3m"><a href="http://css3menu.com/">Create Drop Down Menu HTML </a> by Css3Menu.com</p>
                        <!-- End css3menu.com BODY section -->
                    </div>
                </nav>
                <article id="page-wrapper">
                    <iframe src= "<?php echo $_SESSION['$panel']; ?>"
                            name="AllInfo"
                            style="width:75%; height:300px; margin:5px;">
                    </iframe>
                </article>
            </div>
        <footer id="copyright">
            <p>Consorcio Software 2012 - wilcom1</p>
        </footer>
    </body>
</html>