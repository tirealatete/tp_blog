	<h3>
		<?php echo htmlspecialchars($donnees['titre']); ?>
		<em> le <?php echo htmlspecialchars($donnees['date_creation']); ?></em>
	</h3>
	<p>
	<?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?>