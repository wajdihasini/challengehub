<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        .container {
            width: 400px;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align:center; }
        label { display:block; margin-top:10px; font-weight:bold; }
        input, select, textarea {
            width:100%;
            padding:8px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius:4px;
        }
        button {
            width:100%;
            padding:10px;
            margin-top:15px;
            background:#007bff;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }
        button:hover { background:#0056b3; }
        .error { color:red; margin-top:10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Inscription</h2>

    <?php if(!empty($errors)): ?>
        <div class="error">
            <?php foreach($errors as $e) echo $e."<br>"; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?url=registerAction">

        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <label>Nom</label>
        <input type="text" name="nom" required>

        <label>Prénom</label>
        <input type="text" name="prenom" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Sexe</label>
        <select name="sexe" required>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>

        <label>Date de naissance</label>
        <input type="date" name="date_naissance" required>

        <label>Adresse</label>
        <textarea name="adresse" required></textarea>

        <label>Mot de passe</label>
        <input type="password" name="password" required>

        <label>Confirmer mot de passe</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">S'inscrire</button>

    </form>
</div>

</body>
</html>