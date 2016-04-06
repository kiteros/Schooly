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

	/*On va tenter de savoir si nameMailcontien un mail ou un nom grace au expressions régulières*/
	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $nameMail))
	{
		/*NameMail est un mail, on recherche donc un mail dans la Bdd*/
		$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = :prenom AND pass = :pass');

		$req->execute(array(
	    	'prenom' => $nameMail,
	    	'pass' => $pass
	    ));

		$resultat = $req->fetch();
	}
	else
	{
		/*Name Mail est un nom, on recherche don un nom dans la Bdd*/
		$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE prenom = :prenom AND pass = :pass');

		$req->execute(array(
	    	'prenom' => $nameMail,
	    	'pass' => $pass
	    ));

	    $resultat = $req->fetch();
	    

	}

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
		$_SESSION['monLycee'] = $resultat['lycee'];
		$_SESSION['classe'] = $resultat['classe'];

		if($resultat['lycee'] == 'inconnu'){
			header('Location: choixLycee.php');
		}else if($resultat['lycee'] != ''){
			header('Location: ../html/menuSession/filActu.php');
		}
		else{
			header('Location: ../html/menuSession/menu.php');
		}
		
    }
    /*On peut afficher la page de selection du lycée*/
    
?>