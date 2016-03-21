/** Auteur : Guilhem SERENE **/

/** AJOUT **/
/* Ajoute le formulaire de creation de l'article */
function ajouter_article_page_formulaire_on() {
		
	document.getElementById("nouvel_article").innerHTML = "<div id='nouvel_article' class='nouvel_article'><br/><br/>"
	+	"Titre : <input id='nouvel_article_titre' type='text' size='20' value=''><br/>" 
	+	"<br/> 	"
	+	"Contenu (Element HTML autorisés ): <br/>"
	+	"<textarea type='text' id='nouvel_article_contenu' value='' cols=80 rows=10 ></textarea> <br/>"
	+	"<input type='button' value='Soumettre' onclick='ajouter_article_page_formulaire_soummettre();'/>"
    +   "<input type='button' value='Annuler' onclick='ajouter_article_bouton_initial();'/> <br/>"
	+	"Ce formulaire peut faire office de faille XSS (permettant de changer le code)<br/>"
    +   "Vous pouvez tentez de faire des scripts XSS à partir du formulaire ou meme des injections SQL"
	+   "</div>";
	
}

/* Marque la fin de l'ajout (destruction du formulaire)
 * Ajoute l'article en base et sur la page
 */
function ajouter_article_page_formulaire_soummettre() {
		
    if ((encodeURIComponent(document.getElementById("nouvel_article_titre").value.trim()) == '')
     || (encodeURIComponent(document.getElementById("nouvel_article_contenu").value.trim()) == '')) {
        
        alert("Veuillez saisir un titre et un contenu");
    } else {
        ajouter_article_ajax();	
        ajouter_article_bouton_initial();
    }
	
		
}

/* Remet le bouton initial "Ajouter article" et enlève les champs de saisie */
function ajouter_article_bouton_initial() {
    document.getElementById("nouvel_article").innerHTML = "<input id='ajouter_article' type='button' value='Ajouter un article' onClick='ajouter_article_page_formulaire_on();'/><br/><br/>";
	
}

/* Permet d'ajouter l'article à la liste des articles deja existant*/
function ajouter_article_ajout_article_liste(html) {
	document.getElementById("articles_nouveaux").innerHTML = html + document.getElementById("articles_nouveaux").innerHTML;
}

/* Envoie au script php la requete AJAX 
 * Retourne l'id de l'article en base de donnée 
 */
function ajouter_article_ajax() {
	
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {			
            if (xmlhttp.responseText == 0) {
                alert("Erreur de l'ajout de l'article");
            } else {
                ajouter_article_ajout_article_liste(xmlhttp.responseText);	
            }
		}
	};
						
	xmlhttp.open("GET", "ajouter_article.php?titre=" + encodeURIComponent(document.getElementById("nouvel_article_titre").value) 
									    + "&contenu=" + encodeURIComponent(document.getElementById("nouvel_article_contenu").value), true);
	xmlhttp.send();
}

// /** MODIFICATION **/ Lors d'ajout de ", ' dans les articles bugs
// /* Passe les champs titre/contenu en mode saisie sur l'article en pre-saisissant les valeurs en paramètres
 // * Paramètres
 // *		id - Id de l'article
 // *		titre - Titre de l'article
 // *		Contenu - Contenu de l'article
 // */
// function modifier_article_page_on(id, titre, contenu, nom_auteur, date) {

	// document.getElementById("article_" + id).innerHTML = "<div id='modification_article_" + id + "' class='modification_article'><br/>"
	// +	"Titre : <input id='modification_titre_article_' " + id + "' type='text' size='20' value=''><br/>" 
	// +	"<br/> 	"
	// +	"Contenu (Element HTML autorisés ): <br/>"
	// +	"<textarea type='text' id='modification_article_contenu' value='' cols=80 rows=10></textarea> <br/>"
		// // Sauvegarde cachée des elements non modifiables (date et nom_auteur)
	// +	"<input type='hidden' id='date_article_'" + id + " value='" + date + "'/>" 
	// +	"<input type='hidden' id='user_article_'" + id + " value='" + nom_auteur + "'/>"
	
	// +	"<input type='button' value='Soumettre' onclick='ajouter_article_page_formulaire_soummettre(" + id + ");'/>"
    // +   "<input type='button' value='Annuler' onclick='modifier_article_page_off(" + id + ", " + titre + ", " + contenu + ", " + nom_auteur + ", " + date + ");'/> <br/>"
	// +	"Ce formulaire peut faire office de faille XSS (permettant de changer le code)"
	// +   "</div>";
	

