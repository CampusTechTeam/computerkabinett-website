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
        <a class="active" href="login.php">Login/Meine VMs</a>
    </div>
</div>  
</head> 
<body>

<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=computerkabinett', 'webhost', 'wL2uSP4Ex2KD');
if(!isset($_SESSION['userid'])) {
    echo("<meta http-equiv = 'refresh' content = '1; url = login.php?ref=resetstudentpw.php' />");
    die('<p>Um diese funktionalität zu nutzen ist der <a href="login.php">Login</a> erforderlich! Die Weiterleitung zum Login erfolgt in der regel automatisch</p>');
}
if($_SESSION['admin']!=1){
    die("Das Erstellen neuer Accounts ist nur befugten Personen erlaubt!");
}
$showForm=true;
if(isset($_GET['send'])) {
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	
	if($passwort != $passwort2) {
		echo "Die Passw&oumlrter stimmen nicht überein!";
	} else { //Speichere neues Passwort und lösche den Code
		$passworthash = password_hash($passwort, PASSWORD_DEFAULT);
		$statement = $pdo->prepare("UPDATE users SET passwort = :passworthash WHERE nutzername = :username");
		$result = $statement->execute(array('passworthash' => $passworthash, 'username'=> $_POST['username'] ));
		
		if($result) {
			echo "Das Passwort von ";
			echo $_POST['username'];
			echo " wurde ge&aumlndert";
			$showForm = false;
		}
	}
}

?>
<?php 


if($showForm):
?>

<form action="?send=1" method="post">
<label for="username"><p>Nutzername:</label><br>
<input name="username" required><br>
<label for="passwort">Passwort:</label><br>
<input type="password" id="passwort" name="passwort" required><br>
 
<label for="passwort2">Passwort wiederholen:</label><br>
<input type="password" id="passwort2" name="passwort2" required><br>
 
<input type="submit" value="Passwort speichern" class="btn btn-lg btn-primary btn-block">
</p>
</form>
<?php 
endif;
?>
</body>
</html>