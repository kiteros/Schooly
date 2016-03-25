<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />
		<link rel="stylesheet" href="../style/styleAcceuil.css" />
        <title>Schooly</title>

    </head>

	<body>
		<div class="navigateur">
			<div class = "naviIndex">
				<nav>
					<ul>
						<li id="logo"><h2>LOGO</h2></li>
			            <li><a href="#">Blog</a></li>
			            <li><a href="#">Aide</a></li>
			            <li><a href="#">Site</a></li>
			            <li><a href="#">Conception</a></li>
			            <li class = "buttonConnectIndexBar">
			            	<form action="acceuil.php" method = "post">
			            		<input type="submit" value="Connexion" class="bCPetit" />
			            	</form>
			            </li>
			        </ul>
				</nav>
			</div>
		</div>
		<div class="partIndexInscr">
			<div class="couple">
				

				<div class="inscript">
					<div class="strike">
						<form action="../php/inscriptionBdd.php" method="post">
							<input type = "text" placeholder="Prenom (Nom d'utilisateur)" name="prenom"/><br/><br/>
							<input type = "text" placeholder="Nom" name="nom"/><br/><br/>
							<input type = "text" placeholder="Adresse email" name = "mail"/><br/><br/>
							<input type = "password" placeholder="Mot de passe" name="pass1"/><br/><br/>
							<input type = "password" placeholder="Retapez le mot de passe" name="pass2"/><br/><br/>
							<input type = "submit" value = "Inscription" class = "bCo" />
						</form>
					</div>
					<br/><br/>
				</div>
				<br/><br/>
				<h1> Inscription </h1>
				<h2> Inscrivez-vous et profitez des multiples fonctionnalités de Schooly </h2>
			</div>
		</div>
		
	</body>

</html>


