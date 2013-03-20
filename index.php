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

	// Récupération des billets
	$bdd->query("SET NAMES 'utf8'");
	$reponse = $bdd->query('SELECT titre, contenu, id,
		DATE_FORMAT(date_creation, \'%d/%m à %Hh%imin\') AS date_creation
		FROM billets ORDER BY id DESC LIMIT 0, 10');

	//Affichage des billets
	while ( $donnees= $reponse->fetch()) 
	{
?>
	<div class="news">
		<h3>
			<?php echo htmlspecialchars($donnees['titre']); ?>
			<em> le <?php echo htmlspecialchars($donnees['date_creation']); ?></em>
		</h3>
		<p>
		<?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?>
		</br>
		<a href="commentaires.php?id=<?php echo $donnees['id']; ?>">Commentaires </a></p>
	</div>
	
<?php
	}
	$reponse->closeCursor();

?>
		
	</body>
</html>