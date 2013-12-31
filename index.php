<html>
 <head>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 	<title>Log In</title>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
	<link href="css/estilo/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/estilo/fonts.css" rel="stylesheet" type="text/css" media="all" />
 </head>
 <body>
 	<header id="logo">
		<div align="center">
        	<img src="img/logoMinTIC.png" width="254" height="65">
            <img src="img/ospinternational.jpg" width="137" height="67">
            <img src="img/devant.jpg" width="137" height="67">
        </div>
 	</header>
    <section id="featured-wrapper">
	   		<h1>CONSORCIO SOFTWARE 2012</h1>
       		<p>Calificación de Aplicaciones - Proyecto Vive Gobierno Móvil</p>
    </section>
    <section id="page-wrapper">
            <table 
                width="300" 
                border="0" 
                align="center" 
                cellpadding="0" 
                cellspacing="1" 
                bgcolor="#CCCCCC">
    			<tr>
                            <form 
                                name="form1" 
                                method="post" 
                                action="php/checklogin.php">
                        <td>
                            <table 
                            	width="100%" 
                                border="0" 
                                cellpadding="3" 
                                cellspacing="1" 
                                bgcolor="#FFFFFF">
                                <tr>
                                    <td
                                    	colspan="3">
                                        <strong>Registro de Usuarios</strong>
                                  </td>
                                </tr>
                                <tr>
                                    <td width="78">Username</td>
                                    <td width="6">:</td>
                                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input name="mypassword" type="text" id="mypassword"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="Submit" value="Login"></td>
                                </tr>
                        </table>
                    </td>
                 </form>
    		</tr>
    	</table>
    </section>
    <footer id="featured-wrapper">
    </footer>
 </body>
</html>