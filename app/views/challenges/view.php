<h1><?= htmlspecialchars($challenge->getTitre()) ?></h1>

<p><strong>Catégorie :</strong> <?= htmlspecialchars($challenge->getCategorie()) ?></p>
<p><strong>Date limite :</strong> <?= htmlspecialchars($challenge->getDateLimite()) ?></p>
<p><strong>Créé le :</strong> <?= htmlspecialchars($challenge->getCreatedAt()) ?></p>

<div style="margin: 1.5rem 0;">
    <p><strong>Description :</strong></p>
    <p style="white-space: pre-wrap;"><?= nl2br(htmlspecialchars($challenge->getDescription())) ?></p>
</div>

<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $challenge->getUserId()): ?>
    <p>
        <a href="/challengehub/challenges/edit/<?= $challenge->getId() ?>">
            Modifier ce défi
        </a>
    </p>
<?php endif; ?>

<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $challenge->getUserId()): ?>
    <form action="/challengehub/challenges/delete/<?= $challenge->getId() ?>" method="POST" style="margin-top: 1rem;">
        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce défi ? Cette action est irréversible.');">
            Supprimer ce défi
        </button>
    </form>
<?php endif; ?>

<?php if ($challenge->getImagePath()): ?>
    <div>
        <p><strong>Image du défi :</strong></p>
        <img src="<?= htmlspecialchars('/challengehub' . $challenge->getImagePath()) ?>" 
     alt="Image du défi" 
     style="max-width: 280px; height: auto;">

    </div>
<?php endif; ?>

<p style="margin-top: 2rem;">
    <a href="/challengehub/challenges">← Retour à la liste des défis</a>
</p>