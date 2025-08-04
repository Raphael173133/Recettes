<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<header>
    <img src="logo.png" alt="img">
</header>

<body>
    <section class="user_section">
        <h1>Connexion</h1>
        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <form method="post">
            <div class="form-container">
                <label for="mail">Email :</label>
                <input type="email" name="email" required></label><br>

                <label for="password">Mots de passe :</label>
                <input type="password" name="password" required></label><br>

                <button type="submit">Se connecter</button>
            </div>
        </form>
        <a href="inscription.php">Pas de compte ? S'inscrire</a>
    </section>

</body>

</html>