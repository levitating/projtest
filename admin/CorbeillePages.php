
 <?php 

include('load.php');
 include('../inc/pages.php');
	
 
$objectErreur = new myClassErreur();
$objectErreur->afficherErreurs();
//$objectErreur->initialiserErreur("l’identifiant ou mot de passe ne sont pas valide." , 0);
 ?>	  
<div class="text-left" href="#page">
<h3>Corbeille<small> Mes pages supprimées</small></h3>
		  
<br>

	<table class="table table-hover">
		<thead>
			<tr>
				<th class="">Nom</th>
				<th class="">Langue</th>
				<th class="">status</th>
				<th class="">Dernière modification</th>
				<th class="" style="width:140px">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$getPage = mysql_query("SELECT * FROM page WHERE  status_page = '-1' ORDER BY date_page DESC") or die(mysql_error());
			$numGetPage = mysql_num_rows($getPage);
			while ($result=mysql_fetch_array($getPage))
			{
				$IDPage = $result['id_page'];
				$titrePage = $result['titre_page'];
				$languePage = $result['langue_page'];
				$statusPage = $result['status_page'];
				$menuPage = $result['parent_page'];
				$datePage = $result['date_page'];
				if ($statusPage == 1) $colorClass="success"; else $colorClass="";
				if ($menuPage == "-1") $colorClass="warning"; 
				if (isset($_POST["supprimerbutton".$IDPage])) 
				{
					$objectPage = new myClassPage();
					$objectPage->supprimerPageDifinitivement ($IDPage);
					header("location: CorbeillePages.php#page");
				}
		
			?>
	 

				<form action="CorbeillePages.php#page" method="POST" >
					<tr class="<?php echo $colorClass; ?>">
						<td class=""><strong><?php echo $titrePage; ?></strong> <?php if ($menuPage == "-1") echo "(Parent supprimé)";  ?></td>
						<td class=""><?php echo $languePage; ?></td>
						<td class=""><?php if ($statusPage) echo "Publiée"; else echo "Broullion";?></td>
						<td class=""><?php echo $datePage; ?></td>
						<td class="">
							<button type="button" class="btn btn-success" onclick="window.location.replace('ModifierPages.php?mapage=<?php echo $IDPage; ?>#page');" >Rétablir</button> 
							&nbsp;
							<img  src="../img/del.png" onclick="$('#sup<?php echo $IDPage; ?>').toggle('slow');" style="cursor: pointer;" />
						</td>
					</tr>
				 
					<tr class="danger" id="sup<?php echo $IDPage; ?>" style="display: none;">
						<td colspan="4"> Vous êtes sur de vouloir supprimer cette page difinitivement ?</td>
						<td><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDPage; ?>" >Oui, je supprime !</button> </td>
					</tr>
				</form>

	
	  
	  
	  <?php 
			}			
	 ?>

		</tbody>
	</table>
</div>
         
  <?php include('footer.php'); ?>      