 <?php 

include('load.php');
include('../inc/administrateurs.php');


if (isset($_POST['submit'])){
$idAdmin=$_SESSION["ID_USER"];
$pseudoAdmin=$_POST['pseudoAdmin'];
$nomAdmin=$_POST['nomAdmin'];
$prenomAdmin=$_POST['prenomAdmin'];
$emailAdmin=$_POST['emailAdmin'];



$objectAdmin = new myClassAdmin();
$objectAdmin->modifierProfil($idAdmin,$pseudoAdmin,$nomAdmin,$prenomAdmin,$emailAdmin);
}

 ?> 
 


		
<div class="text-left" href="#page">
		<h3>Profil<small> Modifier mes informations - <a href="ModifierPass.php#admin">Modifier mot de passe</a></small></h3>
		
		<br>
		<form action="modifierProfil.php#admin" method="POST" >
		<div class="form-group">
			<label for="exampleInputEmail1">Pseudo</label>
			<input type="text" class="form-control" value='<?php if (isset($_POST['pseudoAdmin'])) echo $_POST['pseudoAdmin']; else echo $_SESSION["PSEUDO_USER"]; ?>' name="pseudoAdmin" placeholder="Saisir le pseudonyme">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Nom</label>
			<input type="text" class="form-control" name="nomAdmin" value='<?php if (isset($_POST['nomAdmin'])) echo $_POST['nomAdmin']; else echo $_SESSION["NOM_USER"]; ?>' placeholder="Saisir le nom">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Prénom</label>
			<input type="text" class="form-control" name="prenomAdmin" value='<?php if (isset($_POST['prenomAdmin'])) echo $_POST['prenomAdmin']; else echo $_SESSION["PRENOM_USER"]; ?>' placeholder="Saisir le prénom">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Email</label>
			<input type="email" class="form-control" name="emailAdmin" value='<?php if (isset($_POST['emailAdmin'])) echo $_POST['emailAdmin']; else echo $_SESSION["EMAIL_USER"]; ?>' placeholder="Saisir l'Email">
		</div>
				<br>
		<button type="submit" name="submit" class="btn btn-primary btn-block" >Modifier</button>
		
		</form>
		
		
</div> 
   
 <?php include('footer.php'); ?> 