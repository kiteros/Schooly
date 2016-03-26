	
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
			        </ul>
				</nav>
			</div>
		</div>
		<hr/>
		<div class="partChoixLycee">

			<?php
				if(isset($_SESSION['id']) AND isset($_SESSION['prenom'])){
					/*Ici la personne est vraiment connectée*/
					echo "<p> Connecté en tant que " . $_SESSION['prenom'] ."</p>";

				}
				else{
					/*Ici la persnne n'est pas correctement connectée*/
					echo "<p> Un erreur d'authentification est survenue </p>";
				}

				/*Si le bouton decconection est préssé*/
				if(isset($_POST['deco'])){
					session_destroy();
					header('Location: acceuil.php');
							
				}
			?>
		
			<form action="#" method="post">
				<input type="hidden" value="deco" />
				<input type="submit" value="Déconnexion" />
			</form>
			<iframe src="../franceMap.html" width="50%" height="50%"></iframe> 
		</div>
	</body>