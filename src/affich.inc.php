<meta name="author" content="Guilhem SERENE">

<?php

	/* NB : Avant d'utiliser ces scripts veuillez bien à inclure le fichier scripts.js 
	        Sur votre page appelant les scripts ci-dessous
	*/
			
	
    include("bd.inc.php");
	
	//Chemin relatif du repertoire de l'album 
	$chem_albums = 'Albums/';

    /*
     * Affiche les derniers articles avec un décalage
     * Paramètres 
     *        nb_articles  - Nombre d'articles à retourner
     *        offset       - Decalage d'article
     *                       Si = 0 alors retourne les derniers articles   
	 *		  admin		   - rajoute l'option d'ajout d'article
     */
    function afficher_derniers_articles($nb_articles, $offset, $admin=false) {
        
        //Verification des paramètres d'entrées
        if ($nb_articles <= 0) {
            $nb_articles = 10;
        }
        
        if ($offset < 0) {
            $offset = 0;
        }
		
		/* Endroit invisible à l'oeil nu qui sera remplacé par le formulaire de creation du nouvel article */
        echo "<div class='nouvel_article' id='nouvel_article'>";
		
		if ($admin) {
			echo "<input id='ajouter_article' type='button' value='Ajouter un article' onClick='ajouter_article_page_formulaire_on();'/>";
			echo "<br/>";
			echo "<br/>";
		}
		
		echo "</div>";
        

		$data = recuperer_derniers_articles($nb_articles, $offset);
        
        echo "<div id='liste_article' id='liste_article'>";
            /* Endroit Invisible sur lequel les articles crées apparaitront*/
            echo "<div class='articles_nouveaux' id='articles_nouveaux'>";
            
            echo "</div>";
        while($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
            afficher_article($row["id_article"], $row["titre"],$row["date_article"],$row["contenu"],$row["fk_login"], $admin);
        }
        
        echo "</div>";
        
    }
    
    /* Affiche un article avec la mise en forme
     * Paramètres 
	 *        id - id de l'article
     *        titre - titre de l'article
     *        date_article - date de l'article
     *        contenu - contenu de l'article
	 *        nom_auteur - nom de l'auteur de l'article (si null n'est pas affiché)
	 *		  admin - options de modification/suppression
     */
    function afficher_article($id, $titre, $date_article, $contenu, $nom_auteur, $admin=false) {
    
		
        if (!isset($titre) || !isset($date_article) || !isset($contenu)) {
            die('Probleme afficher_article');
        }
		 
        echo "<article class='article' id='article_$id'>";
        
        echo "<h2 class='titre_article' id='titre_article_$id'>$titre</h2> ";
		
		if ($admin) {
			 //echo "<input class='bouton_modifier' id='modifier_$id' type='button' value='Modifier' onClick=\"modifier_article_page_on($id, '$titre', '$date_article', '$contenu', '$nom_auteur'); \"/>"; 
			 echo "<input class='bouton_supprimer' id='supprimer_$id' type='button' value='Supprimer' onClick='supprimer_article($id);'/>";
		}
        
        echo "<p class='contenu_article' id='contenu_article_$id'>$contenu</p>";
        
        echo "<p class='date_user_article' id='date_user_article_$id'>Cr&eacutee le <span class='date_article' id='date_article_$id'>$date_article</span>";
        
        //Affiche le nom de l'auteur s'il est defini != null
        if (isset($nom_auteur)) {
            echo " par <span class='user_article' id='user_article_$id'> $nom_auteur </span><br/>";
        }
        
        echo "</p>";
		
        
        echo "<br/>";
		
        echo "</article>";
		
		
        
		
        
    }    
	


    
?>