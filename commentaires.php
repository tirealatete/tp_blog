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
		DATE_FORMAT(date_creation, \'%d/%m à %Hh%imin\') AS date_creation
		FROM billets WHERE id=?');
	$req->execute(array($_GET['id']));

	$donnees_billet= $req->fetch();
?>
	<div class="news">
		Numero du billet : <?php echo $donnees_billet['id']; ?>
		<?php include("billet.php"); ?></br>
	</div>
<?php
	$req->closeCursor();
?>

	<p>COMMENTAIRES</p>

	
<?php
	// Affichage des commentaires correspondant à l'ID du billet
	$req = $bdd->prepare('SELECT auteur, commentaire,
		DATE_FORMAT(date_commentaire, \'%d/%m à %Hh%imin\') AS date_creation
		FROM commentaires WHERE id_billet=?');
	$req->execute(array($_GET['id']));

	while ( $donnees= $req->fetch()) 
	{
?>

	<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo htmlspecialchars($donnees['date_creation']); ?></br>
	<?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>

<?php
	}
	$req->closeCursor();
?>
	</br>
	<div id="form_commentaire">
	<p>Poster un message</p>
		<form method="post" action="commentaire_post.php?id=<?php echo $donnees_billet['id']; ?>">
			pseudo : <input type="text" name="pseudo" /></br>
			<textarea name="message" rows="8" cols="45">Votre message ici.
			</textarea></br>
			<input type="submit" value="Envoyer"/>
		</form>
	</div>
	</body>
</html>