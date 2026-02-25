<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
</head>
<body>

<h2>Modifier Profil</h2>

<form method="POST" action="index.php?url=update">

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <label>Nom</label>
    <input type="text" name="nom" value="<?= $user['nom'] ?>" required>

    <label>Prénom</label>
    <input type="text" name="prenom" value="<?= $user['prenom'] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $user['email'] ?>" required>

    <label>Sexe</label>
    <select name="sexe">
        <option value="Homme" <?= $user['sexe']=='Homme'?'selected':'' ?>>Homme</option>
        <option value="Femme" <?= $user['sexe']=='Femme'?'selected':'' ?>>Femme</option>
    </select>

    <label>Date de naissance</label>
    <input type="date" name="date_naissance" value="<?= $user['date_naissance'] ?>" required>

    <label>Adresse</label>
    <textarea name="adresse"><?= $user['adresse'] ?></textarea>

    <br><br>
    <button type="submit">Enregistrer</button>

</form>

</body>
</html>