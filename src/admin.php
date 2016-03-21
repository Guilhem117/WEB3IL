<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Guilhem SERENE">

</head>

<header>
	<h1>Authentication Requise</h1>
</header>

<body>
	<form action="admin_panel.php <?php if (isset($GET["redirectTo"])) {echo "?redirectTo=" .  $GET["redirectTo"];}?>" method="POST">
		Login: <br/> 	
		<input type="text" name="login" value=""> <br/>
		Password: <br/>
		<input type="password" name="password" value=""><br/>		
		<input type="submit" value="Connexion"/>
	</form>
	
	<!-- Message d'erreur s'il y a un problème d'authentification -->
	<?php
		if (isset($_GET['authentification']) && $_GET['authentification'] == 'failed') { 
			echo "Erreur de connection, veuillez réessayer"; 
		}
	?>
	
</body>

<footer>
	<!--Pas de compte, créer en un : <a href="inscription.php">Inscription</a><br/>-->
	Cette page pourra faire l'objet de test pour les injections SQL.<br/>
	<?php 
	if (!isset($GET["redirectTo"])) {
		echo '<a href="index.php">Retour au site</a>';
	} else {
		echo '<a href="' . $GET["redirectTo"] . '">Retour au site</a>';
	}
	?>
	
</footer>

</html>