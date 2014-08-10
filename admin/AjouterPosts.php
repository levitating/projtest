<?php 

include('load.php');

include('../inc/actualites.php');
include('../inc/categories.php');


if (isset($_POST["titreActualite"]) or isset($_POST["contenuActualite"])  or isset($_POST["langueActualite"]) or isset($_POST["categorieActualite"])) 
{
	$objectActualite = new myClassActualite();
	$objectActualite->ajouterActualite ($_POST["titreActualite"],$_POST["contenuActualite"],$_POST["langueActualite"],$_POST["categorieActualite"],$_POST["statusActualite"]);
}
$objectErreur = new myClassErreur();
$objectErreur->afficherErreurs();

 ?>	
   
<div class="text-left" href="#actualite">
	<h3>Actualités<small> Ajouter une actualité</small></h3>
	<br>
	<form action="AjouterPosts.php#actualite" method="POST" >
		
		<div class="form-group">
			<div class="input-group">
			<div class="input-group-addon">Titre</div>
			<input class="form-control" type="text" name="titreActualite" value="<?php  if (isset($_POST["titreActualite"])) echo $_POST["titreActualite"]; ?>" placeholder="Saisir le titre de l'actualité">
			</div>
		</div>
		 
		
		<textarea  id="texteditor" name="contenuActualite" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre actualité ici"><?php  if (isset($_POST["contenuActualite"])) echo $_POST["contenuActualite"]; ?></textarea>
		<br>
		
		
		

		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Choisir une Langue</div>
				<select name="langueActualite" class="form-control">
					<option value="choix" > Choisir une langue</option>
					<option <?php  if ((isset($_POST["langueActualite"])) && ($_POST["langueActualite"] == "fr")) echo "selected"; else echo "selected"; ?> value="fr" > Français</option>
					<option <?php  if ((isset($_POST["langueActualite"])) && ($_POST["langueActualite"] == "en")) echo "selected"; ?> value="en" > Anglais</option>
					<option <?php  if ((isset($_POST["langueActualite"])) && ($_POST["langueActualite"] == "ar")) echo "selected"; ?> value="ar" > Arabe</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Choisir la catégorie</div>
				<select name="categorieActualite" class="form-control">
					<option value="choix" > Choisir une Catégorie</option>
					<?php 
					$objectCategorie = new myClassCategorie();
					$objectCategorie->getCategorie(); 
					?>   
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Choisir status</div>
				<select name="statusActualite" class="form-control">
					<option value="1" > Publiée</option>
					<option value="0" > Broullion</option>
				</select>
			</div>
		</div>

		<button type="submit" class="btn btn-primary btn-block" >Publier</button>
	</form>
	
</div>

<?php include('footer.php'); ?>      