// }

// /*
 // * Marque la fin de l'ajout (destruction du formulaire)
 // * Ajoute l'article en base et sur la page
 // */
// function ajouter_article_page_formulaire_soummettre(id) {

    // if ((encodeURIComponent(document.getElementById("modification_titre_article_" + id).value.trim()) == '')
     // || (encodeURIComponent(document.getElementById("modification_article_contenu_" + id).value.trim()) == '')) {
        
        // alert("Veuillez saisir un titre et un contenu");
    // } else {
        // modifier_article_ajax();	
        // modifier_article_ajout_article_liste(id, 
								// encodeURIComponent(document.getElementById("modification_titre_article_" + id).value), 
								// encodeURIComponent(document.getElementById("modification_article_contenu_" + id).value),
								// encodeURIComponent(document.getElementById("date_article_" + id).value),
								// encodeURIComponent(document.getElementById("user_article_" + id).value));
    // }
// }


// /* Enlève les champs de saisie de l'article et passe l'article dans la liste des articles
 // * Paramètres
 // *		id - Id de l'article 
 // *		titre - Titre de l'article
 // *		Contenu - Contenu de l'article
 // */
// function modifier_article_ajout_article_liste(id, titre, contenu, nom_auteur, date) {
	
	// document.getElementById("article_" + id).innerHTML = "<input id='modifier_ " + id + "' type='button' value='Modifier' onClick='modifier_article_page_on( " + id + ", " + titre + ", " + contenu + ", " + nom_auteur + ", " + date + ");'/>"; 
			 // +"<input id='supprimer_ " + id + "' type='button' value='Supprimer' onClick='supprimer_article( " + id + ");'/>"
		
        
        // +"<p class='contenu_article' id='contenu_article_" + id + "'>$contenu</p>"
        
        // +"<p class='date_user_article' id='date_user_article_ " + id + "'>Cr&eacutee le <span class='date_article' id='date_article_ " + id + "'> " + date + "</span>"
        
        
        // + " par <span class='user_article' id='user_article_" + id + "'>" + nom_auteur + "</span><br/>"
        
        // +"</p>";
		
	
// }


// /* Permet de modifier l'article en base portant le même id
 // * Demande confirmation avant la suppression
 // * Paramètres
 // *		id - Id de l'article 
 // *		titre - Titre de l'article
 // *		Contenu - Contenu de l'article
 // */
// function modifier_article_ajax(id, titre, contenu) {
	
	
	// var xmlhttp = new XMLHttpRequest();
	// xmlhttp.onreadystatechange = function() {

		// if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {			
            // if (xmlhttp.responseText == 0) {
                // alert("Erreur de la modification de l'article");
            // } else {
                // modifier_article_ajout_article_liste(id, titre, contenu, nom_auteur, date);	
            // }
		// }
	// };
						
	// xmlhttp.open("GET", "modifier_article.php?id" + id
						// + "&titre=" + encodeURIComponent(titre) 
						// + "&contenu=" + encodeURIComponent(contenu), true);
	// xmlhttp.send();
	
// }



/** SUPPRESSION **/
/* Permet de supprimer l'article portant l'id (le supprime en base et sur la page)
 * Demande confirmation avant la suppression
 * Paramètres
 *		id - Id de l'article 
 */
function supprimer_article(id) {
	if (confirm("Voulez-vous supprimer l'article '" + document.getElementById('titre_article_' + id).innerHTML + "'")) {
		supprimer_article_ajax(id);
	}
}

/* Supprime l'article sur la base
 * Paramètres
 *		id - Id de l'article 
 */
function supprimer_article_ajax(id) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if (xmlhttp.responseText == 0) {
                alert("Erreur de la suppression de l''article");
            } else {
                supprimer_article_page(id);
            }
			
		}
	};
						
	xmlhttp.open("GET", "supprimer_article.php?id=" + id, true);
	xmlhttp.send();
}

/* Supprime l'article sur la page
 * Paramètres
 *		id - Id de l'article 
 */
function supprimer_article_page(id) {
	document.getElementById('article_' + id).remove();
}

/* Permet de savoir si un objet est defini */
function isset(obj){
    return (typeof obj !=='undefined');
}

