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
			            	<form action="inscription.php" method = "post">
			            		<input type="submit" value="Inscription" class="bCoPetit" />
			            	</form>
			            </li>
			            <li class="nbInscriptions">
			            	<?php include('../php/comptage personnes.php') ?>
			            </li>
			        </ul>
				</nav>
			</div>
		</div>

		<?php
	   		if(isset($_GET['error']) && $_GET['error'] == "wrongMdp"){
	   			?>
	   				<!--Affichage du message d'erreur si le mot de passe ne correspond pas-->
	   				<script>
	   					swal({
	   						title: "Mauvais mot de passe",
	   						text: "Veuillez vérifier ce que vous avez entré",
	   						type: "error",
	   						confirmButtonText: "Ok"
	   					});
	   				</script>
	   			<?php
	   		}
	   	?>

		<div class="partIndex1">
			<div class="couple">
				<div class="connect">
					<div class="strike">
						<form action="../php/connexion.php" method="post">
							<input type = "text" placeholder="Nom d'utilisateur ou adresse email" name="emailMdp"/><br/><br/>
							<input type = "password" placeholder="Mot de passe" name="pass"/><br/><br/>
							<input type = "submit" value = "Connexion" class = "bC"/>
						</form>
					</div>
					<br/><br/>
				</div>
				<h1> Schooly, le nec plus ultra des études collectives </h1>
				<h2> Schooly est un site gratuit et facile d'accès permettant de gérer la vie d'une classe.
				Il vous permet d'intéragir et de partager avec votre classe pour faciliter votre travail </h2>
			</div>
		</div>
	</body>

</html>


