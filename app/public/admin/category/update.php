<?php

session_start();

require_once '/app/Utils/utils.php';
checkAdmin();

require_once '/app/Requests/category.php';

$category = preg_match('/^[0-9]+$/', $_GET['id'] ?? '') ? findOneCategoryById($_GET['id']) : null;
/******si id n'est pas vide et id est un int ***************find user by id****************si non null */

if (!$category) {
    $_SESSION['messages']['danger'] = "Catégory introuvable.";

    header('Location: /admin/category/index.php');
    exit(302);
};

if (
    !empty(trim($_POST['name'] ?? ''))  // trim efface les space vide
) {
    $name = strip_tags($_POST['name']);
    $enabled = isset($_POST['enabled']) ? 1 : 0;

    $categoryExist = findOneCategoryByName($name);
    $changeCategory = $name !== $category['name'];

    if (!$changeCategory || !$categoryExist) {
        if (updateCategory($category['id'], $name, $enabled)) {
            $_SESSION['messages']['success'] = "Votre Catégorie a bien été modifiée";
            header('Location: /admin/category/index.php');
            exit(302);
        } else {
            $errorMessage = "Une erreur est survenue lors de la modification de votre catégory";
        }
    } else {
        $errorMessage = "Ce nom de catégorie est déjà utilisé";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <section class="container mt-4">
        <?php require_once '/app/public/layout/_messages.php'; ?>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="card mt-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" required placeholder="Nom de catégorie" value="<?= $category['name']; ?>">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="enabled" id="enabled">
                    <label for="enabled">Actif</label>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </section>
    </main>
</body>

</html>