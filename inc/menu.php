<?php 

class myClassMenuAdministration
{

function menuAdminActualite()
{

							$myRole = $_SESSION["ROLE_USER"];
							$getActions=mysql_query(" SELECT * FROM role WHERE type_admin_role = '$myRole' AND action_role = 'ALL' ") or die(mysql_error());
							if (mysql_num_rows($getActions) != 0)
							echo 	'<li id="actualite" class="files">
									<a href="#actualite">Actualités</a>
									<ul class="sub-menu">
									<li><a href="AjouterPosts.php#actualite"><em></em>Ajouter actualités</a></li>
									<li><a href="AfficherPosts.php#actualite"><em></em>Afficher actualités</a></li>
									<li><a href="Categories.php#actualite"><em></em>Catégories</a></li>
									<li><a href="CorbeillePosts.php#actualite"><em></em>Corbeille</a></li>
									</ul></li>';
									
							else
							{
								$getActions = mysql_query("SELECT * FROM les_actions WHERE  groupe_action = 'Actualités' AND ordre_affichage <> 0 AND nom_action IN (SELECT action_role FROM role WHERE type_admin_role = '$myRole') ORDER BY ordre_affichage ASC") or die(mysql_error());
								if (mysql_num_rows($getActions) != 0)
								{
									echo 	'<li id="actualite" class="files">
											<a href="#actualite">Actualités</a>
											<ul class="sub-menu">';
									while ($row = mysql_fetch_array($getActions))
									{
										$ActionsURL = $row['nom_action'];
										$ActionsAffichage = $row['afficher_menu'];
										echo '<li><a href="'.$ActionsURL.'.php#actualite"><em></em>'.$ActionsAffichage.'</a></li>';
									}
									echo '</ul></li>';
								}
							}


}

function menuAdminPage()
{

							$myRole = $_SESSION["ROLE_USER"];
							$getActions=mysql_query(" SELECT * FROM role WHERE type_admin_role = '$myRole' AND action_role = 'ALL' ") or die(mysql_error());
							if (mysql_num_rows($getActions) != 0)
							echo 	'<li id="page" class="mail">
									<a href="#page">Pages</a>
									<ul class="sub-menu">
									<li><a href="AjouterPages.php#page"><em></em>Ajouter page</a></li>
									<li><a href="AfficherPages.php#page"><em></em>Afficher pages</a></li>
									<li><a href="CorbeillePages.php#page"><em></em>Corbeille</a></li>
									</ul></li>';
									
							else
							{
								$getActions = mysql_query("SELECT * FROM les_actions WHERE  groupe_action = 'Pages' AND ordre_affichage <> 0 AND nom_action IN (SELECT action_role FROM role WHERE type_admin_role = '$myRole') ORDER BY ordre_affichage ASC") or die(mysql_error());
								if (mysql_num_rows($getActions) != 0)
								{
									echo 	'<li id="page" class="mail">
											<a href="#page">Pages</a>
											<ul class="sub-menu">';
									while ($row = mysql_fetch_array($getActions))
									{
										$ActionsURL = $row['nom_action'];
										$ActionsAffichage = $row['afficher_menu'];
										echo '<li><a href="'.$ActionsURL.'.php#page"><em></em>'.$ActionsAffichage.'</a></li>';
									}
									echo '</ul></li>';
								}
							}


}


function menuAdminBandeaux()
{

							$myRole = $_SESSION["ROLE_USER"];
							$getActions=mysql_query(" SELECT * FROM role WHERE type_admin_role = '$myRole' AND action_role = 'ALL' ") or die(mysql_error());
							if (mysql_num_rows($getActions) != 0)
							echo 	'<li id="bandeau" class="cloud">
									<a href="#bandeau">Bandeau</a>
									<ul class="sub-menu">
										<li><a href="AjouterBandeaux.php#bandeau"><em></em>Ajouter bandeaux</a></li>
										<li><a href="AfficherBandeaux.php#bandeau"><em></em>Afficher les beandeaux</a></li>	
									</ul>
									</li>';
									
							else
							{
								$getActions = mysql_query("SELECT * FROM les_actions WHERE  groupe_action = 'Bandeaux' AND ordre_affichage <> 0 AND nom_action IN (SELECT action_role FROM role WHERE type_admin_role = '$myRole') ORDER BY ordre_affichage ASC") or die(mysql_error());
								if (mysql_num_rows($getActions) != 0)
								{
									echo 	'<li id="bandeau" class="cloud">
											<a href="#bandeau">Bandeau</a>
											<ul class="sub-menu">';
									while ($row = mysql_fetch_array($getActions))
									{
										$ActionsURL = $row['nom_action'];
										$ActionsAffichage = $row['afficher_menu'];
										echo '<li><a href="'.$ActionsURL.'.php#bandeau"><em></em>'.$ActionsAffichage.'</a></li>';
									}
									echo '</ul></li>';
								}
							}


}

function menuAdminMedia()
{

							$myRole = $_SESSION["ROLE_USER"];
							$getActions=mysql_query(" SELECT * FROM role WHERE type_admin_role = '$myRole' AND action_role = 'ALL' OR action_role = 'GestionMedia'  ") or die(mysql_error());
							if (mysql_num_rows($getActions) != 0)
							echo 	'<li id="media" class="files">
									<a href="GestionMedia.php#media">Media</a>	
									</li>';
									
						


}

function menuAdminAdmins()
{

							$myRole = $_SESSION["ROLE_USER"];
							$getActions=mysql_query(" SELECT * FROM role WHERE type_admin_role = '$myRole' AND action_role = 'ALL' ") or die(mysql_error());
							if (mysql_num_rows($getActions) != 0)
							echo 	'<li id="admin" class="cloud">
									<a href="#admin">Administrateurs</a>
									<ul class="sub-menu">
									<li><a href="AjouterAdmins.php#admin"><em></em>Ajouter un admin</a></li>
									<li><a href="AfficherAdmins.php#admin"><em></em>Afficher les admins</a></li>
									<li><a href="GererAdmins.php#admin"><em></em>Gestions des droits</a></li>	
									</ul>
									</li>';
										
							else
							{
								$getActions = mysql_query("SELECT * FROM les_actions WHERE  groupe_action = 'Administrateurs' AND ordre_affichage <> 0 AND nom_action IN (SELECT action_role FROM role WHERE type_admin_role = '$myRole') ORDER BY ordre_affichage ASC") or die(mysql_error());
								if (mysql_num_rows($getActions) != 0)
								{
									echo 	'<li id="admin" class="cloud">
											<a href="#admin">Administrateurs</a>
											<ul class="sub-menu">';
									while ($row = mysql_fetch_array($getActions))
									{
										$ActionsURL = $row['nom_action'];
										$ActionsAffichage = $row['afficher_menu'];
										echo '<li><a href="'.$ActionsURL.'.php#admin"><em></em>'.$ActionsAffichage.'</a></li>';
									}
									echo '</ul></li>';
								}
							}


}


}

 ?>