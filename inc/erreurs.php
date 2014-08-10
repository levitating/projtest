<?php 

// vous trouvez ici toute les fonctions utilisées par les erreurs

class myClassErreur {


function afficherErreurs () 
{
	if (isset($_SESSION["MESSAGES_CAT_SUCCES"])) 
	 {
		echo '<p class="bg-success">'.$_SESSION["MESSAGES_CAT_SUCCES"].'</p>';
		
		unset ($_SESSION["MESSAGES_CAT_SUCCES"]);
		
	 } 
	 elseif (isset($_SESSION["MESSAGES_CAT_ERREUR"])) 
	 {
		echo '<p class="bg-danger">'.$_SESSION["MESSAGES_CAT_ERREUR"].'</p>';
		unset ($_SESSION["MESSAGES_CAT_ERREUR"]);

	 } 
	 else 
	 {
	 
		unset ($_SESSION["MESSAGES_CAT_SUCCES"]); 
		unset ($_SESSION["MESSAGES_CAT_ERREUR"]); 
		
	 } 
}

/*
	fonction afficher erreur
	myErreur : texte a afficher
	etatErreur : 0 ou 1, la couleur d'affichage du textm, 0 rouge, 1 vert
*/
function initialiserErreur ($myErreur , $etatErreur) 
{
if ($etatErreur == 1) 
	 {
		echo '<p class="bg-success">'.$myErreur.'</p>';
	 } 
	 else
	 {
		echo '<p class="bg-danger">'.$myErreur.'</p>';
	 }
}


}
 ?>