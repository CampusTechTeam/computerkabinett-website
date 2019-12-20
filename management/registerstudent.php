<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=computerkabinett', 'webhost', 'wL2uSP4Ex2KD');
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>MCB Computerkabinett - Registrierung </title>  
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
        <a class="active" href="">Login/Meine VMs</a>
    </div>
</div>  
</head> 
<body>

    <?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $nutzername = $_POST['nutzername'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE nutzername = :nutzername");
        $result = $statement->execute(array('nutzername' => $nutzername));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Dieser Nutzername ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO users (nutzername, passwort) VALUES (:nutzername, :passwort)");
        $result = $statement->execute(array('nutzername' => $nutzername, 'passwort' => $passwort_hash));
        
        if($result) {        
            echo 'Sch&uumller registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Ein Datenbankfehler ist Aufgetreten!<br>';
        }
    } 
}

if($showFormular) {
    ?>

    <form action="?register=1" method="post">
        <p>Schüler Nutzername:<br>
            <input size="40" maxlength="250" name="nutzername"><br><br>

            Passwort:<br>
            <input type="password" size="40"  maxlength="250" name="passwort"><br>

            Passwort wiederholen:<br>
            <input type="password" size="40" maxlength="250" name="passwort2"><br><br>

            <input type="submit" value="Abschicken">
        </p>
    </form>

    <?php
} //Ende von if($showFormular)
?>

</body>
</html>