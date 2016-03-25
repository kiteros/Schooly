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

	echo $prenom . $nom . $mail . $password;

	/*On ajoute toutes les coordonnées de l'utilisateur dans la base de données utilisateur
	$addCompte = $bdd->prepare('INSERT INTO `utilisateurs` (`id`, `prenom`, `nom`, `pass`, `email`, `enregistrement`) VALUES (NULL, :prenom, :nom, :mdp, :mail, CURRENT_DATE()');

	$addCompte->execute(array(
		'prenom' => $prenom,
		'nom' => $nom,
		'mdp' => $password,
		'mail' => $mail
	));
	*/

	$addCompte = $bdd->prepare('INSERT INTO `utilisateurs` (`prenom`) VALUES (:prenom');

	$addCompte->execute(array(
		'prenom' => 'julo'
	)); 
?>