<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<title>Mon super Blog</title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
	</br>
		<a href="index.php">Retour à la liste des billets</a></br></br>
		
<?php
	// Connexion à la base
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
	}	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	$bdd->query("SET NAMES 'utf8'");

	$req = $bdd->prepare('SELECT titre, contenu, id,
		DATE_FORMAT(date_creation, \'%d/%m à %Hh%imin\') AS date_creation
		FROM billets WHERE id=?');
	$req->execute(array($_GET['id']));

	$donnees_billet= $req->fetch();
	if (!empty($donnees_billet)) {
?>
	<div class="news">
		<?php include("billet.php"); ?></br> <!-- Affichage du billet -->
	</div>
	<?php include("commentaire.php"); ?>  <!-- Affichage de la zone commentaires -->
<?php	
	} else {
?>
	<div class="news">
			Ce billet n'existe pas
	</div>
<?php
	}
	$req->closeCursor();
?>

	</body>
</html>