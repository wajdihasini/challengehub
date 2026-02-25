<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        .container {
            width: 400px;
            margin: 60px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align:center; }
        label { display:block; margin-top:10px; font-weight:bold; }
        input {
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
            background:#28a745;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }
        button:hover { background:#1e7e34; }
        .error { color:red; margin-top:10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Connexion</h2>

    <?php if(!empty($errors)): ?>
        <div class="error">
            <?php foreach($errors as $e) echo $e."<br>"; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?url=loginAction">

        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <label>Nom</label>
        <input type="text" name="nom" required>

        <label>Prénom</label>
        <input type="text" name="prenom" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mot de passe</label>
        <input type="password" name="password" required>

        <button type="submit">Se connecter</button>

    </form>
</div>

</body>
</html>