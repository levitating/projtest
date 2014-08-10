<?php 

include('load.php');
include('../config/db.php');
include('../inc/bandeau.php');

$objectErreur = new myClassErreur();
	
if(isset($_POST["publier"]) )
	
{
	if (empty($_POST["titreBandeau"]) or empty($_POST["descriptionBandeau"]) )
	{
	$objectErreur->initialiserErreur("Veuillez remplir tous les champs",0);
	}
	/* else
{
        $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg' ,'jpg' => 'image/jpeg');
        $ListeExtensionIE = array('jpg' => 'image/pjpeg', 'jpeg'=>'image/pjpeg');
		$ListeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
		$ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg'); // Il fallait une nouvelle fois qu'IE se différencie.

        if (!empty($_FILES['ImageNews']))
        {
                //$TitreNews = $_POST['TitreNews'];
                //$ContenuNews = $_POST['ContenuNews'];
 
                if ($_FILES['ImageNews']['error'] <= 0)
                {
                        if ($_FILES['ImageNews']['size'] <= 2097152)
                        {
                            $ImageNews = $_FILES['ImageNews']['name'];
 
                            $ExtensionPresumee = explode('.', $ImageNews);
                            $ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
                            if ($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg' )
                            {
                              $ImageNews = getimagesize($_FILES['ImageNews']['tmp_name']);
                              if($ImageNews['mime'] == $ListeExtension[$ExtensionPresumee]  || $ImageNews['mime'] == $ListeExtensionIE[$ExtensionPresumee])
                                {
                                              
                                              imagecreatefromjpeg($_FILES['ImageNews']['tmp_name']);
											  
                                              $TailleImageChoisie = getimagesize($_FILES['ImageNews']['tmp_name']);
                                              $NouvelleLargeur = 620; //Largeur choisie à 350 px mais modifiable
 
                                              $NouvelleHauteur =384;( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
 
                                              $NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
 
                                              imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
                                              imagedestroy($ImageChoisie);
                                              $NomImageChoisie = explode('.', $ImageNews);
                                              $NomImageExploitable = time();
                                              
                                              imagejpeg($NouvelleImage , '../uploadBandeau/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);
                                              
                                              $LienImageNews = '../uploadBandeau/'.$NomImageExploitable.'.'.$ExtensionPresumee;
											  $nomCompletImage=$NomImageExploitable.'.'.$ExtensionPresumee;
											  
											$objectBandeau = new myClassBandeau();
											$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$nomCompletImage);
											
 
                                             $sql= 'INSERT INTO votre_table VALUES ("", "'.$TitreNews.'", "'.$ContenuNews.'", "'.$LienImageNews.'", "'.time().'")';
                                              $res = mysql_query($sql) or die(mysql_error());
                                              if ($res)
                                              {
                                                      echo 'La news a bien été insérée';
                                              }
                                        }
                                        else
                                        {
												$objectErreur->initialiserErreur("Le type MIME de l'image n'est pas bon" , 0);
                                        }
                                }
                                else
                                {
										$objectErreur->initialiserErreur("L'extension choisie pour l'image est incorrecte!" , 0);

                                }
                        }
                        else
                        {
								$objectErreur->initialiserErreur("L'image est trop lourde" , 0);
                               
                        }
                }
                else
                {
						 $objectErreur->initialiserErreur("Erreur lors de l'upload image" , 0);
                   
                }
        }
        else
        {
		$objectErreur->initialiserErreur("Au moins un des champs est vide" , 0);

        }
}
	}
	
	
	*/

	
	else
	{
		$content_dir = '../uploadBandeau/'; // dossier où sera déplacé le fichier
		
		$tmp_file = $_FILES['ImageNews']['tmp_name'];
		
		if( !is_uploaded_file($tmp_file) )
		{
		$objectErreur->initialiserErreur("Le fichier est introuvable",0);
				}
		
		// on vérifie maintenant l'extension
		$type_file = $_FILES['ImageNews']['type'];
				if( strstr($type_file, 'jpg') || strstr($type_file, 'jpeg'))
				{
					//$objectErreur->initialiserErreur("Le fichier n'est pas une image",0);
				
				
				// on copie le fichier dans le dossier de destination
				$name_file = $_FILES['ImageNews']['name'];
				if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
				{
				$objectErreur->initialiserErreur("Nom de fichier non valide",0);
				}
				
				//$taille_min=620;
				$donnees= getimagesize($tmp_file);
				$image = imagecreatefromjpeg($tmp_file);
				/*if ($donnees[0] > $donnees[1]) { //paysage
					$largeur_finale=round(($taille_min/$donnees[1])*$donnees[0]);
					$hauteur_finale=$taille_min;
				}
				else
				{//portrait
					$hauteur_finale=round(($taille_min/$donnees[0])*$donnees[1]);
					$largeur_finale=$taille_min;
				}
				
				$image_mini = imagecreatetruecolor($largeur_finale, $hauteur_finale); //création image finale
				imagecopyresampled($image_mini, $image, 0, 0, 0, 0, $largeur_finale, $hauteur_finale, $donnees[0], $donnees[1]);//copie avec redimensionnement
				*/
				$image_mini = imagecreatetruecolor(620,384 ); //création image finale
				imagecopyresampled($image_mini, $image, 0, 0, 0, 0, 620, 384, $donnees[0], $donnees[1]);//copie avec redimensionnement
				imagejpeg ($image_mini, $content_dir.$name_file);
				
				$objectBandeau = new myClassBandeau();
				$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file);
				
			}
			elseif( strstr($type_file, 'png')){
					
				// on copie le fichier dans le dossier de destination
				$name_file = $_FILES['ImageNews']['name'];
				if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
				{
				$objectErreur->initialiserErreur("Nom de fichier non valide",0);
				}
				
				//$taille_min=620;
				
				$donnees= getimagesize($tmp_file);
				$image = imagecreatefrompng($tmp_file);
				/*if ($donnees[0] > $donnees[1]) { //paysage
					$largeur_finale=round(($taille_min/$donnees[1])*$donnees[0]);
					$hauteur_finale=$taille_min;
				}
				else
				{//portrait
					$hauteur_finale=round(($taille_min/$donnees[0])*$donnees[1]);
					$largeur_finale=$taille_min;
				}
				*/
				$image_mini = imagecreatetruecolor(384, 620); //création image finale
				imagecopyresampled($image_mini, $image, 0, 0, 0, 0, 384, 620, $donnees[0], $donnees[1]);//copie avec redimensionnement
				imagepng ($image_mini, $content_dir.$name_file);
				
				$objectBandeau = new myClassBandeau();
				$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file);
				
			}
			elseif( strstr($type_file, 'gif')){
					
				// on copie le fichier dans le dossier de destination
				$name_file = $_FILES['ImageNews']['name'];
				if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
				{
				$objectErreur->initialiserErreur("Nom de fichier non valide",0);
				}
		
				$donnees= getimagesize($tmp_file);
				$image = imagecreatefromgif($tmp_file);
				
				$image_mini = imagecreatetruecolor(384, 620); //création image finale
				imagecopyresampled($image_mini, $image, 0, 0, 0, 0, 384, 620, $donnees[0], $donnees[1]);//copie avec redimensionnement
				imagegif ($image_mini, $content_dir.$name_file);
				
				$objectBandeau = new myClassBandeau();
				$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file);
				
			}
			else $objectErreur->initialiserErreur("Le fichier n'est pas une image",0);
	}
}
?>
		
<div class="text-left" href="#page">
<h3>Bandeaux<small> Ajouter des bandeaux</small></h3>
<br>
	<form action="AjouterBandeaux.php#bandeau"  enctype="multipart/form-data" method="POST" >
		<div>
			<div >
				<div class="input-group-addon">Titre</div>
				<input class="form-control" type="text" name="titreBandeau" value="<?php  if (isset($_POST["titreBandeau"])) echo $_POST["titreBandeau"]; ?>" placeholder="Saisir le titre du bandeau">
			</div>
		</div> 
		<br>	
		<div>
			<div class="input-group-addon">Description</div>
			<textarea  id="description" name="descriptionBandeau" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre description ici"><?php  if (isset($_POST["descriptionBandeau"])) echo $_POST["descriptionBandeau"]; ?></textarea>
		</div>
		<br>
		
		<div>
		<!--div class="input-group-addon">Uploader une image</div>
		<input name="fichier" size="30" type="file" /-->
		  <div class="input-group-addon">Upload image</div>
		  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
          <input type="file" name="ImageNews" id="image" />
		</div>
		<br>	
		
		<button type="submit" name="publier" class="btn btn-primary btn-block" >Publier</button>
	</form>
		
		
</div> 
       
 <?php include('footer.php'); ?> 