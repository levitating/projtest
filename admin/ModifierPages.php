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
	} else 
	{
		$mesValeurs = mysql_fetch_assoc ($requeteID);
		if (isset($_POST["titrePage"]) or isset($_POST["contenuPage"])  or isset($_POST["languePage"]) or isset($_POST["categoriePage"])) 
		{
			$objectPage = new myClassPage();
			$objectPage->modifierPage($myIdAModifier, $_POST["titrePage"],$_POST["contenuPage"],$_POST["languePage"],$_POST["statusPage"], $_POST["parentPage"]);
		}
		$objectErreur = new myClassErreur();
		$objectErreur->afficherErreurs();
 
?>	
          
	<div class="text-left" href="#page">
	<h3>Pages<small> Modifier la page</small></h3>
		<br>
		<form action="ModifierPages.php?mapage=<?php echo $myIdAModifier; ?>#page" method="POST" >

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Titre</div>
					<input class="form-control" type="text" name="titrePage" value="<?php  if (isset($_POST["titrePage"])) echo $_POST["titrePage"]; else echo $mesValeurs["titre_page"]; ?>" placeholder="Saisir le titre de l'actualité">
				</div>
			</div>
		
			
			<textarea  id="texteditor" name="contenuPage" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre actualité ici"><?php  if (isset($_POST["contenuPage"])) echo $_POST["contenuPage"];  else echo $mesValeurs["contenu_page"];  ?></textarea>
			
			<br>
		
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Choisir une Langue</div>
					<select name="languePage" class="form-control">
						<option value="choix" > Choisir une langue</option>
						<option <?php  if (((isset($_POST["languePage"])) && ($_POST["languePage"] == "fr")) or ($mesValeurs["langue_page"] == "fr" )) echo "selected";  else  echo "selected"; ?> value="fr" > Français</option>
						<option <?php  if (((isset($_POST["languePage"])) && ($_POST["languePage"] == "en")) or ($mesValeurs["langue_page"] == "en" )) echo "selected"; ?> value="en" > Anglais</option>
						<option <?php  if (((isset($_POST["languePage"])) && ($_POST["languePage"] == "ar")) or ($mesValeurs["langue_page"] == "ar" )) echo "selected"; ?> value="ar" > Arabe</option>
					</select>
				</div>
			</div>
	
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Choisir status</div>
					<select name="statusPage" class="form-control">					
						<option <?php  if (((isset($_POST["statusPage"])) && ($_POST["statusPage"] == "1")) or ($mesValeurs["status_page"] == "1" )) echo "selected"; ?> value="1" > Publiée</option>
						<option <?php  if (((isset($_POST["statusPage"])) && ($_POST["statusPage"] == "0")) or ($mesValeurs["status_page"] == "0" )) echo "selected"; ?> value="0" > Broullion</option>
					</select>
				</div>
			</div>
		
		
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">Parent</div>
					<select name="parentPage" class="form-control">
						<option value="0" >Pas de parent</option>
						<?php 
						$requeteMenu = mysql_query("SELECT * FROM menu WHERE parent_menu=0 AND status_menu <> '-1'");
						$nbrResult = mysql_num_rows($requeteMenu);
						
						if($nbrResult != 0)
						{
							while($menuResult = mysql_fetch_array($requeteMenu)) //iteration pour les pages parents
							{
								$idPageMenu = $menuResult['id_page_menu'];
								$idParentMenu = $menuResult['parent_menu'];
								$titrePageMenu = $menuResult['titre_menu'];
								if (((isset($_POST["parentPage"])) && ($_POST["parentPage"] == $idPageMenu)) or ($mesValeurs["parent_page"] == $idPageMenu )) $selected="selected"; else $selected="";
								if ($idPageMenu == $myIdAModifier) $disabled = "disabled"; else $disabled=""; 
								echo '<option '.$disabled.' '.$selected.' value="'.$idPageMenu.'" >'.$titrePageMenu.'</option>';
							



					
										$requeteMenuFille=mysql_query("SELECT * FROM menu WHERE parent_menu='$idPageMenu' AND status_menu <> '-1'"); 
										$nbrResultFille=mysql_num_rows($requeteMenuFille);
										if($nbrResultFille != 0)
										{
											while($menuResultFille = mysql_fetch_array($requeteMenuFille)) //iteration pour les pages filles
											{
												$idPageMenuFille = $menuResultFille['id_page_menu'];
												$idParentMenuFille = $menuResultFille['parent_menu'];
												$titrePageMenuFille = $menuResultFille['titre_menu'];
												if (((isset($_POST["parentPage"])) && ($_POST["parentPage"] == $idPageMenuFille)) or ($mesValeurs["parent_page"] == $idPageMenuFille )) $selected="selected"; else $selected="";
												if ($idPageMenuFille == $myIdAModifier) $disabled = "disabled"; else $disabled=""; 
												echo '<option '.$disabled.' '.$selected.' value="'.$idPageMenuFille.'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$titrePageMenuFille.'</option>';
												
										
										
										
										
																$requeteMenuFille1=mysql_query("SELECT * FROM menu WHERE parent_menu='$idPageMenuFille' AND status_menu <> '-1'"); 
																$nbrResultFille1=mysql_num_rows($requeteMenuFille1);
																if($nbrResultFille1 != 0)
																{
																	while($menuResultFille1 = mysql_fetch_array($requeteMenuFille1)) //iteration pour les pages filles niveau 2
																	{
																		$idPageMenuFille1 = $menuResultFille1['id_page_menu'];
																		$idParentMenuFille1 = $menuResultFille1['parent_menu'];
																		$titrePageMenuFille1 = $menuResultFille1['titre_menu'];
																		
																		echo '<option disabled  value="'.$idPageMenuFille1.'" >&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$titrePageMenuFille1.'</option>';
																		
																
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
	
	</div>
         
  <?php  
	} 
}
include('footer.php'); ?>      