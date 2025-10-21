<?php $title = "Erreur"; ?>

<?php ob_start(); ?>
    <h1>Une erreur est survenue...</h1>
    <p>
        <?= htmlspecialchars($errorMessage) ?>
    </p>
    <p>
        <a href="index.php">← Retour à l'accueil</a>
    </p>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>