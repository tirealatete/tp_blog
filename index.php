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
		<h1>Mon super blog</h1>
		</br>
		<p>Derniers billets du blog :</p>
		
<?php
	// Connexion à la base
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
	} catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	$bdd->query("SET NAMES 'utf8'");
	$reponse = $bdd->query('SELECT titre, contenu, id,
		DATE_FORMAT(date_creation, \'%d/%m\') AS date_creation, 
		DATE_FORMAT(date_creation, \'%Hh%i\') AS heure_creation
		FROM billets ORDER BY id DESC LIMIT 0, 10');

	while ( $donnees= $reponse->fetch()) {
		echo '<div class="news"><h3>' . htmlspecialchars($donnees['titre']) . '<EM> le ' . htmlspecialchars($donnees['date_creation']) . ' à ' . htmlspecialchars($donnees['heure_creation']) . '</EM></h3>
		<p>' . nl2br($donnees['contenu']) .'</br>
		<a href="commentaires.php?id='. $donnees['id'] .'">Commentaires </a></p></div></br>';
	}

	$reponse->closeCursor();

?>
		
	</body>
</html>