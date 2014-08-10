<?php 



class myClassRole 
{
	
	function roleAccess () 
	{
		global $supplementRequeteActualite;
		global $supplementRequetePage;
		
		$myActionAccess = mysql_real_escape_string(ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)));
		
		
		$myRoleAccess = $_SESSION["ROLE_USER"];
		
		$getRole = mysql_query("SELECT * FROM role WHERE type_admin_role = '$myRoleAccess' AND (action_role = '$myActionAccess' OR action_role = 'ALL')") or die(mysql_error());
		
		
		
		$verifierRole = mysql_num_rows($getRole);
		if ($verifierRole == 0)
		{
			$objectErreur = new myClassErreur();
			$objectErreur->initialiserErreur("Vous n'avez pas le droit d'accéder a cette action." , 0);
			exit;
		}

	}
	
	function myPostsDisplay ()
	{
		
		$myRoleAccess = $_SESSION["ROLE_USER"];
		
		$testerPourAfficherToutLesActualits=mysql_query("SELECT * FROM role WHERE type_admin_role = '$myRoleAccess' AND (action_role = 'AfficherMyPosts')")or die(mysql_error());
		
		if (mysql_num_rows($testerPourAfficherToutLesActualits) != 0)
		return " AND auteur_id_actualite=".$_SESSION["ID_USER"];
		return "";
	}
	
	
	
	
	function myPagesDisplay ()
	{
		
		$myRoleAccess = $_SESSION["ROLE_USER"];
		$testerPourAfficherToutLesPages=mysql_query("SELECT * FROM role WHERE type_admin_role = '$myRoleAccess' AND (action_role = 'AfficherMyPages')")or die(mysql_error());
		
		if (mysql_num_rows($testerPourAfficherToutLesPages) != 0)
		return " AND auteur_id_page = ".$_SESSION["ID_USER"];
		return "";
	}
}
 ?>