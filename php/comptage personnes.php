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

	/*On va compte le nombre d'utilisateurs inscrits pour l'afficher dans le menu*/
	$comptage_utilisateurs = $bdd->prepare('SELECT * FROM utilisateurs');
	$comptage_utilisateurs->execute(array());
	$nbPersonnes = $comptage_utilisateurs->rowCount();

	echo '<p>' . $nbPersonnes . ' persones inscrites</p>';

?>