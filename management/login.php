<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=computerkabinett', 'webhost', 'wL2uSP4Ex2KD');

if(isset($_GET['login'])) {
    $nutzername = $_POST['nutzername'];
    $passwort = $_POST['passwort'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE nutzername = :nutzername");
    $result = $statement->execute(array('nutzername' => $nutzername));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['nutzername'] = $user['nutzername'];
        if(isset($_POST['ref'])){
            echo "<meta http-equiv = 'refresh' content = '1; url = ";
            echo $_POST['ref'];
            echo "' />";
        }
        die('Login erfolgreich');
    } else {
        $errorMessage = "Nutzername oder Passwort war ungültig<br>";
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>MCB Computerkabinett - Login</title>  
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
    if(isset($errorMessage)) {
        echo "<p style='color: red;'>";
        echo $errorMessage;
    }
    ?>

    <form action="?login=1" method="post">
        <p>Nutzername:<br>
            <input size="40" maxlength="250" name="nutzername"><br><br>
            Passwort:<br>
            <input type="password" size="40"  maxlength="250" name="passwort"><br>
            <?php
            if(isset($_GET['ref'])){
                echo "<input type='hidden' name='ref' value='";
                echo $_GET['ref'];
                echo "'>";
            }
            ?>
            <input type="submit" value="Anmelden">
        </p>
    </form> 
</body>
</html>