<meta name="author" content="Guilhem SERENE">

<?php
	
	session_start();
	include('bd.inc.php');
	
	//Verification du login/password s'il est vide et s'il est enregistré en base de données
	if (!isset($_SESSION['login']) || !isset($_SESSION['password']) || !isset($_GET['id']) 
			|| !autorisation($_SESSION['login'], $_SESSION['password'])) {	
		echo '0';
	} else {
		
		$_GET['titre'] = addslashes($_GET['titre']);
		$_GET['contenu'] = addslashes($_GET['contenu']);
		
		//Supprime l'article et renvoit le success et l'echec
		$result = modifier_article($_GET['id'], $_GET['titre'], $_GET['contenu']);
		
		echo $result;

		
	}

?>