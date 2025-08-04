<?php

session_start();
require 'crud_recette.php';

if (!isset($_SESSION['User_id'])) {
    header('Location: login.php');
    exit;
}

$recettes = get_all_recette($_SESSION['User_id']);

if (count($recettes) === 0) {
    add_recette($_SESSION['User_id'], "Bienvenue", "Ajoute ta première recette!");
    $recettes = get_all_recette($_SESSION['User_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    if (!empty($_POST['nom_recette']) && !empty($_POST['temps_prep']) && !empty($_POST['ingredients']) && !empty($_POST['preparation']) && !empty($_POST['temps_cuisson'])) {
        add_recette($_SESSION['User_id'], $_POST['nom_recette'], $_POST['temps_prep'], $_POST['ingredients'], $_POST['preparation'], $_POST['temps_cuisson']);
        
        $database = connect_database();
        $sql = "DELETE FROM recettes 
                WHERE Users_id = :User_id 
                AND nom_recette = 'Bienvenue !'";
        $stmt = $database->prepare($sql);
        $stmt->execute(['User_id' => $_SESSION['User_id']]);
    }
    header("Location: Recette.php");
    exit;
}

if (isset($_GET['delete'])) {
    $recette = get_recette((int)$_GET['delete']);
    if ($recette && $recette['User_id'] == $_SESSION['User_id']) {
        delete_recette($recette['id']);
    }
    header("Location: Recette.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Recettes</title>
    <link rel="stylesheet" href="style-add-recette.css">
</head>
<body>
<div class="page">
    <header>
        <h1>Ton Carnet de Recettes</h1>
        <a href="deco.php" class="deco-btn">Se déconnecter</a>
    </header>

    <section class="recettes">
       <!--attendre raph-->
    </section>

    <section class="add-recette">
        <h3>Ajoute une nouvelle recette</h3>
        <form method="POST">
            <input type="hidden" name="action" value="add">
            <input type="text" name="recette_name" placeholder="Nom de la recette" required>
            <textarea name="recette_details" placeholder="Détails..." required></textarea>
            <textarea name="temps_prep" placeholder="Temps de préparation..." required></textarea>
            <textarea name="ingredients" placeholder="Ingrédients..." required></textarea>
            <textarea name="preparation" placeholder="Instruction..." required></textarea>
            <textarea name="temps_cuisson" placeholder="Temps de Cuisson..." required></textarea>
            <button type="submit">Ajouter</button>
        </form>
    </section>
</div>
</body>
</html>