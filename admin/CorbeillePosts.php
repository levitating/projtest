
<?php 

include('load.php');
include('../inc/categories.php');
include('../inc/actualites.php');

 
$objectErreur = new myClassErreur();
$objectErreur->afficherErreurs();
?>	  
		
<div class="text-left" href="#actualite">
	<h3>Actualités<small> Corbeille</small></h3>
	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="">Nom</th>
				<th class="">Auteur</th>
				<th class="">Langue</th>
				<th class="">categorie</th>
				<th class="">status</th>
				<th class="">Dernière modification</th>
				<th class="" style="width: 140px;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$getActualite = mysql_query("SELECT * FROM actualite WHERE status_actualite = '-1' ".$objectRole->myPostsDisplay()."  ORDER BY id_actualite DESC") or die(mysql_error());
			$numGetActualite = mysql_num_rows($getActualite);

			while ($result=mysql_fetch_array($getActualite))
			{
					$IDActualite = $result['id_actualite'];
					$auteurActualite = $result['auteur_id_actualite'];
					$titreActualite = $result['titre_actualite'];
					$langueActualite = $result['langue_actualite'];
					$categorieActualite = $result['categorie_actualite'];
					$statusActualite = $result['status_actualite'];
					$dateActualite = $result['date_actualite'];
					
					$getCategorie = mysql_query("SELECT * FROM categorie WHERE id_cat='$categorieActualite'") or die(mysql_error());
					$getNameCategorie = mysql_fetch_assoc($getCategorie);
					$myCategorie = $getNameCategorie["nom_cat"];
					
					$getAuteur = mysql_query("SELECT * FROM admin WHERE id_admin = '$auteurActualite'") or die(mysql_error());
					$getNameAuteur = mysql_fetch_assoc($getAuteur);
					$myNameInformation = $getNameAuteur["nom_admin"].' '.$getNameAuteur["prenom_admin"].' ('.$getNameAuteur["type_admin"].')';
					
					if ($statusActualite) $color_class="success"; else $color_class="";
					if (isset($_POST["supprimerbutton".$IDActualite])) 
					{
						$objectActualite = new myClassActualite();
						$objectActualite->supprimerActualite ($IDActualite);
						header("location: CorbeillePosts.php");
					}
				
			?>
 

					<form action="CorbeillePosts.php#actualite" method="POST" >
						<tr class="<?php echo $color_class; ?>">
							<td class=""><?php echo $titreActualite; ?></td>
							<td class=""><?php echo $myNameInformation; ?></td>
							<td class=""><?php echo $langueActualite; ?></td>
							<td class=""><?php echo $myCategorie; ?></td>
							<td class=""><?php if ($statusActualite) echo "Publiée"; else echo "Broullion";?></td>
							<td class=""><?php echo $dateActualite; ?></td>
							<td class="">
								 <button type="button" class="btn btn-success" onclick="window.location.replace('ModifierPosts.php?monpost=<?php echo $IDActualite; ?>#actualite');" >Modifier</button> &nbsp;
									<img  src="../img/del.png" onclick="$('#sup<?php echo $IDActualite; ?>').toggle('slow');" style="cursor: pointer;" />
							</td>
						</tr>
 

						<tr class="danger" id="sup<?php echo $IDActualite; ?>" style="display: none;">
							<td colspan="6"> Vous êtes sur de vouloir supprimer cette actualité difinitivement ?</td>
							<td><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDActualite; ?>" >Oui, je supprime !</button></td>
						</tr>
					</form>

			<?php 
			}			
			?>

		</tbody>
	</table>
</div>
<?php include('footer.php'); ?>      