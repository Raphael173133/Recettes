<?php
function connect_database() : PDO {
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database;charset=utf8", "root", "root");
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database;
}

function add_recette(int $User_id, string $nom_recette, int $temps_prep, string $ingredients, string $preparation, int $temps_cuisson) : int | null {
    $database = connect_database();
    $sql = "INSERT INTO Recettes (User_id,nom_recette, temps_prep, ingredients, preparation, temp_cuisson) 
            VALUES (:User_id, :nom_recette, :temps_prep, :ingredients, :preparation, :temps_cuisson)";
    $stmt = $database->prepare($sql);
    $isSuccessful = $stmt->execute([
        'users_id' => $users_id,
        'nom_recette' => $nom-recette,
        'temps_prep' => $recette_details,
        'ingredients' => $ingredients,
        'preparation' => $preparation,
        'temps_cuisson' => $temps_cuisson
    ]);

    return $isSuccessful ? $database->lastInsertId() : null;
}

function get_recette(int $id) : array | null {
    $database = connect_database();
    $sql = "SELECT * FROM Recettes WHERE id = :id";
    $stmt = $database->prepare($sql);
    $stmt->execute(['id' => $id]);
    $recette = $stmt->fetch(PDO::FETCH_ASSOC);

    return $recette ?: null;
}

function get_all_recette(int $User_id) : array {
    $database = connect_database();
    $sql = "SELECT * FROM Recettes WHERE User_id = :User_id";
    $stmt = $database->prepare($sql);
    $stmt->execute(['User_id' => $User_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function update_recette(int $id, string $nom_recette, int $temps_prep, string $ingredients, string $preparation, int $temps_cuisson) : bool {
    $database = connect_database();
    $sql = "UPDATE Recettes 
            SET nom_recette = :nom_recette, temps_prep = :temps_prep, ingredients = :ingredients, preparation = :preparation, temps_cuisson = :temps_cuisson
            WHERE id = :id";
    $stmt = $database->prepare($sql);
    return $stmt->execute([
        'id' => $id,
        'nom_recette' => $nom-recette,
        'temps_prep' => $recette_details,
        'ingredients' => $ingredients,
        'preparation' => $preparation,
        'temps_cuisson' => $temps_cuisson
    ]);
}

function delete_recette(int $id) : bool {
    $database = connect_database();
    $sql = "DELETE FROM Recettes WHERE id = :id";
    $stmt = $database->prepare($sql);
    return $stmt->execute(['id' => $id]);
}
?>