	<?php
		session_start();
	?>

	<!DOCTYPE html>

	<html>

	    <head>

	        <meta charset="utf-8" />
			<link rel="stylesheet" href="../../style/styleMenu.css" />
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
						<li><a href="#">Fil d'actualité</a></li>
						<li><a href="#">Partage</a></li>
						<li><a href="conv.php">Conversations</a></li>
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

		<body>
			<h2>Fil d'actualité de <?php echo $_SESSION['classe']; ?></h2>
		</body>
	</html>