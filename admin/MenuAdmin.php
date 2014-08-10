  <?php    
include('../inc/menu.php');
$objectMenu = new myClassMenuAdministration();

 ?> 


	<div id="wrapper-200a">
		<ul class="accordion">
			
			<li id="panneau" class="files">
					<a href="index.php">Panneau</a>	
			</li>
			
			
						<?php 
							//menu actualité
							$objectMenu->menuAdminActualite();
							
							//menu page
							$objectMenu->menuAdminPage();
							
							//menu Media
							$objectMenu->menuAdminMedia();
							
							//menu Admins
							$objectMenu->menuAdminBandeaux();
							
							//menu Admins
							$objectMenu->menuAdminAdmins();
						?> 
						
				
			
		
			
			
			
			<!--li id="menu" class="cloud">
					<a href="#menu">Menu</a>
					<ul class="sub-menu">
						<li><a href="#"><em></em>Ajouter Menu</a></li>
						<li><a href="#"><em></em>Structurer Menu</a></li>
					</ul>

			</li>
			
			<li id="annuaire" class="cloud">
					<a href="#annuaire">Annuaire</a>
					<ul class="sub-menu">
						<li><a href="#"><em></em>Accepter/refuser</a></li>
						<li><a href="#"><em></em>Options</a></li>
						
					</ul>
			</li>
		
			
			<li id="bandeau" class="cloud">
					<a href="#bandeau">Bandeau</a>
					<ul class="sub-menu">
						<li><a href="#"><em></em>Accepter / Supprimer</a></li>
						<li><a href="#"><em></em>Afficher les beandeaux</a></li>	
					</ul>
			</li-->
			
			<li id="deconnecter" class="sign">
				<a href="deconnexion.php">déconnecter</a>	
			</li>
			
			
		</ul>
	</div>

		