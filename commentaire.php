
<!--  AFFICHAGE DES COMMENTAIRES DU BILLET et du formulaire de post-->

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