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
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
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
        src: url("../fonts/Enriqueta-Regular.ttf"); 
    }
    @font-face { 
        font-family: 'Enriqueta';
        src: url("../fonts/Enriqueta-Bold.ttf"); 
    }
    p {
        font-family: 'Enriqueta', serif;
    }
</style>
<div class="header">
    <a href="" class="logo">MCB Computerkabinett</a>
    <div class="header-right">

        <a class="items" href="info.php">Informationen</a>
        <a class="active" href="management/index.php">Login/Meine VMs</a>
    </div>
</div>  
</head> 
<body>

    <?php 
    if(isset($errorMessage)) {
        echo $errorMessage;
    }
    ?>

    <form action="?login=1" method="post">
        E-Mail:<br>
        <input size="40" maxlength="250" name="nutzername"><br><br>

        Dein Passwort:<br>
        <input type="password" size="40"  maxlength="250" name="passwort"><br>

        <input type="submit" value="Anmelden">
    </form> 
</body>
</html>