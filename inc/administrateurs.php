<?php 
Class myClassAdmin{
   
   
function ajouterAdmin($pseudoAdmin,$nomAdmin,$prenomAdmin,$emailAdmin,$passAdmin,$confirmeAdmin,$roleAdmin)
{
	$objectErreur = new myClassErreur();
	if(empty ($pseudoAdmin) or empty ($nomAdmin) or empty ($prenomAdmin) or empty ($emailAdmin) or empty ($passAdmin)or empty ($confirmeAdmin) or ($roleAdmin == "choix"))
	{
		$objectErreur->initialiserErreur("Il faut remplir tout les champs." , 0);
	}
	elseif ($passAdmin != $confirmeAdmin)
	{
		$objectErreur->initialiserErreur("Mots de passe incompatible." , 0);
	}
	else{
		$pseudoAdmin = mysql_real_escape_string($pseudoAdmin);
		$nomAdmin = mysql_real_escape_string($nomAdmin);
		$prenomAdmin = mysql_real_escape_string($prenomAdmin);
		$emailAdmin = mysql_real_escape_string($emailAdmin);
		$passAdmin= md5(mysql_real_escape_string($passAdmin));
		$roleAdmin = mysql_real_escape_string($roleAdmin);
		
		$verifierPseudo= mysql_query("SELECT * FROM admin WHERE pseudo_admin='$pseudoAdmin' or email_admin='$emailAdmin'");
		$pseudoExist= mysql_num_rows($verifierPseudo);
	
		if ($pseudoExist !=0) $objectErreur->initialiserErreur("pseudo ou mail déja existant" , 0);
		else
		{
			$insertAdmin= mysql_query("INSERT INTO admin (pseudo_admin,nom_admin,prenom_admin,email_admin,password_admin,type_admin) VALUE ('$pseudoAdmin','$nomAdmin','$prenomAdmin','$emailAdmin','$passAdmin','$roleAdmin')") or die(mysql_query());
			if($insertAdmin) $objectErreur->initialiserErreur("Enregistrement avec succée." , 1);
			else $objectErreur->initialiserErreur("Erreur durant l'enregistrememt." , 0);
		}
	

	}

}
function supprimerAdmin($idAdmin)
{
	$objectErreur = new myClassErreur();
	$requetteSuppAdmin=mysql_query("DELETE FROM admin WHERE id_admin = '$idAdmin'") or die (mysql_query());
	if ($requetteSuppAdmin) 
					{
					$objectErreur->initialiserErreur("Suppréssion avec sucée." , 1);
					header("location: AfficherAdmins.php#admin");
					exit;
					}
	else $objectErreur->initialiserErreur("Suppréssion interrompu." , 0);
}


function modifierProfil($idAdmin, $pseudoAdmin,$nomAdmin,$prenomAdmin,$emailAdmin)
{
	$objectErreur = new myClassErreur();
	if (empty($pseudoAdmin) or empty($nomAdmin) or empty($prenomAdmin) or empty($emailAdmin))
	{
		$objectErreur->initialiserErreur("Il faut remplir tout les champs." , 0);
	}
	else
	{
		$pseudoAdmin = mysql_real_escape_string($pseudoAdmin);
		$nomAdmin = mysql_real_escape_string($nomAdmin);
		$prenomAdmin = mysql_real_escape_string($prenomAdmin);
		$emailAdmin = mysql_real_escape_string($emailAdmin);
		
		
			$verifierPseudo= mysql_query("SELECT * FROM admin WHERE (id_admin <> '$idAdmin') AND (pseudo_admin='$pseudoAdmin' or email_admin='$emailAdmin') ");
			$pseudoExist= mysql_num_rows($verifierPseudo);
		
			if ($pseudoExist !=0) $objectErreur->initialiserErreur("pseudo ou mail déja existant" , 0);
		
		else
		{
				$updateAdmin= mysql_query ("UPDATE admin SET pseudo_admin = '$pseudoAdmin', nom_admin='$nomAdmin', prenom_admin='$prenomAdmin', email_admin='$emailAdmin' WHERE id_admin='$idAdmin' ") or die(mysql_query());
				if($updateAdmin) 
				{
					$objectErreur->initialiserErreur("Modification avec succèe." , 1);
					
					$_SESSION["PSEUDO_USER"] = $pseudoAdmin;
					$_SESSION["EMAIL_USER"] = $emailAdmin;
					$_SESSION["NOM_USER"] = $nomAdmin;
					$_SESSION["PRENOM_USER"] = $prenomAdmin;
					
				}
				
				else $objectErreur->initialiserErreur("Erreur durant l'enregistrememt." , 0);
		}
		
	

	}

}

function modifierPass($idAdmin,$actualPass,$nouveauPass,$confirmPass)
{
		$objectErreur = new myClassErreur();
		if (empty($actualPass) or empty($nouveauPass) or empty($confirmPass)) 
		$objectErreur->initialiserErreur("Veuillez remplir tout les champs." , 0);
		elseIf (md5($actualPass) != $_SESSION["PASS_USER"])
		{
		$objectErreur->initialiserErreur("Votre mot de passe actuel est incorrect." , 0);
		}
		elseif ($nouveauPass != $confirmPass)
		{
		
		$objectErreur->initialiserErreur("Les deux mots de passe ne sont pas identiques." , 0);
		}
		else
		{
			$nouveauPass = md5(mysql_real_escape_string($nouveauPass));
			
			$modifierPass=mysql_query("UPDATE admin SET password_admin='$nouveauPass' WHERE id_admin='$idAdmin' ")or die(mysql_query());
			if($modifierPass) 
					{
						$objectErreur->initialiserErreur("Modification avec succèe." , 1);
						
						$_SESSION["PASS_USER"] = $nouveauPass;
						
						
					}
					
					else $objectErreur->initialiserErreur("Erreur durant l'enregistrememt." , 0);
		}
}
}
?>