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

	// Affichage du billet correspondant à l'ID
	$req = $bdd->prepare('SELECT titre, contenu, id,
		DATE_FORMAT(date_creation, \'%d/%m\') AS date_creation, 
		DATE_FORMAT(date_creation, \'%Hh%i\') AS heure_creation
		FROM billets WHERE id=?');
	$req->execute(array($_GET['id']));

	while ( $donnees= $req->fetch()) {
		echo '<div class="news">
				<h3>' . htmlspecialchars($donnees['titre']) . '<EM> le ' . htmlspecialchars($donnees['date_creation']) . ' à ' . htmlspecialchars($donnees['heure_creation']) . '</EM></h3>
				<p>' . htmlspecialchars($donnees['contenu']) .'</br></p>
			</div>
			</br>';
	}
	$req->closeCursor();
?>

	<p>COMMENTAIRES</p>

<?php
	// Affichage des commentaires correspondant à l'ID du billet
	$req = $bdd->prepare('SELECT auteur, commentaire,
		DATE_FORMAT(date_commentaire, \'%d/%m\') AS date_creation, 
		DATE_FORMAT(date_commentaire, \'%Hh%i\') AS heure_creation
		FROM commentaires WHERE id_billet=?');
	$req->execute(array($_GET['id']));

	while ( $donnees= $req->fetch()) {
		echo '
		<p><strong>'. htmlspecialchars($donnees['auteur']) .'</strong> le '. htmlspecialchars($donnees['date_creation']) .' à '. htmlspecialchars($donnees['heure_creation']) .'</br>
		'. htmlspecialchars($donnees['commentaire']) .'</p>
		';
	}
	$req->closeCursor();
?>
		
	</body>
</html>