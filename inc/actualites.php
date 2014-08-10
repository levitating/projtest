<?php 

//   vous trouvez ici toute les fonctions utilisées par les actualtés


//-----------------------------------------------------
//-----------------------------------------------------
//   Partie administration 
//-----------------------------------------------------
//-----------------------------------------------------

class myClassActualite {
// creation d'une actualite dans la base des données
function ajouterActualite ( $titreActualite, $contenuActualite, $langueActualite, $categorieActualite, $statusActualite ) 
{
	$objectErreur = new myClassErreur();
	
	$titreActualite = mysql_real_escape_string ($titreActualite);
	$contenuActualite = mysql_real_escape_string ($contenuActualite);
	$langueActualite = mysql_real_escape_string ($langueActualite);
	$categorieActualite = mysql_real_escape_string ($categorieActualite);
	$statusActualite = mysql_real_escape_string ($statusActualite);
	$idAuteur = $_SESSION["ID_USER"];
 
if (empty($titreActualite) or empty($contenuActualite) or ($langueActualite == "choix")  or ($categorieActualite == "choix")) 
{

$objectErreur->initialiserErreur("Il faut remplir tout les champs." , 0);
}

	
else 
		{
		
		
			$verifierCategorie = mysql_query("SELECT * FROM categorie WHERE id_cat='$categorieActualite'") or die(mysql_error());
			if (mysql_num_rows($verifierCategorie) == 0)  $categorieActualite = 0;
			
			if($statusActualite == "2") $validation=1;
			else $validation=0;
			
			$requete = mysql_query("INSERT INTO actualite (titre_actualite, auteur_id_actualite, contenu_actualite, langue_actualite, categorie_actualite, status_actualite,validation) VALUES ('$titreActualite', '$idAuteur', '$contenuActualite', '$langueActualite', '$categorieActualite', '$statusActualite','$validation')") or die(mysql_error());
			$id_page=mysql_insert_id();
			if ($requete)
			{
				$_SESSION["MESSAGES_CAT_SUCCES"] = "Votre actualité a été enregistré avec succès";
				if($statusActualite == "2") 
				{
				header('location: ModifierMyPosts.php?monpost='.$id_page.'&ok=1#actualite');
				exit;
				}
				else header('location: ModifierPosts.php?monpost='.$id_page.'&ok=1#actualite');
				
				
			}
			else 
			{
				$objectErreur->initialiserErreur("Erreur durant l'enregistrement" , 0);
			}
		}

}

function updateStatusActualite ( 
	$idActu,
	$titreActualite, 
	$contenuActualite, 
	$langueActualite, 
	$categorieActualite, 
	$statusActualite ) 
{
$objectErreur = new myClassErreur();
$titreActualite = 	mysql_real_escape_string($titreActualite);
$contenuActualite = mysql_real_escape_string($contenuActualite);
$langueActualite = mysql_real_escape_string($langueActualite);
$categorieActualite = mysql_real_escape_string($categorieActualite);
$statusActualite = mysql_real_escape_string($statusActualite);



if ( empty($titreActualite) or empty($contenuActualite) or ($langueActualite == "choix")  or ($categorieActualite == "choix") )

{
$objectErreur->initialiserErreur("Il faut remplir tout les champs." , 0);
}

else 
{
	$verifierCategorie = mysql_query("SELECT * FROM categorie WHERE id_cat='$categorieActualite'") or die(mysql_error());
	if (mysql_num_rows($verifierCategorie) == 0)  $categorieActualite = 0;
	$requete = mysql_query("UPDATE actualite SET titre_actualite='$titreActualite', contenu_actualite='$contenuActualite', langue_actualite='$langueActualite', categorie_actualite='$categorieActualite', status_actualite='$statusActualite' WHERE id_actualite='$idActu'") or die(mysql_error());
	if ($requete)
	{
		header('location: AfficherPosts.php?monpost='.$id_page.'&ok=1#actualite');
		exit;
					
	} 
	else 
	{
		$objectErreur->initialiserErreur("Erreur durant l'enregistrement" , 0);
	}
}
}

// modification d'une actualite dans la base des données
function modifierActualite ( 
	$idActu,
	$titreActualite, 
	$contenuActualite, 
	$langueActualite, 
	$categorieActualite, 
	$statusActualite ) 
{
$objectErreur = new myClassErreur();
$titreActualite = 	mysql_real_escape_string($titreActualite);
$contenuActualite = mysql_real_escape_string($contenuActualite);
$langueActualite = mysql_real_escape_string($langueActualite);
$categorieActualite = mysql_real_escape_string($categorieActualite);
$statusActualite = mysql_real_escape_string($statusActualite);

if ( empty($titreActualite) or empty($contenuActualite) or ($langueActualite == "choix")  or ($categorieActualite == "choix") )

{
$objectErreur->initialiserErreur("Il faut remplir tout les champs." , 0);
}

else 
{
	$verifierCategorie = mysql_query("SELECT * FROM categorie WHERE id_cat='$categorieActualite'") or die(mysql_error());
	if (mysql_num_rows($verifierCategorie) == 0)  $categorieActualite = 0;
	$requete = mysql_query("UPDATE actualite SET titre_actualite='$titreActualite', contenu_actualite='$contenuActualite', langue_actualite='$langueActualite', categorie_actualite='$categorieActualite', status_actualite='$statusActualite' WHERE id_actualite='$idActu'") or die(mysql_error());
	if ($requete)
	{
		$objectErreur->initialiserErreur("Votre actualité a été enregistré avec succès" , 1);
					
	} 
	else 
	{
		$objectErreur->initialiserErreur("Erreur durant l'enregistrement" , 0);
	}
}
}


function corbeilleActualite ( $idActu ) 
{
		$objectErreur = new myClassErreur();
		$requete = mysql_query("UPDATE actualite SET status_actualite='-1' WHERE id_actualite='$idActu'") or die(mysql_error());
		if ($requete)
		{
			
			$objectErreur->initialiserErreur("Votre catégorie a été supprimé avec succès" , 1);
		} 
		else 
		{
			$objectErreur->initialiserErreur("Erreur durant l'enregistrement" , 0);
		}
}

//suppression d'une actualite dans la base des données
function supprimerActualite ( $idActu ) 
{
$objectErreur = new myClassErreur();
$requete = mysql_query("DELETE FROM actualite WHERE id_actualite='$idActu'") or die(mysql_error());
		if ($requete)
		{
			$objectErreur->initialiserErreur("Votre catégorie a été supprimé avec succès" , 1);
		} 
		else 
		{
			$objectErreur->initialiserErreur("Erreur durant l'enregistrement" , 0);
		}
}


//-----------------------------------------------------
//-----------------------------------------------------
//   Partie publique 
//-----------------------------------------------------
//-----------------------------------------------------

// Afficher les actualitée dans la page blog.php de template avec pagination
function getActualitePagination () 
{

}



// Afficher afficher le contenu d'une actuialité
function getActualite ( $idActu ) 
{

}
}
 ?>