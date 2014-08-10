<?php 

include('load.php');
include('../inc/actualites.php');
include('../inc/categories.php');

if ((!isset($_POST["monpost"])) && (!isset($_GET["monpost"])))
{
	$_SESSION["MESSAGES_CAT_ERREUR"] = "Erreur de trouver l'identifiant";
	header("location: AfficherPosts.php#actualite");
} 
else 
{
	if (isset($_POST["monpost"])) $myIdAModifier = $_POST["monpost"];
	if (isset($_GET["monpost"])) $myIdAModifier = $_GET["monpost"];
	$requeteID = mysql_query("SELECT * FROM actualite WHERE id_actualite = '$myIdAModifier' ") or die(mysql_error()); 
	$numValeurs = mysql_num_rows ($requeteID);
	if ($numValeurs == 0)  
	{
		$_SESSION["MESSAGES_CAT_ERREUR"] = "Cet article est introuvable";
		header("location: AfficherPosts.php#actualite"); 
	} 
	else 
	{
		$mesValeurs = mysql_fetch_assoc($requeteID);
		if (isset($_POST["titreActualite"]) or isset($_POST["contenuActualite"])  or isset($_POST["langueActualite"]) or isset($_POST["categorieActualite"])) 
		{
			$objectActualite = new myClassActualite();
			$objectActualite->modifierActualite ($myIdAModifier,$_POST["titreActualite"],$_POST["contenuActualite"],$_POST["langueActualite"],$_POST["categorieActualite"]  , $_POST["statusActualite"]);
		}
		$objectErreur = new myClassErreur();
		$objectErreur->afficherErreurs();
 
?>	
        <div class="text-left" href="#actualite">
			<h3>Actualités<small> Ajouter une actualité</small></h3>
			<br>
			<form action="ModifierPosts.php?monpost=<?php echo $myIdAModifier; ?>#actualite" method="POST" >
		
		
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">Titre</div>
						<input class="form-control" type="text" name="titreActualite" value="<?php  if (isset($_POST["titreActualite"])) echo $_POST["titreActualite"]; else echo $mesValeurs["titre_actualite"]; ?>" placeholder="Saisir le titre de l'actualité" >
					</div>
				</div>
	
				<textarea  id="texteditor" name="contenuActualite" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre actualité ici"><?php  if (isset($_POST["contenuActualite"])) echo $_POST["contenuActualite"];  else echo $mesValeurs["contenu_actualite"];  ?></textarea>
			
				<br>
			
				<div class="form-group">
					<div class="input-group">
					<div class="input-group-addon">Choisir une Langue</div>
						<select name="langueActualite" class="form-control">
							<option value="choix" > Choisir une langue</option>
							<option <?php  if (((isset($_POST["langueActualite"])) && ($_POST["langueActualite"] == "fr")) or ($mesValeurs["langue_actualite"] == "fr" )) echo "selected"; else  echo "selected"; ?> value="fr" > Français</option>
							<option <?php  if (((isset($_POST["langueActualite"])) && ($_POST["langueActualite"] == "en")) or ($mesValeurs["langue_actualite"] == "en" )) echo "selected"; ?> value="en" > Anglais</option>
							<option <?php  if (((isset($_POST["langueActualite"])) && ($_POST["langueActualite"] == "ar")) or ($mesValeurs["langue_actualite"] == "ar" )) echo "selected"; ?> value="ar" > Arabe</option>
						</select>
					</div>
				</div>
			
					
			
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">Choisir la catégorie</div>
						<select name="categorieActualite" class="form-control">
							<option value="choix" > Choisir une Catégorie</option>
							<?php 
							$requete = mysql_query("SELECT * FROM categorie") or die(mysql_error());
							while ($resultCat= mysql_fetch_array($requete)) 
							{
								$IDCat = $resultCat['id_cat'];
								$nomCat = $resultCat['nom_cat'];
								$langueCat = $resultCat['langue_cat'];
								if (((isset($_POST["categorieActualite"])) && ($_POST["categorieActualite"] == $IDCat)) or (isset($mesValeurs["categorie_actualite"]) && ($mesValeurs["categorie_actualite"] == $IDCat ))) $selected = "selected"; else $selected ="";
								echo "<option ".$selected." value=".$IDCat." > ".$nomCat." (".$langueCat.")</option>";
							}


							?>   
						</select>
					</div>
				</div>
			
			
				<center>
					<button type="submit" class="btn btn-success " style="width:49%">Accepter</button>
					<button type="submit" class="btn btn-danger " style="width:49%" >Réfuser</button>
			    </center>
			</form>
            
		</div>
         
<?php  
	} 
}
include('footer.php');
 ?>      