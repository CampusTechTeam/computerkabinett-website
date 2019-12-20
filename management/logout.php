<!DOCTYPE html> 
<html> 
<head>
  <title>MCB Computerkabinett - Logout </title>  
  <link rel = "stylesheet" type = "text/css" href = "../css/standard.css" />
  <style>
    @font-face { 
        font-family: 'Enriqueta';
        font-style: normal;
        src: url("../fonts/Enriqueta-Regular.ttf"); 
    }
    @font-face { 
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url("../fonts/Roboto-Regular.ttf"); 
    }
    @font-face { 
        font-family: 'Enriqueta';
        font-style: bold;
        src: url("../fonts/Enriqueta-Bold.ttf"); 
    }
    p {
        font-family: 'Roboto', normal;
    }
</style>
<div class="header">
    <a href="../index.php" class="logo">MCB Computerkabinett</a>
    <div class="header-right">

        <a class="items" href="../info.php">Informationen</a>
        <a class="active" href="login.php">Login/Meine VMs</a>
    </div>
</div>  
</head> 
<body>
<?php
session_start();
session_destroy();
echo("<meta http-equiv = 'refresh' content = '1; url = ../index.php' />");
echo "<p style='color: lime;'>Logout erfolgreich!</p>";
?>