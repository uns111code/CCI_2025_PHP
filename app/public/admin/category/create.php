<?php

session_start();

require_once '/app/Utils/utils.php';
checkAdmin();

require_once '/app/Requests/category.php';

// var_dump($_SERVER);  // pour voir tous les ..... de serveur
// var_dump($_POST);  // pour voir res valeur de inputes

if (
    !empty(trim($_POST['name'] ?? ''))  // !empty(trim($_POST['name'] ?? ''  et pas de space
    
) {

    $name = strip_tags($_POST['name']);
    $enabled = isset($_POST['enabled']) ? 1 : 0;

    $categoryExist = findOneCategoryByName($name);

    if (!$categoryExist) {
        if (createCategory($name, $enabled)) {
            $_SESSION['messages']['success'] = "Votre Catégorie a bien été créé";
            header('Location: /admin/category/index.php');
            exit(302);
        } else {
            $errorMessage = "Une erreur est survenue lors de la création de votre catégory";
        }
    } else {
        $errorMessage = "Ce nom de catégorie est déjà utilisé";
    }
} else if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errorMessage = "Les champs obligatoires ne sont pas remplis";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Catégorie | Catégory</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="text-center">Création d'une Catégorie</h1>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="card mt-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" required placeholder="Nom de la catégorie">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="enabled" id="enabled">
                    <label for="enabled">Actif</label>
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </section>
    </main>
</body>

</html>