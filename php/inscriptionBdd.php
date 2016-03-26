<?php
	/*Connexion à la base de données*/
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=schooly;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
        die('Erreur : '.$e->getMessage());
	}

	$prenom = $_POST['prenom'];
	$nom = $_POST['nom'];
	$mail = $_POST['mail'];
	$password = $_POST['pass1'];
	$password2 = $_POST['pass2'];

	/*On vérifie d'abord que les données envoyées sont correctes*/

	if($password != $password2){
		/*Ici les mots de passes sont différents*/
		header('Location: ../html/inscription.php?error=MdpUnsame');

	}
	else{

		/*On peut broyer le mot de passe pour le rendre indéchiffrable*/

		$password = sha1($password);

		/*Puis on vérifie qu'un compte d'existe pas déjà*/

		$verif = $bdd->prepare('SELECT * FROM utilisateurs WHERE nom = :nom AND email = :mail');

		$verif->execute(array(
			'nom' => $nom,
			'mail' => $mail
		));
		$nbOccur = $verif->rowCount();

		if($nbOccur > 0){
			/*Le compte existe déja, retour au menu avec une erreur*/
			header('Location: ../html/inscription.php?error=CompteExistant');

		}
		else{

			/*On ajoute toutes les coordonnées de l'utilisateur dans la base de données utilisateur*/

			$addCompte = $bdd->prepare('INSERT INTO `utilisateurs` (`id`, `prenom`, `nom`, `pass`, `email`, `enregistrement`) VALUES (NULL, :prenom, :nom, :mdp, :mail, CURRENT_DATE())');

			$addCompte->execute(array(
				'prenom' => $prenom,
				'nom' => $nom,
				'mdp' => $password,
				'mail' => $mail
			));
			/*La personne est inscrite dans la base de donnéees, on peut la connecter automatiquement*/

			/*On va donc selectionner son ID dans la Bdd*/
			$selectIdPers = $bdd->prepare('SELECT id FROM utilisateurs WHERE nom = :name AND email = :mail');
			$selectIdPers->execute(array(
	    		'name' => $nom,
	    		'mail' => $mail
	    	));

			/*On fetch le résultat de la requete*/

			$resultat = $selectIdPers->fetch();

	    	/*Puis on créeer une variable de session*/
			session_start();
			$_SESSION['id'] = $resultat['id'];
			$_SESSION['nom'] = $nom;
			$_SESSION['mail'] = $mail;
			$_SESSION['prenom'] = $prenom;
		}

		

	}
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
		</div>
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
				
				header('Location: acceuil.php');
				session_destroy();
				
			}
		?>
		<form action="#" method="post">
			<input type="hidden" value="deco" />
			<input type="submit" value="Déconnexion" />
		</form>
	</body>

</html>