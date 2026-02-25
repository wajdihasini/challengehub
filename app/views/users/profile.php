<h2><?= $user['prenom']." ".$user['nom'] ?></h2>
<p>Email: <?= $user['email'] ?></p>
<p>Sexe: <?= $user['sexe'] ?></p>
<p>Date: <?= $user['date_naissance'] ?></p>
<p>Adresse: <?= $user['adresse'] ?></p>

<a href="index.php?url=edit">Modifier Profil</a><br>
<a href="index.php?url=delete">Supprimer Compte</a><br>
<a href="logout.php">Déconnexion</a>