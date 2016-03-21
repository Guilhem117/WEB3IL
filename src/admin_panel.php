<meta name="author" content="Guilhem SERENE">

<?php

	session_start();
	include('bd.inc.php');
	
	//Verification du login/password s'il est vide et s'il est enregistré en base de données
	if (!isset($_POST['login']) || !isset($_POST['password']) 
			|| !autorisation($_POST['login'], $_POST['password'])) {
	
		if (isset($GET["redirectTo"])) {
			header('Location: admin.php?authentification=failed' . '&redirectTo=' . $GET["redirectTo"]);
		} else {
			header('Location: admin.php?authentification=failed');
		}
	
	} else {
	
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['password'] = $_POST['password'];
		
		if (isset($GET["redirectTo"])) {
			header('Location: ' . $GET["redirectTo"]);
		} else {
			header('Location: index.php');
		}
	}

?>