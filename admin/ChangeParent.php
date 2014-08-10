<?php 

include('load.php');
include('../inc/pages.php');


if ((!isset($_POST["mapage"])) && (!isset($_GET["mapage"])))
{
	$_SESSION["MESSAGES_CAT_ERREUR"] = "Erreur de trouver l'identifiant";
	header("location: AfficherPages.php#page");
}
else 
{
	if (isset($_POST["mapage"])) $myIdAModifier = $_POST["mapage"];
	if (isset($_GET["mapage"]))  $myIdAModifier = $_GET["mapage"];
	$requeteID = mysql_query("SELECT * FROM page WHERE id_page = '$myIdAModifier' ") or die(mysql_error()); 
	$numValeurs = mysql_num_rows ($requeteID);
	if ($numValeurs == 0)  
	{
		$_SESSION["MESSAGES_CAT_ERREUR"] = "Cette page est introuvable";
		header("location: AfficherPages.php#page"); 
	}
	else 
	{
		$requeteChangeSousPage = mysql_query("SELECT * FROM page WHERE parent_page='$myIdAModifier'") or die(mysql_error());
		if ( mysql_num_rows($requeteChangeSousPage) == 0 ) 
		{	
			$_SESSION["MESSAGES_CAT_ERREUR"] = "Cette page n'a pas des sous pages";
			header("location: AfficherPages.php#page");
			exit();
		}
		$mesValeurs = mysql_fetch_assoc ($requeteID);
		if (isset($_POST["parentPage"])) 
		{ 
			$objectPage = new myClassPage();
			$objectPage->modifierParentPage($myIdAModifier, mysql_real_escape_string ($_POST["parentPage"]));
		}
		$objectErreur = new myClassErreur();
		$objectErreur->afficherErreurs();
 
?>	
          
	<div class="text-left" href="#page">
	<h3>Attention !<small> <br><br> Vous venez de supprimer une page qui contient plusieur sous pages, il faut affecter ces dernieres à un parent<br><br> Veuillez choisir une page dans la liste ci-dessous :</small></h3>
		<br>
		<form action="ChangeParent.php?mapage=<?php echo $myIdAModifier; ?>#page" method="POST" >

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Choisir un parent</div>
					<select name="parentPage" class="form-control">
						<option value="0" >Pas de parent</option>
						<?php 
						$requeteMenu = mysql_query("SELECT * FROM menu WHERE parent_menu=0 AND status_menu <> '-1' ");
						$nbrResult = mysql_num_rows($requeteMenu);
						
						if($nbrResult != 0)
						{
							while($menuResult = mysql_fetch_array($requeteMenu)) //iteration pour les parent valeur 0							
							{
								$idPageMenu =    $menuResult['id_page_menu'];
								$idParentMenu =  $menuResult['parent_menu'];
								$titrePageMenu = $menuResult['titre_menu'];
								
								if ( $idPageMenu == $myIdAModifier )
								{
									$disabled = "disabled style='color: red;'"; 
									$disabledImportant = "disabled style='color: red;'";
								}
								else
								{
									$disabled = ""; 
									$disabledImportant = ""; 
								}
								
								echo '<option '.$disabled.'  value="'.$idPageMenu.'" >'.$titrePageMenu.'</option>';
							



					
										$requeteMenuFille=mysql_query("SELECT * FROM menu WHERE parent_menu='$idPageMenu' AND status_menu <> '-1' "); 
										$nbrResultFille=mysql_num_rows($requeteMenuFille);
										if($nbrResultFille != 0)
										{
											while($menuResultFille = mysql_fetch_array($requeteMenuFille)) //iteration pour les pages filles
											{
												$idPageMenuFille = $menuResultFille['id_page_menu'];
												$idParentMenuFille = $menuResultFille['parent_menu'];
												$titrePageMenuFille = $menuResultFille['titre_menu'];
												
												if ($idPageMenuFille == $myIdAModifier) $disabled = "disabled"; else $disabled=""; 
												echo '<option '.$disabled.' '.$disabledImportant.'  value="'.$idPageMenuFille.'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$titrePageMenuFille.'</option>';
												
										
										
										
										
																$requeteMenuFille1=mysql_query("SELECT * FROM menu WHERE parent_menu='$idPageMenuFille' AND status_menu <> '-1' "); 
																$nbrResultFille1=mysql_num_rows($requeteMenuFille1);
																if($nbrResultFille1 != 0)
																{
																	while($menuResultFille1 = mysql_fetch_array($requeteMenuFille1)) //iteration pour les pages filles niveau 2
																	{
																		$idPageMenuFille1 = $menuResultFille1['id_page_menu'];
																		$idParentMenuFille1 = $menuResultFille1['parent_menu'];
																		$titrePageMenuFille1 = $menuResultFille1['titre_menu'];
																		
																		echo '<option disabled style="color: red;" value="'.$idPageMenuFille1.'" >&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$titrePageMenuFille1.'</option>';
																		
																
																	}
																}
										
											
											
											
											}
										}
						
							}
						}
						?> 
					
					
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary btn-block" >Modifier</button>
		</form>
		
        <script>
            CKEDITOR.replace( 'contenuPage' );
        </script>
	</div>
         
  <?php  
	} 
}
include('footer.php'); ?>      