<?php 

include('load.php');
include('../config/db.php');
include('../inc/pages.php');

	
if(isset($_POST["titrePage"]) or isset($_POST["contenuPage"])  or isset($_POST["languePage"]) or isset($_POST["statusPage"]) or isset($_POST["parentPage"]))
{
	$objectPage = new myClassPage();
	$objectPage->ajouterPage($_POST["titrePage"], $_POST["contenuPage"], $_POST["languePage"], $_POST["statusPage"], $_POST["parentPage"]);
}
	$objectErreur = new myClassErreur();
	$objectErreur->afficherErreurs();
?>
		
<div class="text-left" href="#page">
<h3>Pages<small> Ajouter une page</small></h3>
<br>
	<form action="AjouterPages.php#page" method="POST" >
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Titre</div>
				<input class="form-control" type="text" name="titrePage" value="<?php  if (isset($_POST["titrePage"])) echo $_POST["titrePage"]; ?>" placeholder="Saisir le titre de la page">
			</div>
		</div> 
		
		
        <textarea  id="texteditor" name="contenuPage" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre page ici"><?php  if (isset($_POST["contenuPage"])) echo $_POST["contenuPage"]; ?></textarea>
		
		<br>
		
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Choisir une Langue</div>
				<select name="languePage" class="form-control">
					<option value="choix" > Choisir une langue</option>
					<option <?php  if ((isset($_POST["languePage"])) && ($_POST["languePage"] == "fr")) echo "selected"; else  echo "selected"; ?> value="fr" > Français</option>
					<option <?php  if ((isset($_POST["languePage"])) && ($_POST["languePage"] == "en")) echo "selected"; ?> value="en" > Anglais</option>
					<option <?php  if ((isset($_POST["languePage"])) && ($_POST["languePage"] == "ar")) echo "selected"; ?> value="ar" > Arabe</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Choisir status</div>
				<select name="statusPage" class="form-control">
					<option <?php  if ((isset($_POST["statusPage"])) && ($_POST["statusPage"] == "1")) echo "selected"; ?> value="1" > Publiée</option>
					<option <?php  if ((isset($_POST["statusPage"])) && ($_POST["statusPage"] == "0")) echo "selected"; ?> value="0" > Broullion</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Parent</div>
				<select name="parentPage" class="form-control">
					<option value="0" >Pas de parent</option>
					<?php 
					$requeteMenu=mysql_query("SELECT * FROM menu WHERE parent_menu=0 AND status_menu <> '-1'");
					$nbrResult=mysql_num_rows($requeteMenu);
					if($nbrResult != 0)
					{
						while($menuResult = mysql_fetch_array($requeteMenu)) //iteration pour les pages parents
						{
							$idPageMenu = $menuResult['id_page_menu'];
							$titrePageMenu = $menuResult['titre_menu'];
							echo '<option value="'.$idPageMenu.'" >'.$titrePageMenu.'</option>';
									$requeteMenuFille=mysql_query("SELECT * FROM menu WHERE parent_menu='$idPageMenu' "); 
									$nbrResultFille=mysql_num_rows($requeteMenuFille);
									if($nbrResultFille != 0)
									{
										while($menuResultFille = mysql_fetch_array($requeteMenuFille)) //iteration pour les pages filles
										{
											$idPageMenuFille = $menuResultFille['id_page_menu'];
											$titrePageMenuFille = $menuResultFille['titre_menu'];
											echo '<option value="'.$idPageMenuFille.'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$titrePageMenuFille.'</option>';
											
									
									
									
									
															$requeteMenuFille1=mysql_query("SELECT * FROM menu WHERE parent_menu='$idPageMenuFille' "); 
															$nbrResultFille1=mysql_num_rows($requeteMenuFille1);
															if($nbrResultFille1 != 0)
															{
																while($menuResultFille1 = mysql_fetch_array($requeteMenuFille1)) //iteration pour les pages filles niveau 2
																{
																	$idPageMenuFille1 = $menuResultFille1['id_page_menu'];
																	$titrePageMenuFille1 = $menuResultFille1['titre_menu'];
																	echo '<option disabled value="'.$idPageMenuFille1.'" >&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$titrePageMenuFille1.'</option>';
																	
															
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
		
		<button type="submit" class="btn btn-primary btn-block" >Publier</button>
	</form>

		</div> 
       
 <?php include('footer.php'); ?> 