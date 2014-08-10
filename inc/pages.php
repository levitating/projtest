<?php 

//   vous trouvez ici toute les fonctions utilisées par les pages


//-----------------------------------------------------
//-----------------------------------------------------
//   Partie administration 
//-----------------------------------------------------
//-----------------------------------------------------
class myClassPage {

// creation d'une page dans la base des données
function ajouterPage ( $titrePage, $contenuPage, $languePage, $statusPage, $parentPage ) 
{

$objectErreur = new myClassErreur();

$titrePage = mysql_real_escape_string ($titrePage);
$contenuPage = mysql_real_escape_string ($contenuPage);
$languePage = mysql_real_escape_string ($languePage);
$statusPage = mysql_real_escape_string ($statusPage);
$parentPage = mysql_real_escape_string ($parentPage);
if ( empty($titrePage) or empty($contenuPage) or ($languePage == "choix") ) 
$objectErreur->initialiserErreur("Il faut remplir tout les champs." , 0);

else 
		{
			$requete = mysql_query("INSERT INTO page (titre_page,contenu_page, langue_page,status_page,parent_page) VALUES ('$titrePage','$contenuPage', '$languePage','$statusPage','$parentPage')") or die(mysql_error());
			$idPageMenu=mysql_insert_id();
			$requeteMenu = mysql_query("INSERT INTO menu (titre_menu,id_page_menu, parent_menu, status_menu) VALUES ('$titrePage','$idPageMenu', '$parentPage', '$statusPage')") or die(mysql_error());

			if ($requete && $requeteMenu )
			{
				$_SESSION["MESSAGES_CAT_SUCCES"] = "Votre page a été enregistré avec succès, vous pouvez la modifier ici";
				header('location: ModifierPages.php?mapage='.$idPageMenu.'#page');
				exit;
			} else 
			{
				$objectErreur->initialiserErreur("Erreur d'enregistrement a la base de données" , 0);
			}
		}
}



// modification d'une page dans la base des données
function modifierPage ( $idPage, $titrePage, $contenuPage, $languePage, $statusPage, $parentPage) 
{
	$objectErreur = new myClassErreur();
	$titrePage = mysql_real_escape_string ($titrePage);
	$contenuPage = mysql_real_escape_string ($contenuPage);
	$languePage = mysql_real_escape_string ($languePage);
	$statusPage = mysql_real_escape_string ($statusPage);
	$parentPage = mysql_real_escape_string ($parentPage);
	
	if ( empty($titrePage) or empty($contenuPage) or ($languePage == "choix") ) $objectErreur->initialiserErreur("Il faut remplir tout les champs", 0);
	else 
			{
				$requete = mysql_query("UPDATE page SET titre_page='$titrePage' ,contenu_page='$contenuPage', langue_page='$languePage', status_page='$statusPage', parent_page='$parentPage' WHERE id_page='$idPage'") or die(mysql_error());
				$requeteMenu = mysql_query("UPDATE  menu SET titre_menu='$titrePage', parent_menu='$parentPage', status_menu='$statusPage' WHERE id_page_menu=' $idPage'") or die(mysql_error());

				if ($requete && $requeteMenu)
				{
					$objectErreur->initialiserErreur("Votre page a été enregistré avec succès" , 1);
				} else 
				{
					$objectErreur->initialiserErreur("Erreur d'enregistrement a la base de données" , 0);
				}
			}
}


// modification la status d'une page dans la base des données
function modifierStatusPage ( $idPage, $statusPage) 
{

}



// suppression d'une page dans la base des données
function corbeillePage ( $idPage ) 
{
	$objectErreur = new myClassErreur();
	$requeteChangeSousPage = mysql_query("SELECT * FROM page WHERE parent_page='$idPage'") or die(mysql_error());
	if ( mysql_num_rows($requeteChangeSousPage) != 0 ) 
	{			
		header("location: ChangeParent.php?mapage=".$idPage);
		exit;
	}
	else
	{
		myClassPage::supprimerPage ( $idPage );
	}

}


function supprimerPage ( $idPage ) 
{
	$objectErreur = new myClassErreur();
	$requetePage = mysql_query("UPDATE page SET status_page='-1' WHERE id_page='$idPage'") or die(mysql_error());
	$requeteMenu = mysql_query("UPDATE menu SET status_menu='-1' WHERE id_page_menu='$idPage'") or die(mysql_error());
				if ($requetePage && $requeteMenu)
				{
					
					$objectErreur->initialiserErreur("Votre page a été supprimé avec succès", 1);
				} else 
				{
					$objectErreur->initialiserErreur("Erreur de suppression de la base de données", 0);
				}
}


function supprimerPageDifinitivement ($idPage) 
{
	/*$requeteChangeSousPage = mysql_query("SELECT * FROM page WHERE parent_page='$idPage'") or die(mysql_error());
	if (mysql_num_rows($requeteChangeSousPage) != 0) 
	{
		while ($resultatChange = mysql_fetch_array($requeteChangeSousPage))
		{
			$idPageChange = $resultatChange["id_page"];
			$requeteChangePage = mysql_query("UPDATE page SET parent_page = '-1' WHERE id_page ='$idPageChange'") or die(mysql_error());
			$requeteChangeMenu = mysql_query("UPDATE menu SET parent_menu = '-1' WHERE id_page_menu ='$idPageChange'") or die(mysql_error());
		}
	}*/
	$objectErreur = new myClassErreur();
	$requetePage = mysql_query("DELETE FROM page WHERE id_page='$idPage'") or die(mysql_error());
	$requeteMenu = mysql_query("DELETE FROM menu WHERE id_page_menu='$idPage'") or die(mysql_error());
				if ($requetePage && $requeteMenu)
				{
					
					$objectErreur->initialiserErreur("Votre page a été supprimé avec succès", 1);
				} else 
				{
					$objectErreur->initialiserErreur("Erreur de suppression de la base de données", 0);
				}
}



function modifierParentPage($idPage, $idParent)
{
		$objectErreur = new myClassErreur();
		$requeteChangeSousPage = mysql_query("SELECT * FROM page WHERE parent_page='$idPage'") or die(mysql_error());
		if ( mysql_num_rows($requeteChangeSousPage) == 0 ) 
		{	
			$objectErreur->initialiserErreur("Cette page n'a pas des sous pages", 0);
		}
		else
		{
			$requeteChangeParent = mysql_query("UPDATE page SET parent_page = '$idParent' WHERE parent_page ='$idPage'") or die(mysql_error());
			$requeteChangeMenu = mysql_query("UPDATE menu SET parent_menu = '$idParent' WHERE parent_menu ='$idPage'") or die(mysql_error());
			if ($requeteChangeParent && $requeteChangeMenu )
			{
				myClassPage::supprimerPage ($idPage);	
				header("location: AfficherPages.php");
				exit;
			} else 
			{
				
				$objectErreur->initialiserErreur("Erreur de suppression de la base de données", 0);
			}
		}
}


//-----------------------------------------------------
//-----------------------------------------------------
//   Partie publique 
//-----------------------------------------------------
//-----------------------------------------------------


// Afficher afficher le contenu d'une Pageialité
function getPage ( $idPage ) 
{

}
}
 ?>