	<?php
		session_start();

		/*Connexion à la base de données*/
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=schooly;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
		if(isset($_POST['ly'])){
			$monLycee = $_POST['ly'];
			$pieces = explode("-", $monLycee);
			$idLycee = $pieces[0];
			$monLycee = $pieces[1];
			/*On va aussi enregistrer le lycée dans la base de données*/
			$addLyc = $bdd->prepare('UPDATE utilisateurs SET lycee = :lyc WHERE id = :idPers');

			$addLyc->execute(array(
				'lyc' => $monLycee,
				'idPers' => $_SESSION['id']
			));
		}
		

		$selectLyc = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = :id');

		$selectLyc->execute(array(
			'id' => $_SESSION['id']
		));

		$resultat = $selectLyc->fetch();

		$monLycee = $resultat['lycee'];

		/*Puis on va séléctionner l'id du Lycee de l'utilisateur*/
		$selectIdLyc = $bdd->prepare('SELECT id FROM lycee WHERE nom = :nomLycee');

		$selectIdLyc->execute(array(
			'nomLycee' => $monLycee
		));

		$resultatId = $selectIdLyc->fetch();
		$_SESSION['idLycee'] = $resultatId['id'];
		$idLycee = $resultatId['id'];

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
				<li><a href="#"><?php echo $monLycee; ?></a>
					<ul>
						<li><a href="#">Evennements</a></li>
						<li><a href="#">Classes</a></li>
						<li><a href="#">Statistiques</a></li>
						<li><a href="#">Propositions</a></li>
					</ul>
				</li>
				<li><a href="#">Classe</a>
					<ul>
						<li><a href="#">Fil d'actualité</a></li>
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

		<body>
			<br/>
			<?php 
				if(isset($_GET['click'])){
					?>
					<form action="menu.php" method="get">
						<input type="submit" value="retour aux niveaux" class="bCo"/>
					</form><br/>
					<?php
				}
			?>
			<h2> Choix de la classe </h2><br/>
			<?php
				/*On va afficher toutes les classes dispos*/	
				/*Connexion à la base de données*/
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=schooly;charset=utf8', 'root', '');
				}
				catch(Exception $e)
				{
					die('Erreur : '.$e->getMessage());
				}

				/*Mais avant tout, on affiche tout les niveaux dispos*/
				if(!isset($_GET['click'])){
					/*Ici aucun div n'a été clické*/
					$selectNiveau = $bdd->prepare('SELECT DISTINCT niveau FROM classe WHERE idLycee = :idLyc');

					$selectNiveau->execute(array(
						'idLyc' => $idLycee
					));
					$listLevels = array();
					echo '<hr/>';
					while ($donneesLevel = $selectNiveau->fetch())
					{
					/*On crée un array contenant tout les niveaux*/
						array_push($listLevels, $donneesLevel['niveau']);
						$classeNiveau= '';
						switch($donneesLevel['niveau']){
							case 0:
								$classeNiveau = 'Terminale';
								break;
							case 1 :
								$classeNiveau = 'Première';
								break;
							case 2 :
								$classeNiveau = 'Seconde';
								break;
							case 3 :
								$classeNiveau = 'Troisième';
								break;
							case 4 :
								$classeNiveau = 'Quatrième';
								break;
							case 5 :
								$classeNiveau = 'Cinquième';
								break;
							case 6 :
								$classeNiveau = 'Sixième';
								break;
						}
						?>
							
							<div class="niveau" onclick="location.href='?click=<?php echo $donneesLevel['niveau']; ?>'">
								<h2> <?php echo $classeNiveau; ?> </h2>
							</div>
							<hr/>
						<?php
						
					}
				}else{
					$niv = $_GET['click'];
					/*On selectionne les classes correspondantes dans la base de données*/
					$selectClasse = $bdd->prepare('SELECT * FROM classe WHERE idLycee = :idLyc AND niveau = :niv');

					$selectClasse->execute(array(
						'idLyc' => $idLycee,
						'niv' => $niv
					));

					$nbClasses = $selectClasse->rowCount();
					/*On affiche un message en fonction du résultat de la requete*/
					if($nbClasses == 0){
						$message = 'Aucune classe n\'a été trouvée pour cet établissement';
					}else if($nbClasses == 1){
						$message = $nbClasses . ' classe trouvée pour ' . $monLycee . '.' ;
					}else{
						$message = $nbClasses . ' classe trouvées pour ' . $monLycee . '.' ;
					}

					echo '<p>' . $message . '</p><br/><hr/><br/>';

					while ($donnees = $selectClasse->fetch())
					{
						echo '<h3> Classe ' . $donnees['classTag'] . ' de l\'établissement ' . $monLycee . ' ,avec ' . $donnees['nbPers'] . ' élèves</h3>';
						?>
								<br/>
								<form action="#" method="post">
									<input type="hidden" value="<?php echo $donnees['classTag'] ?> " name="classeRejoin" />
									<input type="submit" value="Rejoindre" name="joinClass" class="bC"/>
								</form>
								<br/><hr/><br/>
						<?php
					}
				}

				/*Ici l'utilisateur a choisit de s'inscrire dans une classe*/
				if(isset($_POST['classeRejoin'])){
					$UpClass = $_POST['classeRejoin'];
					/*On update la classe de l'utilisateur*/
					$UpClass = $bdd->prepare('UPDATE utilisateurs SET classe = :cl WHERE id = :idPers');

					$UpClassString = strval($UpClass);
					$UpClass->execute(array(
						'cl' =>  $UpClassString,
						'idPers' => $_SESSION['id']
					));
					/*Puis on ajoute sa classe dans une variable de session au cas ou*/
					$_SESSION['classe'] = $UpClass;
				}

				/*Ici on ajoute une classe*/
				if(isset($_POST['choseNiveau']) AND isset($_POST['ClassName'])){
					/*Ici le formulaire à bien été envoyé*/
					$addClas = $bdd->prepare('INSERT INTO `classe` (`id`, `idLycee`, `niveau`, `classTag`, `nbPers`) VALUES (NULL, :idLycee, :niveau, :className, :nbPersDefault)');

					$addClas->execute(array(
						'idLycee' => $idLycee,
						'niveau' => $_POST['choseNiveau'],
						'className' => $_POST['ClassName'],
						'nbPersDefault' => '0'
					));
				}

			?>

			<br/><br/>
			<h3> Votre classe ou votre niveau n'apparaît pas? Créez la tout de suite : </h3><br/>
			<form action="#" method="post">
				<select name="choseNiveau">
					<option value="0">Terminale</option>
					<option value="1">Première</option>
					<option value="2">Seconde</option>
					<option value="3">Troisème</option>
					<option value="4">Quatrième</option>
					<option value="5">Cinquième</option>
					<option value="6">Sixième</option>
				</select>
				<br/><br/>
				<input type="text" placeholder="Identifiant de votre classe (ex : 214)" name="ClassName" /><br/><br/>
				<input type="submit" value="Enregistrer" class="bCo" />
			</form>
		</body>
	</html>