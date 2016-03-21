<?php

	session_start();
	include('affich.inc.php');
	

	//Verification du login/password s'il est vide et s'il est enregistré en base de données
	if (!isset($_SESSION['login']) || !isset($_SESSION['password']) || !isset($_GET['titre']) || !isset($_GET['contenu']) 
			|| !autorisation($_SESSION['login'], $_SESSION['password'])) {	
		echo '0';
	} else {
        
		//Evite les problèmes de date
		date_default_timezone_set('Europe/Paris');
		
		//Permet de proteger certaines failles
		$_GET['titre'] = addslashes($_GET['titre']);
		$_GET['contenu'] = addslashes($_GET['contenu']);
		
		//Ajoute l'article et affiche revoie le code html de l'article
		$id = ajouter_article($_GET['titre'], date('Y-m-d'), $_GET['contenu'], $_SESSION['login']);
        
		afficher_article($id, $_GET['titre'], date('Y-m-d'), $_GET['contenu'], $_SESSION['login'], true);
		
	}

?>