<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "../css/standard.css" />
  <title>MCB Computerkabinett - Meine VMs</title>

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
   tr:last-child {background-color: #00ccff; color: white;}
 </style>
 <div class="header">
  <a href="../index.php" class="logo">MCB Computerkabinett</a>
  <div class="header-right">
    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=computerkabinett', 'webhost', 'wL2uSP4Ex2KD');
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
#User needs Sudo Perms!
shell_exec("/usr/bin/sudo -u leanderneubronner /Applications/VirtualBox.app/Contents/MacOS/VBoxManage startvm '1' --type headless");
echo "<p syle='color: lime'><b>VM wurde gestartet! Bitte warte einen moment!</b></p>";
shell_exec("/usr/bin/ssh pi@raspberrypi.local \"export DISPLAY=:0; xfreerdp -f /usb:auto /sound /microphone /v:192.168.178.30:3389 /u:raspberrypi /p:5xyG7z9XZVZvwsWQSEA95qAhv5BXJCwYKkfqd9LZ\"");
echo "<p><b>Fenster wird geöffnet!</b></p>";
?>

</body>
</html>