<?php
	
	/* VARIABLES GLOBALES */
	$host  = 'localhost';
	$dbname = 'mikoz';
	$chem_album = 'photos\\';
	
	//Utilisateur permettant d'acceder à la base de données
	$login = 'root';
	$password = 'root';
	
	//Charge le fichier ini contenant les elements de la page HTML
	$ini = parse_ini_file('elements.ini');
	
	
	//Permet de savoir si l'utilisateur est autorisé à se connecter au panel admin
	//Paramètres :
	//		login - login de l'utilisateur
	//		password - Mot de passe utilisateur
	//Retourne true s'il est autorisé
	//		   false s'il n'est pas autorisé ou s'il ya une erreur de connexion
	function autorisation($login, $password) {
		
		//Verification des paramètres d'entrées
		if (!isset($login)) {
			return false;
		}
		
		//Connexion
		$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'] , $GLOBALS['password'], $GLOBALS['dbname']);
		if (!$link) {
			die('autorisation : Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
		}
		
		//Cherche si l'utilisateur existe
		if (mysqli_num_rows(mysqli_query($link, "SELECT login FROM t_users WHERE login = '$login' and password = '$password'")) == 0) {
			//Aucune ligne ne correspond à l'utilisateur, il a rentré un mauvais mot de passe
			mysqli_close($link);
			return false;
		}
		
		//Deconnexion
		mysqli_close($link);
		return true;
	}

	//Retourne les données des derniers articles avec un decalage
	//Paramètres 
	//		nb_articles  - Nombre d'articles à retourner
	//		offset       - Decalage d'article
	//					   Si = 0 alors retourne les derniers articles
	//Retourne les derniers articles -> dans un result
	//			Aucun article
	function recuperer_derniers_articles($nb_articles=10, $offset=0) {
		
		//Verification des paramètres d'entrées
		if ($nb_articles <= 0) {
			$nb_articles = 10;
		}
		
		if ($offset < 0) {
			$offset = 0;
		}
		
		//Connexion
		$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'] , $GLOBALS['password'], $GLOBALS['dbname']);
		if (!$link) {
			die('autorisation : Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
		}
		
		//Retourne les derniers articles
		return mysqli_query($link, "SELECT id_article, titre, date_article, contenu, fk_login FROM t_article ORDER BY id_article DESC LIMIT " . $offset . "," . ($offset + $nb_articles -1));
		
	}
	

	//Ajoute un article dans la bd
	//Paramètres
	//	titre - Titre de l'article
	//	date_article - Date de modification de article
	//	contenu - Contenu de l'article
	//	auteur - auteur de l'article
	//Retourne l'id de l'article si l'article est crée
	//         0 si les paramètres ne sont pas correctement rempli
	//		   Message d'erreur si la connexion n'a pas pu etre établie
	function ajouter_article($titre, $date_article, $contenu, $auteur) {
		
		if (!isset($titre) || !isset($date_article)|| !isset($contenu) || !isset($auteur)) {
			return 0;
		}
	
		//Connexion
		$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'] , $GLOBALS['password'], $GLOBALS['dbname']);
		if (!$link) {
			die('autorisation : Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
		}
		
		if (mysqli_query($link, "INSERT INTO t_article(titre, date_article, contenu, fk_login) VALUES ('$titre', '$date_article', '$contenu', '$auteur')")) {

			//Recherche le dernier id crée (l'article qui vient d'être crée)
			$result = mysqli_query($link, "SELECT  max(id_article) as last_id from t_article");
			
			$row = mysqli_fetch_array($result, MYSQL_ASSOC);
			
			mysqli_close($link);
			
			return $row['last_id'];
			
		}
		
		return 0;
		
	}
	
	//Permet de mettre à jour un article en BD
	//Paramètres
	//	id - Identifiant de l'article
	//	titre - Titre de l'article
	//	contenu
	//Retourne 1 si l'article à pu être mis à jour,
	//         0 si les paramètres ne sont pas correctement rempli
	//		   Message d'erreur si la connexion n'a pas pu etre établie
	function modifier_article($id, $titre, $contenu) {
		
		if (!isset($id) || !isset($titre) || !isset($contenu)) {
			return false;
		}
        
		//Connexion
		$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'] , $GLOBALS['password'], $GLOBALS['dbname']);
		if (!$link) {
			die('autorisation : Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
		}
		
		if (mysqli_query($link, "UPDATE t_article SET titre = $titre, contenu = $contenu WHERE id_article = $id")) {
			
			mysqli_close($link);
			return 1;
			
		}
		
		return 0;
		
	}

	//Permet de mettre à jour un article en BD
	//Paramètres
	//	id - Identifiant de l'article
	//Retourne 1 si l'article à pu être mis à jour,
	//         0 si l'id n'existe pas
	//		   Message d'erreur si la connexion n'a pas pu etre établie
	function supprimer_article($id) {
		
		if (!isset($id)) {
			return false;
		}		
	
		//Connexion
		$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'] , $GLOBALS['password'], $GLOBALS['dbname']);
		if (!$link) {
			die('autorisation : Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
		}
		
		if (mysqli_query($link, "DELETE FROM t_article WHERE id_article = $id")) {
			
			mysqli_close($link);
			return 1;
		}
		
		return  0;
		
	}
	
	//Obtient les noms des dossiers contenant les photos
	function recup_albums($offset=0, $nb_albums=20) {
		return scandir($chem_album, SCANDIR_SORT_ASCENDING);
	}
	
	//Obtiens les noms de tous les fichiers (sous forme de tableau)
	function recup_photos($nom_album, $offset=0, $nb_photos=5) {
		return scandir($chem_album + $nom_album, SCANDIR_SORT_ASCENDING);	
	}

?>

