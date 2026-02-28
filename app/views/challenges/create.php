<h2>Créer un défi</h2>

<?php if (!empty($errors)): ?>
    <div style="color:red; margin-bottom:1rem;">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="/challengehub/challenges/create" enctype="multipart/form-data">
    <div>
        <label>Titre *</label><br>
        <input type="text" name="titre" required value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>">
    </div>

    <div>
        <label>Description *</label><br>
        <textarea name="description" required rows="5"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
    </div>

    <div>
        <label>Catégorie *</label><br>
        <select name="categorie" required>
            <option value="">-- Choisir --</option>
            <option value="Art">Art</option>
            <option value="Photo">Photo</option>
            <option value="Musique">Musique</option>
            <option value="Écriture">Écriture</option>
            <option value="Autre">Autre</option>
        </select>
    </div>

    <div>
        <label>Date limite *</label><br>
        <input type="date" name="date_limite" required>
    </div>

    <div>
        <label>Image (facultatif)</label><br>
        <input type="file" name="image" accept="image/jpeg,image/png,image/gif">
    </div>

    <button type="submit" style="margin-top:1rem;">Publier</button>
</form>

<p><a href="/challengehub/challenges">Retour à la liste</a></p>