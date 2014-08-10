 <?php 

include('load.php');
include('../inc/administrateurs.php');


if (isset($_POST['submitPass'])){
$idAdmin=$_SESSION["ID_USER"];
$actuelPass=$_POST['actuelPass'];
$nouveauPass=$_POST['nouveauPass'];
$confirmPass=$_POST['confirmPass'];



$objectAdmin = new myClassAdmin();
$objectAdmin->modifierPass($idAdmin,$actuelPass,$nouveauPass,$confirmPass);
}

 ?> 
 


		
<div class="text-left" href="#page">
		<h3>Profil<small> <a href="ModifierProfil.php#admin">Modifier mes informations</a> -  Modifier mot de passe</small></h3>		
		<br>
		<form action="modifierPass.php#admin" method="POST" >
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">mot de passe actuel</label>
			<input type="password" class="form-control" name="actuelPass"  placeholder="Saisir le mot de passe actuel">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Nouveau mot de passe</label>
			<input type="password" class="form-control" name="nouveauPass" placeholder="Saisir le nouveau mot de passe">
		</div>
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Confirmer mot de passe</label>
			<input type="password" class="form-control" name="confirmPass"  placeholder="Confirmer le mot de passe">
		</div>
		
		<br>
		<button type="submit" name="submitPass" class="btn btn-primary btn-block" >Modifier mot de passe</button>
		
		</form>
		
		
</div> 
   
 <?php include('footer.php'); ?> 