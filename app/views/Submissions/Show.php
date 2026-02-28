<!DOCTYPE html>
<html>
<head>
    <title>Détail Submission</title>
</head>
<body>

    <a href="index.php?action=index">⬅ Retour à la liste</a>

    <hr>

    <?php if ($submission) : ?>

        <h2>Détail de la Submission</h2>

        <p><strong>ID :</strong>
            <?= htmlspecialchars($submission['id_sub']); ?>
        </p>

        <p><strong>Description :</strong>
            <?= htmlspecialchars($submission['description']); ?>
        </p>

        <p><strong>Image :</strong><br>

            <?php if(!empty($submission['image'])) : ?>

                <img src="assets/img/<?= htmlspecialchars($submission['image']); ?>"
                     width="250">

            <?php endif; ?>

        </p>

        <hr>

        <h3>Commentaires</h3>

        <?php if (!empty($comments)) : ?>

            <?php foreach ($comments as $comment) : ?>

                <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

                    <?= htmlspecialchars($comment['content']); ?>

                    <br><br>

                    <a href="index.php?action=deleteComment&id=<?= $comment['id_comm']; ?>&sub=<?= $submission['id_sub']; ?>"
                       onclick="return confirm('Supprimer ce commentaire ?')">
                        ❌ Supprimer
                    </a>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <p>Aucun commentaire pour cette submission.</p>

        <?php endif; ?>

        <hr>

        <h3>Ajouter un commentaire</h3>

        <form action="index.php?action=addComment" method="POST">

            <input type="hidden" name="submission_id"
                   value="<?= $submission['id_sub']; ?>">

            <textarea name="content" required></textarea>

            <br><br>

            <button type="submit">Ajouter</button>

        </form>

    <?php else : ?>

        <p>Submission non trouvée.</p>

    <?php endif; ?>

</body>
</html>