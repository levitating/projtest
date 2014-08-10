 <?php 

include('load.php');
include('../inc/administrateurs.php');
if (isset($_POST['submit'])){
$pseudoAdmin=$_POST['pseudoAdmin'];
$nomAdmin=$_POST['nomAdmin'];
$prenomAdmin=$_POST['prenomAdmin'];
$emailAdmin=$_POST['emailAdmin'];
$passAdmin=$_POST['passAdmin'];
$confirmeAdmin=$_POST['confirmeAdmin'];
$roleAdmin=$_POST['roleAdmin'];
$objectAdmin = new myClassAdmin();
$objectAdmin->ajouterAdmin($pseudoAdmin,$nomAdmin,$prenomAdmin,$emailAdmin,$passAdmin,$confirmeAdmin,$roleAdmin);





}

 ?> 
 


		
<div class="text-left" href="#page">
		<h3>Administrateurs<small> Ajouter un administrateur</small></h3>
		
		<br>
		<form action="AjouterAdmins.php#admin" method="POST" >
		<div class="form-group">
			<label for="exampleInputEmail1">Pseudo</label>
			<input type="text" class="form-control" value='<?php if (isset($_POST['pseudoAdmin'])) echo $_POST['pseudoAdmin'] ;?>' name="pseudoAdmin" placeholder="Saisir le pseudonyme">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Nom</label>
			<input type="text" class="form-control" name="nomAdmin" value='<?php if (isset($_POST['nomAdmin'])) echo $_POST['nomAdmin'] ;?>' placeholder="Saisir le nom">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Prénom</label>
			<input type="text" class="form-control" name="prenomAdmin" value='<?php if (isset($_POST['prenomAdmin'])) echo $_POST['prenomAdmin'] ;?>' placeholder="Saisir le prénom">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Email</label>
			<input type="email" class="form-control" name="emailAdmin" value='<?php if (isset($_POST['emailAdmin'])) echo $_POST['emailAdmin'] ;?>' placeholder="Saisir l'Email">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Mot de passe</label>
			<input type="password" class="form-control" name="passAdmin" value='<?php if (isset($_POST['passAdmin'])) echo $_POST['passAdmin'] ;?>' placeholder="Saisir le mot de passe">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Confirmation</label>
			<input type="password" class="form-control"  name="confirmeAdmin" value='<?php if (isset($_POST['confirmeAdmin'])) echo $_POST['confirmeAdmin'] ;?>' placeholder="Confirmer le mot de passe">
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Role</label>
			<select name='roleAdmin' class="form-control">
			<option value='choix'>Choisir un role</option>
			 <?php 
             $requeteRole=Mysql_query("SELECT * FROM les_roles ");
			 while( $getRole=Mysql_fetch_array($requeteRole))
			 {
			   $nomRole=$getRole['nom_role'];
			   if ($_POST["roleAdmin"] == $nomRole) $selected="selected"; else $selected="";
			   if ($nomRole != "super administrateur") 
			   
			   echo "<option ".$selected." value='".$nomRole."'>".$nomRole."</option>";
			 }
			
             ?>

			 
			</select>
		</div>
		<br>
		<button type="submit" name="submit" class="btn btn-primary btn-block" >Ajouter Administrateur</button>
		
		</form>
		
		
</div> 
   
 <?php include('footer.php'); ?> 