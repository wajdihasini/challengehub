<h1>Liste des défis</h1>

<?php
$msg = $_GET['msg'] ?? '';

if ($msg === 'create_success'): ?>
    <div style="background:#d4edda; color:#155724; padding:1rem; margin-bottom:1rem; border:1px solid #c3e6cb; border-radius:4px;">
        Le défi a été créé avec succès !
    </div>
<?php elseif ($msg === 'edit_success'): ?>
    <div style="background:#d4edda; color:#155724; padding:1rem; margin-bottom:1rem; border:1px solid #c3e6cb; border-radius:4px;">
        Le défi a été modifié avec succès !
    </div>
<?php elseif ($msg === 'delete_success'): ?>
    <div style="background:#d4edda; color:#155724; padding:1rem; margin-bottom:1rem; border:1px solid #c3e6cb; border-radius:4px;">
        Le défi a été supprimé avec succès.
    </div>
<?php endif; ?>

<?php if (empty($challenges)): ?>
    <p>Aucun défi pour le moment.</p>
<?php else: ?>
    <?php foreach ($challenges as $challenge): ?>
        <div style="border:1px solid #ccc; margin:1rem 0; padding:1rem;">
            <h3><?= htmlspecialchars($challenge->getTitre()) ?></h3>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($challenge->getCategorie()) ?></p>
            <p><strong>Date limite :</strong> <?= htmlspecialchars($challenge->getDateLimite()) ?></p>
            <p><?= nl2br(htmlspecialchars(substr($challenge->getDescription(), 0, 180))) ?>...</p>

            <?php if ($challenge->getImagePath()): ?>
<img src="<?= htmlspecialchars('/challengehub' . $challenge->getImagePath()) ?>" 
     alt="Image du défi" 
     style="max-width: 280px; height: auto;">
                 <?php endif; ?>

            <p>
                <a href="/challengehub/challenges/<?= $challenge->getId() ?>">Voir les détails →</a>
            </p>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $challenge->getUserId()): ?>
                <a href="/challengehub/challenges/edit/<?= $challenge->getId() ?>" style="color:blue; margin-right:1rem;">Modifier</a>

                <form action="/challengehub/challenges/delete/<?= $challenge->getId() ?>" method="POST" style="display:inline;">
                    <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce défi ?');" style="color:red; border:none; background:none; cursor:pointer;">
                        Supprimer
                    </button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <p><a href="/challengehub/challenges/create">Créer un nouveau défi</a></p>
<?php endif; ?>