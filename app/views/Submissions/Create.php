<!DOCTYPE html>
<html>
<head>
    <title>Créer une Submission</title>
</head>
<body>

    <h1>Créer une Submission</h1>

    <a href="index.php?action=index">⬅ Retour à la liste</a>

    <hr>

    <form action="index.php?action=store" method="POST">

        <div>
            <label>Description :</label><br>
            <textarea name="description" required></textarea>
        </div>

        <br>

        <div>
            <label>Image (nom du fichier) :</label><br>
            <input type="text" name="image" required>
        </div>

        <br>

        <button type="submit"
                onclick="return confirm('Confirmer création submission ?')">
            Enregistrer
        </button>

    </form>

</body>
</html>