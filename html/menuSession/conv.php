	<?php
		session_start();
	?>

	<!DOCTYPE html>

	<html>

	    <head>

	        <meta charset="utf-8" />
			<link rel="stylesheet" href="../../style/styleMenu.css" />
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

	        <title>Schooly</title>
	    </head>

	    <header>
	    	<ul id="menu-demo2">
				<li><a href="#"><?php echo $_SESSION['monLycee']; ?></a>
					<ul>
						<li><a href="#">Evennements</a></li>
						<li><a href="menu.php">Classes</a></li>
						<li><a href="#">Statistiques</a></li>
						<li><a href="#">Propositions</a></li>
					</ul>
				</li>
				<li><a href="#">Classe</a>
					<ul>
						<li><a href="filActu.php">Fil d'actualité</a></li>
						<li><a href="#">Partage</a></li>
						<li><a href="#">Conversations</a></li>
						<li><a href="#">Contrôles</a></li>
						<li><a href="#">Notes</a></li>
						<li><a href="#">Classements</a></li>
					</ul>
				</li>
				<li id="meC"><a href="#"><?php echo $_SESSION['prenom']; ?></a>
					<ul>
						<li><a href="#" onclick='document.getElementById("deconnect").submit()'>Déconnexion</a></li>
						<li><a href="#">Gestion du compte</a></li>
					</ul>
				</li>
			</ul>

	    </header>
	    <form action="../../html/acceuil.php" method="post" id="deconnect">
			<input type="hidden" value="deco" />
			<input type="submit"/>
		</form>
		<script>
			$(document).ready(function() {
				$('a.poplight[href^=#]').click(function() {
					var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
					var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

					//Récupérer les variables depuis le lien
					var query= popURL.split('?');
					var dim= query[1].split('&amp;');
					var popWidth = dim[0].split('=')[1]; //La première valeur du lien

					//Faire apparaitre la pop-up et ajouter le bouton de fermeture
					$('#' + popID).fadeIn().css({
						'width': Number(popWidth)
					})
					.prepend('<a href="#" class="close"><img src="../../style/images/closepop.png" class="btn_close" title="Fermer" alt="Fermer" /></a>');

					//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
					var popMargTop = ($('#' + popID).height() + 80) / 2;
					var popMargLeft = ($('#' + popID).width() + 80) / 2;

					//On affecte le margin
					$('#' + popID).css({
						'margin-top' : -popMargTop,
						'margin-left' : -popMargLeft
					});

					//Effet fade-in du fond opaque
					$('body').append('<div id="fade"></div>'); //Ajout du fond opaque noir
					//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
					$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

					return false;
				});

				//Fermeture de la pop-up et du fond
				$('a.close, #fade').live('click', function() { //Au clic sur le bouton ou sur le calque...
					$('#fade , .popup_block').fadeOut(function() {
						$('#fade, a.close').remove();  //...ils disparaissent ensemble
					});
					return false;
				});
			});
		</script>

		<body>
			<br/><h2>Conversations</h2><br/><br/>
			<!--pop up-->
			<div class="addConv" />
				<a href="#?w=500" rel="popup_name" class="poplight"><img src="../../style/images/add.png" width="250px" height="250px" class="btn_ouvrir" title="ajouter" alt="ajouter"  /></a>
			</div>	

		</body>

		<div id="popup_name" class="popup_block">
			<br/><h2> Ajout de conversation </h2><br/>
			<form action = "#" method="post">
				<input type="text" placeholder="sujet" /><br/><br/>
				<select name="portee">
					<option value="classe">Pour toute la classe</option>
					<option value="lycee">Pour tout le lycée</option>
				</select><br/><br/>
				<input type="submit" value="Ajouter" class="bCsmall" /><br/>
			</form>
		</div>

	</html>s