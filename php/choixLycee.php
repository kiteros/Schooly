	<?php
		session_start();
	?>

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
				        </ul>
					</nav>
					
				</div>
				
				<?php
					if(isset($_SESSION['prenom'])){
						$pren = $_SESSION['prenom'];
					}else{
						header('Location : ../html/acceuil?error=wrongMdp');
						$pren = 'erreur';

					}
				?>

				<div id="menuCompte">
					<ul id="menu-demo2">
						<li><a href="#"><?php echo $pren ?></a>
							<ul>
								<li><a href="#" onclick='document.getElementById("deconnect").submit()'>Deconnexion</a></li>
								<li><a href="#">Report de problème</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<hr/>
			<div class="partChoixLycee">
				<p>&nbsp;</p>
				<form action="../html/acceuil.php" method="post" id="deconnect">
					<input type="hidden" value="deco" />
					<input type="submit" value="Déconnexion" class="bCo"/>
				</form>
				<div class="carte">
					
					<div id="cmap"></div>
					<script type="text/javascript" src="../cmap/France.js"></script>
					<script type="text/javascript" src="../cmap/cmap.js"></script>

				</div>
				<div id="tip"> </div>

			</div>
			
			<div class="lycee">
				<?php
					/*Fonction qui selectionne le lycee en fonction de son nom*/
					function select($regionLycee){
						/*Connexion à la base de données pour récupérer le lycee*/
						try
						{
							$bdd = new PDO('mysql:host=localhost;dbname=schooly;charset=utf8', 'root', '');
						}
						catch(Exception $e)
						{
						    die('Erreur : '.$e->getMessage());
						}

						/*On récupère tout les lycées de la région sous forme de select*/

						$selectLy = $bdd->prepare('SELECT * FROM lycee WHERE region = :region');

						$selectLy->execute(array(
							'region' => $regionLycee
						));

						$nbLycees = $selectLy->rowCount();

						if($nbLycees == 0){

							$arrayLycee = 'aucun lycée trouvé';

						}else{

							$arrayLycee = 'Choisissez votre lycée : <br/><br/><form action="../html/menuSession/menu.php" method="post" ><select name="ly">';

							while ($donnees = $selectLy->fetch())
							{
								$arrayLycee = $arrayLycee . '<option value = "' . $donnees['id'] . '-' . $donnees['nom'] . '">' . $donnees['nom'] . '</option>';
							}
							$arrayLycee = $arrayLycee . '<select/><br/><br/><input type="submit" value = "valider" class="bC" /></form>';

						}

						return $arrayLycee . '<br/><br/>';
					}

					if(isset($_GET['region'])){
						switch($_GET['region']){
							case 'a' : 
								echo select('a');
								break;
							case 'b' :
								echo select('b');
								break;
							case 'c' :
								echo select('c');
								break;
							case 'd' :
								echo select('d');
								break;
							case 'e' :
								echo select('e');
								break;
							case 'f' :
								echo select('f');
								break;
							case 'g' :
								echo select('g');
								break;
							case 'h' :
								echo select('h');
								break;
							case 'i' :
								echo select('i');
								break;
							case 'j' :
								echo select('j');
								break;
							case 'k' :
								echo select('k');
								break;
							case 'l' :
								echo select('l');
								break;
							case 'm' :
								echo select('m');
								break;
						}
					}

					if(isset($_POST['choseLycee']) AND isset($_POST['Sname'])){
						/*L'utilisateur veux enregistrer son lycée*/
						/*Connexion à la base de données*/
						try
						{
							$bdd = new PDO('mysql:host=localhost;dbname=schooly;charset=utf8', 'root', '');
						}
						catch(Exception $e)
						{
						    die('Erreur : '.$e->getMessage());
						}

						$addLycee = $bdd->prepare('INSERT INTO `lycee` (`id`, `region`, `nom`) VALUES (NULL, :region, :nom)');

						$addLycee->execute(array(
							'region' => $_POST['choseLycee'],
							'nom' => $_POST['Sname']
						));
					}

				?>
				<h4> Votre établissement n'apparaît pas? Ajoutez votre établissement :</h4><br/>
				<form action="#" method="post">
					<select name="choseLycee">
						<option value="a">Alsace-Champagne-Ardenne-Lorraine</option>
						<option value="b">Aquitaine-Limousin-Poitou-Charentes</option>
						<option value="c">Auvergne-Rhône-Alpes</option>
						<option value="d">Bourgogne-Franche-Comté</option>
						<option value="e">Bretagne</option>
						<option value="f">Centre</option>
						<option value="g">Corse</option>
						<option value="h">Languedoc-Roussillon-Midi-Pyrénées</option>
						<option value="i">Ile-de-France</option>
						<option value="j">Nord-Pas-de-Calais-Picardie</option>
						<option value="k">Normandie</option>
						<option value="l">Pays-de-la-Loire</option>
						<option value="m">Provence-Alpes-Côte-d'Azur</option>
					</select>
					<br/><br/>
					<input type="text" placeholder="nom du lycee" name="Sname" /><br/><br/>
					<input type="submit" value="Valider" class="bC"/>
				</form>

			</div>
		</body>
	</html>