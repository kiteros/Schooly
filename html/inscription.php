<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />
		<link rel="stylesheet" href="../style/styleAcceuil.css" />
		<link rel="stylesheet" type="text/css" href="../style/sweetalert.css">
        <title>Schooly</title>

    </head>

    <!--Scripts Jquery, sweetAlert, et plus -->
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="assets/js/jquery.complexify.js"></script>
	<script src="assets/js/script.js"></script>
	<script src="../scripts/dist/sweetalert.min.js"></script>
	<!--/////////////////////////////////-->

   	

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
		<!--gestion des erreurs d'inscription -->
	   	<?php
	   		if(isset($_GET['error']) && $_GET['error'] == "MdpUnsame"){
	   			?>
	   				<!--Affichage du message d'erreur si les mots de passes sont différents-->
	   				<script>
	   					swal({
	   						title: "Les mots de passe ne correspondent pas",
	   						text: "Veuillez réesayer, ou vérifier ce que vous avez rempli",
	   						type: "error",
	   						confirmButtonText: "Ok"
	   					});
	   				</script>
	   			<?php
	   		}
	   	?>
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


