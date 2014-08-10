<?php 

// vous trouvez ici toute les fonctions utilisées par les catégories
class myClassCategorie {
// creation d'une catégorie dans la base des données
function ajouterCategorie ($titreCategorie, $langueCategorie) 
{
if ( empty($titreCategorie) or ($langueCategorie == "choix") ) $_SESSION["MESSAGES_CAT_ERREUR"] = "Il faut remplir tout les champs";
else 
		{
			
			
			$requete = mysql_query("INSERT INTO categorie (nom_cat, langue_cat) VALUES ('$titreCategorie', '$langueCategorie')") or die(mysql_error());
			if ($requete)
			{
				$_SESSION["MESSAGES_CAT_SUCCES"] = "Votre catégorie a été enregistré avec succès";
			} else 
			{
				$_SESSION["MESSAGES_CAT_ERREUR"] = "Erreur d'enregistrement a la base de données";
			}
		}
}

// modification d'une catégorie dans la base des données
function modifierCategorie ($idCat, $titreCategorie, $langueCategorie) 
{
if ( empty($titreCategorie) or ($langueCategorie == "choix") ) $_SESSION["MESSAGES_CAT_ERREUR"] = "Il faut remplir tout les champs pour modifier";
else 
		{
			$requete = mysql_query("UPDATE categorie SET nom_cat='$titreCategorie', langue_cat='$langueCategorie' WHERE id_cat='$idCat'") or die(mysql_error());
			if ($requete)
			{
				$_SESSION["MESSAGES_CAT_SUCCES"] = "Votre catégorie a été modifié avec succès";
			} else 
			{
				$_SESSION["MESSAGES_CAT_ERREUR"] = "Erreur d'enregistrement a la base de données";
			}
		}
}

// suppression d'une catégorie dans la base des données
function supprimerCategorie ($idCat, $nouvelleCategorie) 
{
			
			$changeCategorieActalite = mysql_query("UPDATE actualite SET categorie_actualite='$nouvelleCategorie' where categorie_actualite='$idCat' ") or die(mysql_error());
			$requete = mysql_query("DELETE FROM categorie WHERE id_cat='$idCat'") or die(mysql_error());
			if ($requete && changeCategorieActalite)
			{
				$_SESSION["MESSAGES_CAT_SUCCES"] = "Votre catégorie a été supprimé avec succès";
			} else 
			{
				$_SESSION["MESSAGES_CAT_ERREUR"] = "Erreur de suppression de la base de données";
			}
}


function getCategorie() 
{
	$requete = mysql_query("SELECT * FROM categorie ORDER BY id_cat ASC") or die(mysql_error());
	while ($resultCat= mysql_fetch_array($requete)) 
	{
	$ID_cat = $resultCat['id_cat'];
	$nom_cat = $resultCat['nom_cat'];
	$langue_cat = $resultCat['langue_cat'];
	if (((isset($_GET["categorie_actualite"])) && ($_GET["categorie_actualite"] == "0")) or (isset($mes_valeurs["categorie_actualite"]) && ($mes_valeurs["categorie_actualite"] == "0" ))) $selected = "selected"; else $selected ="";
	echo "<option ".$selected." value=".$ID_cat." > ".$nom_cat." (".$langue_cat.")</option>";
	}

}
}
 ?>