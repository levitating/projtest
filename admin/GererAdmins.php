 <?php 

include('load.php');
include('../inc/administrateurs.php');


if (isset($_GET["role"])) $myRole = $_GET["role"]; else  $myRole = ""; 
if (isset($_POST['submitGestion']))
{
	$objectErreur = new myClassErreur();
	$roleAdmin = mysql_real_escape_string($_POST['roleAdmin']);
	
	if ($roleAdmin == "choix") 
	{
		$objectErreur->initialiserErreur("Veuillez choisir un role." , 0);
	}
	else
	{
		$requeteAction = Mysql_query(" SELECT * FROM Les_actions  ");
		$ok=0;
		
		
		if (isset($_POST['ALL']))
		{
		$testRequetteAll = Mysql_query(" SELECT * FROM role WHERE type_admin_role='$roleAdmin' AND  action_role='ALL' ") or die(mysql_error());
		if (mysql_num_rows($testRequetteAll) == 0)
			{
						$deleteAction = Mysql_query ("DELETE FROM role WHERE type_admin_role='$roleAdmin'") or die(mysql_error());
						$insertAction = Mysql_query ("INSERT INTO role (type_admin_role, action_role) VALUES ('$roleAdmin', 'ALL')") or die(mysql_error());	
						if($insertAction) $ok=1; else $ok=0;
			} 
			else 
			{
			$deleteAction = Mysql_query ("DELETE FROM role WHERE type_admin_role='$roleAdmin' AND  action_role <> 'ALL' ") or die(mysql_error());
			$ok=1;
			}
		} 
		else
		{
			$insertAction = Mysql_query("DELETE FROM role WHERE  type_admin_role='$roleAdmin' AND  action_role='ALL'") or die(mysql_error());
			while( $getAction = Mysql_fetch_array($requeteAction))
			{
				$nomAction = $getAction['nom_action'];
				if (isset($_POST[$nomAction])) 
				{
					
					
					$testActionExist = Mysql_query(" SELECT * FROM role WHERE type_admin_role='$roleAdmin' AND  action_role='$nomAction' ") or die(mysql_error());
					if (mysql_num_rows($testActionExist) == 0)
					{
						$insertAction = Mysql_query(" INSERT INTO role (type_admin_role, action_role) VALUES ('$roleAdmin', '$nomAction') ") or die(mysql_error());	
						if($insertAction) $ok=1; else $ok=0;
					}
				}
				else
				{
					$testActionExist = Mysql_query(" SELECT * FROM role WHERE type_admin_role='$roleAdmin' AND  action_role='$nomAction' ") or die(mysql_error());
					if (mysql_num_rows($testActionExist) <> 0)
					{
						$insertAction = Mysql_query("DELETE FROM role WHERE  type_admin_role='$roleAdmin' AND  action_role='$nomAction'") or die(mysql_error());	
						if($insertAction) $ok=1; else $ok=0;
					}
				}
			}
		}
		
		
		if($ok) 
		{
			$objectErreur->initialiserErreur("Les roles sont modifées." , 1);
		}
		else $objectErreur->initialiserErreur("Veuillez selectionner au moin une action." , 0);
	}

}

 ?> 
 


		
<div class="text-left" href="#page">
		<h3>Gestion des administrateurs</h3> 
		<br>

		<form action="GererAdmins.php#admin" name="myform" method="POST" >
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Les Roles</label>
			<select name='roleAdmin' class="form-control" onchange="window.location.replace('GererAdmins.php?role='+this.value+'#admin');">
			<option <?php if ($myRole == "choix") echo "selected"; ?> value='choix'>Choisir un role</option>
			<?php 
            
			$requeteRole=Mysql_query("SELECT * FROM les_roles ")or die(mysql_error());
			while( $getRole=Mysql_fetch_array($requeteRole))
			{
			   $nomRole=$getRole['nom_role'];
			   if (($_POST["roleAdmin"] == $nomRole) or ($myRole == $nomRole)) $selected="selected"; else $selected="";
			   if ($nomRole != "super administrateur") 
			   echo "<option ".$selected." value='".$nomRole."' >".$nomRole."</option>";
			}
			
            ?>

			 
			</select>
		</div>
		
		<!--     selectionner toute les actions avc javascript ;)     -->
		 

		<div class="checkbox">
			<label>
			<?php
			   $requeteCheckAll = Mysql_query("SELECT * FROM role WHERE type_admin_role='$myRole' AND  action_role='ALL' ") or die(mysql_error());
			   if ((mysql_num_rows($requeteCheckAll) != 0) or isset($_POST["ALL"]))  $checkedAll = "checked"; else $checkedAll = "";
			   ?>
			<input id="selectall" <?php echo $checkedAll; ?> class="unall" type="checkbox" onclick="$('.second').prop('checked',$('#selectall').prop('checked'));" name="ALL"   value="ALL">
			Toute les actions
			</label>
		</div>
		
		<hr>
<?php 
        $requeteAction=Mysql_query("SELECT * FROM Les_actions ORDER BY groupe_action ASC")or die(mysql_error());
		$javaCode="";
		while( $getAction=Mysql_fetch_array($requeteAction))
		{
			    
			   $idAction=$getAction['id_action'];
			   $nomAction=$getAction['nom_action'];
			   $afficherAction=$getAction['afficher_action'];
			   $groupeAction=$getAction['groupe_action'];
			   
			   $javaCode = $javaCode.' var '.$nomAction.' = $("#checkboxlive'.$idAction.'").is(":checked"); 
						if ('.$nomAction.' == false) $("input[name=ALL]").attr("checked", false);';
			   
			   
			   $requeteCheck=Mysql_query("SELECT * FROM role WHERE type_admin_role='$myRole' AND  (action_role='$nomAction' OR action_role='ALL' ) ") or die(mysql_error());
			   if ((mysql_num_rows($requeteCheck) != 0) or isset($_POST[$nomAction]))  $checked = "checked"; else $checked="";
			   
?>

			
		
		<div class="checkbox">
			<label>
			<input type="checkbox" class="second" onclick="$('#selectall').prop('checked',$('#checkboxlive<?php echo $idAction;?>').prop('checked')); uncheckall();" id="checkboxlive<?php echo $idAction;?>" <?php echo $checked; ?> name="<?php echo $nomAction;?>" value="<?php echo $nomAction; ?>">
			<?php echo $afficherAction; ?>
			</label>
		</div>
		<?php
		}
		?>
				<br>
		<button type="submit" name="submitGestion" class="btn btn-primary btn-block" >Ajouter roles</button>
		
		</form>
		<script>
		$(document).ready(function(){
			//$('.second').prop('checked',$('#selectall').prop('checked'));
			
		});
		
		uncheckall();
		 
		function uncheckall() {
		<?php echo $javaCode; ?>
		}
		</script>
		
</div> 
   
 <?php include('footer.php'); ?> 