
 <?php 

include('load.php');
 include('../inc/pages.php');

	 
	$objectErreur = new myClassErreur();
	$objectErreur->afficherErreurs();
 ?>	  
<div class="text-left" href="#page">
<h3>Pages<small> Mes pages</small></h3>
		  
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
			$getPage = mysql_query("SELECT * FROM page WHERE parent_page = 0 AND status_page <> '-1' ORDER BY date_page DESC") or die(mysql_error());
			$numGetPage = mysql_num_rows($getPage);
			while ($result=mysql_fetch_array($getPage))
			{
				$IDPage = $result['id_page'];
				$titrePage = $result['titre_page'];
				$languePage = $result['langue_page'];
				$statusPage = $result['status_page'];
				$menuPage = $result['parent_page'];
				$datePage = $result['date_page'];
				if ($statusPage) $colorClass="success"; else $colorClass="";
				if ($menuPage == "-1") $colorClass="warning"; 
				if (isset($_POST["supprimerbutton".$IDPage])) 
				{
					$objectPage = new myClassPage();
					$objectPage->corbeillePage ($IDPage);
					header("location: AfficherPages.php#page");
				}
		
			?>
	 

				<form action="AfficherPages.php#page" method="POST" >
					<tr class="<?php echo $colorClass; ?>">
						<td class=""><strong><?php echo $titrePage; ?></strong> <?php if ($menuPage == "-1") echo "(Parent supprimé)";  ?></td>
						<td class=""><?php echo $languePage; ?></td>
						<td class=""><?php if ($statusPage) echo "Publiée"; else echo "Broullion";?></td>
						<td class=""><?php echo $datePage; ?></td>
						<td class="">
							<button type="button" class="btn btn-success" onclick="window.location.replace('ModifierPages.php?mapage=<?php echo $IDPage; ?>#page');" >Modifier</button> 
							&nbsp;
							<img  src="../img/del.png" onclick="$('#sup<?php echo $IDPage; ?>').toggle('slow');" style="cursor: pointer;" />
						</td>
					</tr>
				 
					<tr class="danger" id="sup<?php echo $IDPage; ?>" style="display: none;">
						<td colspan="4"> Vous êtes sur de vouloir supprimer cette page ?</td>
						<td><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDPage; ?>" >Oui, je supprime !</button> </td>
					</tr>
				</form>

	<?php 
				$getPageNiveauDeux = mysql_query("SELECT * FROM page WHERE parent_page = $IDPage AND status_page <> '-1' ORDER BY date_page DESC") or die(mysql_error());
				$numGetPageNiveauDeux = mysql_num_rows($getPageNiveauDeux);
				while ($resultNiveauDeux=mysql_fetch_array($getPageNiveauDeux))
				{
					$IDPageNiveauDeux = $resultNiveauDeux['id_page'];
					$titrePageNiveauDeux = $resultNiveauDeux['titre_page'];
					$languePageNiveauDeux = $resultNiveauDeux['langue_page'];
					$statusPageNiveauDeux = $resultNiveauDeux['status_page'];
					$menuPageNiveauDeux = $resultNiveauDeux['parent_page'];
					$datePageNiveauDeux = $resultNiveauDeux['date_page'];
					if ($statusPageNiveauDeux) $colorClassNiveauDeux="success"; else $colorClassNiveauDeux="";
					if (isset($_POST["supprimerbutton".$IDPageNiveauDeux])) 
					{
						$objectPage = new myClassPage();
						$objectPage->corbeillePage ($IDPageNiveauDeux);
						header("location: AfficherPages.php#page");
					}
	?>
					<form action="AfficherPages.php#page" method="POST" >
						<tr class="<?php echo $colorClassNiveauDeux; ?>">
							<td class="">&nbsp;&nbsp;&nbsp;&nbsp;— <?php echo $titrePageNiveauDeux; ?></td>
							<td class=""><?php echo $languePageNiveauDeux; ?></td>
							<td class=""><?php if ($statusPageNiveauDeux) echo "Publiée"; else echo "Broullion";?></td>
							<td class=""><?php echo $datePageNiveauDeux; ?></td>
							<td class="">
								<button type="button" class="btn btn-success" onclick="window.location.replace('ModifierPages.php?mapage=<?php echo $IDPageNiveauDeux; ?>#page');" >Modifier</button>
								&nbsp;
								<img  src="../img/del.png" onclick="$('#sup<?php echo $IDPageNiveauDeux; ?>').toggle('slow');" style="cursor: pointer;" />
							</td>
						</tr>
						<tr class="danger" id="sup<?php echo $IDPageNiveauDeux; ?>" style="display: none;">
							<td colspan="4"> Vous êtes sur de vouloir supprimer cette page ?</td>
							<td><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDPageNiveauDeux; ?>" >Oui, je supprime !</button> </td>
						</tr>
					</form> 

	<?php 
					$getPageNiveauTrois = mysql_query("SELECT * FROM page WHERE parent_page = $IDPageNiveauDeux AND status_page <> '-1' ORDER BY date_page DESC") or die(mysql_error());
					$numGetPageNiveauTrois = mysql_num_rows($getPageNiveauTrois);
					while ($resultNiveauTrois=mysql_fetch_array($getPageNiveauTrois))
					{
						$IDPageNiveauTrois = $resultNiveauTrois['id_page'];
						$titrePageNiveauTrois = $resultNiveauTrois['titre_page'];
						$languePageNiveauTrois = $resultNiveauTrois['langue_page'];
						$statusPageNiveauTrois = $resultNiveauTrois['status_page'];
						$menuPageNiveauTrois = $resultNiveauTrois['parent_page'];
						$datePageNiveauTrois = $resultNiveauTrois['date_page'];
						if ($statusPageNiveauTrois) $colorClassNiveauTrois="success"; else $colorClassNiveauTrois="";
						if (isset($_POST["supprimerbutton".$IDPageNiveauTrois])) 
						{
							$objectPage = new myClassPage();
							$objectPage->supprimerPage ($IDPageNiveauTrois);
							header("location: AfficherPages.php#page");
						}
			
	?>
						<form action="AfficherPages.php#page" method="POST" >
							<tr class="<?php echo $colorClassNiveauTrois; ?>">
								<td class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;— — <?php echo $titrePageNiveauTrois; ?></td>
								<td class=""><?php echo $languePageNiveauTrois; ?></td>
								<td class=""><?php if ($statusPageNiveauTrois) echo "Publiée"; else echo "Broullion";?></td>
								<td class=""><?php echo $datePageNiveauTrois; ?></td>
								<td class="">
									<button type="button" class="btn btn-success" onclick="window.location.replace('ModifierPages.php?mapage=<?php echo $IDPageNiveauTrois; ?>#page');" >Modifier</button>
									&nbsp;
									<img  src="../img/del.png" onclick="$('#sup<?php echo $IDPageNiveauTrois; ?>').toggle('slow');" style="cursor: pointer;" />
								</td>
							</tr>
							<tr class="danger" id="sup<?php echo $IDPageNiveauTrois; ?>" style="display: none;">
								<td colspan="4"> Vous êtes sur de vouloir supprimer cette page ?</td>
								<td><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDPageNiveauTrois; ?>" >Oui, je supprime !</button> </td>
							</tr>
						</form> 
	  
	  
	  <?php 		
					}
				}
			}			
	 ?>

		</tbody>
	</table>
</div>
         
  <?php include('footer.php'); ?>      