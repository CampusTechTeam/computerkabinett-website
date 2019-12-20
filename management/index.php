<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "../css/standard.css" />
  <title>MCB Computerkabinett - Meine VMs</title>

  <style>
    table {
     width: 100%;
     text-align: middle;
     font-family: 'Enriqueta', serif;
   }
   td {
     padding: 5px;
     text-align: middle;
     font-family: 'Enriqueta', serif;   
     border-top: 1px solid #ddd;
   }
   html {
    font-family: 'Enriqueta', serif;
  }
  tr:last-child {background-color: #00ccff; color: white;}
</style>
<div class="header">
  <a href="../index.php" class="logo">MCB Computerkabinett</a>
  <div class="header-right">
    <a class="items" href="../info.php">Informationen</a>
    <?php
    session_start();
    if(!isset($_SESSION['userid'])) {
      echo("<meta http-equiv = 'refresh' content = '1; url = login.php?ref=index.php' />");
      die("</div></div><p style='color: red;'>Um auf deine VMs zugreifen zu k&oumlnnen ist ein <a href='login.php'>Login</a> erforderlich! Die Weiterleitung zum Login erfolgt in der regel automatisch</p>");
    }
    echo "<a class='active' href='index.php'>Meine VMs</a>";
    echo "<a class='items' href='user.php'>";
    echo $_SESSION['nutzername'];
    echo "</a>";
    echo "<a class='items' href='logout.php'>Logout</a>";
    echo "<a class='items' href='help.php'>Hilfe</a>";
    ?>
    
    
  </div>
</div>
</head>
<body>
<?php
echo "Hier sind deine VMs im Mediencampus, ";
echo $_SESSION['nutzername'];
echo "!";