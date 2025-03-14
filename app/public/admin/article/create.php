<?php 

session_start();

require_once '/app/Utils/utils.php';

checkAdmin();

// var_dump($_SERVER);    // pour voir tout les info de server

// var_dump($_POST);   // pour voir les données de formulaires

require_once '/app/Requests/article.php';

require_once '/app/Requests/category.php';

// Vérifier si les données du formulaire sont bien présentes
if (
    !empty($_POST['title'])
    && !empty($_POST['description'])
) {
    // Nettoyage de données (suppression des balises HTML) -> faille xss
    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);
    $enabled = isset($_POST['enabled']) ? true : false;    // ou 1 : 0
    $categoryId = preg_match('/^[0-9]+$/', $_POST['category'] ?? '') ? $_POST['category'] : null;

    // Vérification des Contraintes SQL
    $articleExist = findOneArticleByTitle($title);

    if (!$articleExist) {
        // Persistance de données  (مقاومت ایستادگی) 
        // On peut créer l'article en BDD
        if (createArticle($title, $description, $enabled, $categoryId)) {
            // Définir un message de success
            $_SESSION['messages']['success'] = "Votre article a bien été créé";

            // Redirection vers la page de souhaitée
            header('Location: /admin/article/create.php');
            exit(302);
        } else {
            $errorMessage = "Une erreur est survenue lors de la création de votre compte";
        }
    } else {
        $errorMessage = "Ce titre est déjà utilisé";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errorMessage = "Les champs obligatoires ne sont pas remplis";
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'article | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="title text-center">Création d'article</h1>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="card mt-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select name="category" id="category">
                        <option value="" selected disabled>Sélectionner une catégorie</option>
                        <?php foreach(findAllCategory() as $category): ?>
                            <option value="<?= $category['id']; ?>">
                                <?= $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required placeholder="Description" rows="10"></textarea>
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