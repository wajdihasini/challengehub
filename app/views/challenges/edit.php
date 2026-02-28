<h2>Modifier le défi</h2>

<?php if (!empty($errors)): ?>
    <div style="color:red; margin-bottom:1rem;">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="/challengehub/challenges/edit/<?= $challenge->getId() ?>" enctype="multipart/form-data">
    <div>
        <label>Titre *</label><br>
        <input type="text" name="titre" required value="<?= htmlspecialchars($challenge->getTitre()) ?>">
    </div>

    <div>
        <label>Description *</label><br>
        <textarea name="description" required rows="5"><?= htmlspecialchars($challenge->getDescription()) ?></textarea>
    </div>

    <div>
        <label>Catégorie *</label><br>
        <select name="categorie" required>
            <?php
            $cats = ['Art', 'Photo', 'Musique', 'Écriture', 'Autre'];
            foreach ($cats as $cat): ?>
                <option value="<?= $cat ?>" <?= $challenge->getCategorie() === $cat ? 'selected' : '' ?>>
                    <?= $cat ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Date limite *</label><br>
        <input type="date" name="date_limite" required value="<?= htmlspecialchars($challenge->getDateLimite()) ?>">
    </div>

    <div>
        <label>Image actuelle :</label><br>
        <?php if ($challenge->getImagePath()): ?>
            <img src="<?= htmlspecialchars($challenge->getImagePath()) ?>" alt="Image actuelle" style="max-width:280px;"><br>
        <?php else: ?>
            <p>Aucune image</p>
        <?php endif; ?>
        <br>
        <label>Changer l'image (facultatif)</label><br>
        <input type="file" name="image" accept="image/jpeg,image/png,image/gif">
    </div>

    <button type="submit" style="margin-top:1rem;">Enregistrer les modifications</button>
</form>

<p><a href="/challengehub/challenges">Retour à la liste</a></p>