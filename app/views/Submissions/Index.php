<!DOCTYPE html>
<html>
<head>
    <title>Liste des Submissions</title>
</head>
<body>

    <h1>Liste des Submissions</h1>

    <a href="index.php?action=create">➕ Ajouter une Submission</a>

    <hr>

    <?php if (!empty($submissions)) : ?>

        <?php foreach ($submissions as $submission) : ?>

            <div style="margin-bottom:20px; padding:10px; border:1px solid #ccc;">
                
                <p><strong>ID:</strong> <?= htmlspecialchars($submission['id_sub']); ?></p>

                <p><strong>Description:</strong>
                    <?= htmlspecialchars($submission['description']); ?>
                </p>

                <p>
                    <strong>Image:</strong><br>

                    <?php if(!empty($submission['image'])) : ?>

                        <img src="assets/img/<?= htmlspecialchars($submission['image']); ?>"
                             width="200">

                    <?php endif; ?>

                </p>

                <a href="index.php?action=show&id=<?= $submission['id_sub']; ?>">
                    👁 Voir détails
                </a>

                |

                <a href="index.php?action=deleteSubmission&id=<?= $submission['id_sub']; ?>"
                   onclick="return confirm('Supprimer cette submission ?')">
                    ❌ Supprimer
                </a>

            </div>

        <?php endforeach; ?>

    <?php else : ?>

        <p>Aucune submission trouvée.</p>

    <?php endif; ?>

</body>
</html>