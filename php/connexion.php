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

	$pass= sha1($_POST['pass']);
	$nameMail = $_POST['emailMdp'];

	$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE prenom = :prenom OR email = :prenom AND mdp = :pass');
	$req->execute(array(
    	'prenom' => $nameMail,
    	'pass' => $pass
    ));

    $resultat = $req->fetch();

    if(!$resultat){
    	header('Location: ../html/acceuil.php?error=wrongMdp');
    }
    else
    {
    	session_start();
        $_SESSION['id'] = $resultat['id'];
		$_SESSION['nom'] = $resultat['nom'];
		$_SESSION['mail'] = $resultat['email'];
		$_SESSION['prenom'] = $resultat['prenom'];
    	header('Location: ../html/choixLycee.php');
    }

?>