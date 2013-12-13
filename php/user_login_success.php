<?php
session_start();
if(!$_SESSION["usuario"]= "myusername"){
header("location:\\index.php");
}
?>

<html>
<body>
Login User Successful
</body>
</html>