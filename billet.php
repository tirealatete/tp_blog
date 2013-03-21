	<h3>
		<?php echo htmlspecialchars($donnees_billet['titre']); ?>
		<em> le <?php echo htmlspecialchars($donnees_billet['date_creation']); ?></em>
	</h3>
	<p>
	<?php echo nl2br(htmlspecialchars($donnees_billet['contenu'])); ?>