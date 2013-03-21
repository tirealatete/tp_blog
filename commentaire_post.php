<?php

try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
	}catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	if (($_POST['pseudo'] != "") AND ($_POST['message'] !='')) {
		$req = $bdd->prepare('INSERT INTO commentaires(auteur, commentaire, date_commentaire, id_billet) VALUES (:pseudo, :message, NOW(), :id)');
		$req->execute(array(
			'pseudo' => $_POST['pseudo'],
			'message' => $_POST['message'],
			'id' => $_GET['id']
		));
		//$id=$_GET['id'];
		$req->closeCursor();

	// Puis rediriger vers commentaires.php comme ceci :
	header('Location: commentaires.php?id='.$_GET['id']);
		
	} else {
		echo 'Remplissez les 2 champs';
	}


?>