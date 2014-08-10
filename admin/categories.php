
 <?php 

	include('load.php');
	include('../inc/categories.php');

 
 if (isset($_POST["titreCategorie"]) or isset($_POST["langueCategorie"])) 
 {
	$objectCategorie = new myClassCategorie();
	$objectCategorie->ajouterCategorie (mysql_real_escape_string ($_POST["titreCategorie"]), mysql_real_escape_string ($_POST["langueCategorie"]));
 }

 $objectErreur = new myClassErreur();
 $objectErreur->afficherErreurs();
 ?>	  
	<div class="" href="#actualite" >
		<h3>Catégories<small> Créer une catégorie</small></h3>
		<br>
		<form action="categories.php#actualite" method="POST" >
		  
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Nom</div>
					<input name="titreCategorie" class="form-control" type="text" value="<?php if (isset($_POST["titreCategorie"])) echo $_POST["titreCategorie"]; ?>" placeholder="Saisir le titre de la catégorie">
				</div>
			</div>
		
			
		
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Choisir une Langue</div>
					<select name="langueCategorie" class="form-control">
						<option value="choix" > Choisir une langue</option>
						<option value="fr"  selected > Français</option>
						<option value="en" > Anglais</option>
						<option value="ar" > Arabe</option>
					
					</select>
				</div>
			</div>
	

			<button type="submit" class="btn btn-primary btn-block" >Créer</button>
		</form>
		
		<br>
		<br>
				
		<hr>
				
		<br>
		<br>
		
		<div class="text-left" href="#actualite">
		<h3>Catégories<small> Mes catégories</small></h3>
		<br>
		<table class="table table-hover">
        
			<thead>
				<tr>
					<th class="">ID</th>
					<th class="">Nom</th>
					<th class="">Langue</th>
					<th class="">Action</th>
				</tr>
			</thead>
 
			<tbody>
				<?php 
				$getCategorie = mysql_query("SELECT * FROM categorie") or die(mysql_error());
				$numGetCategorie = mysql_num_rows($getCategorie);

				while ($result=mysql_fetch_array($getCategorie))
				{
					$IDCat = $result['id_cat'];
					$nomCat = $result['nom_cat'];
					$langueCat = $result['langue_cat'];

					if (isset($_POST["modifierbutton".$IDCat])) 
					{
						$objectCategorie = new myClassCategorie();
						$objectCategorie->modifierCategorie ($IDCat, mysql_real_escape_string ($_POST["titreCategorie".$IDCat]), mysql_real_escape_string ($_POST["langueCategorie".$IDCat])) ;
						header("location: categories.php");
						
					} 
					elseif (isset($_POST["supprimerbutton".$IDCat])) 
					{
						$nouvelleCategorie = $_POST["nouvellesCategorie".$IDCat];
						$objectCategorie = new myClassCategorie();
						$objectCategorie->supprimerCategorie ($IDCat, $nouvelleCategorie);
						header("location: categories.php");
					}
    
				?>
 

					<form action="categories.php#actualite" method="POST" >
						<tr>
						 
							<td class=""><?php echo $IDCat; ?></td>
							<td class=""><?php echo $nomCat; ?></td>
							<td class=""><?php echo $langueCat; ?></td>
							<td class="" <?php if ($IDCat == 0 )  echo 'style="height: 52px;"'; ?> >
							<?php 
							if ($IDCat != 0 ) 
							{ 
							?>
								<button type="button" class="btn btn-success" onclick="$('#mod<?php echo $IDCat; ?>').toggle('slow');" id="modifier<?php echo $IDCat; ?>">Modifier</button> | 
								
								<img  src="../img/del.png" onclick="$('#sup<?php echo $IDCat; ?>').toggle('slow');" style="cursor: pointer;" />
							<?php 
							} 
							?>
							  </td>
						</tr>
 
						<?php 
						if ($IDCat != 0 ) 
						{ 
						?>
						
						
							<tr class="active" id="mod<?php echo $IDCat; ?>" style="display: none;">
								<td class=""><?php echo $IDCat; ?></td>
								<td class=""><input name="titreCategorie<?php echo $IDCat; ?>" class="form-control" type="text" placeholder="Saisir le titre de la catégorie" value="<?php echo $nomCat; ?>"></td>
								<td class="">
									<select name="langueCategorie<?php echo $IDCat; ?>" class="form-control">
										<option value="choix" > Choisir une langue</option>
										<option <?php if ($langueCat == "fr") echo "selected" ?> value="fr" > Français</option>
										<option <?php if ($langueCat == "en") echo "selected" ?> value="en" > Anglais</option>
										<option <?php if ($langueCat == "ar") echo "selected" ?> value="ar" > Arabe</option>
									</select>
								</td>
								<td class="">
									<button type="submit" class="btn btn-primary" name="modifierbutton<?php echo $IDCat; ?>">Modifier</button>
								</td> 
							</tr>
 
							<tr class="active" id="sup<?php echo $IDCat; ?>" style="display: none;">
								<td><?php echo $IDCat; ?></td>
								<td > Vous êtes sur de vouloir supprimer cette catégorie ?</td>
								<td class="">
									<select name="nouvellesCategorie<?php echo $IDCat; ?>" class="form-control">
										
										
										<?php
										
										$getCategorieSupprimer = mysql_query("SELECT * FROM categorie WHERE id_cat <> '$IDCat' ") or die(mysql_error());
										$numGetCategorieSupprimer  = mysql_num_rows($getCategorieSupprimer);

										while ($resultSupprimer=mysql_fetch_array($getCategorieSupprimer))
										{
											$IDCatSupprimer = $resultSupprimer['id_cat'];
											$nomCatSupprimer = $resultSupprimer['nom_cat'];
											$langueCatSupprimer = $resultSupprimer['langue_cat'];
											echo '<option value="'.$IDCatSupprimer.'" >'.$nomCatSupprimer.'</option>';
										}
										
										?>
										
									
									</select>
								</td>
								<td><button type="submit" class="btn btn-primary"  name="supprimerbutton<?php echo $IDCat; ?>" >Oui, je supprime !</button></td>
							</tr>
							
						<?php 
						} 
						?>
					</form>

					<?php 
					}			
					?>

			</tbody>
		</table>
	</div>
         
 <?php include('footer.php'); ?>      