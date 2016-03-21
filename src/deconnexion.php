<meta name="author" content="Guilhem SERENE">

<?php
	
	session_start();

	if (isset($SESSION["login"])) {
		echo "Deconnexion en cours " . $_SESSION["login"] . ", vous allez être redirigé dans 3 secondes";
	}
	
	//Destruction des variables de session
	session_unset();

	//Destruction de la session
	session_destroy();

	//Redirige l'utilisateur vers la page d'où il vient par defaut index.php
	if (isset($_GET["redirectTo"])) {
		header('Location: ' . $_GET["redirectTo"]);
	} else {
		header('Location: index.php');
	}
?>