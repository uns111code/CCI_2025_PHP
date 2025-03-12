<?php

session_start();

require_once '/app/Utils/utils.php';

checkAdmin();
// Récupérer le article grace à title dans l'url (GET)
require_once '/app/Requests/article.php';

$article = (isset($_GET['title']) && trim($_GET['title']) !== '') ? findOneArticleByTitle($_GET['title']) : null;
// $article = preg_match('/^[0-9]+$/', $_POST['id'] ?? '') ? findOneArticleById($_POST['id']) : null;

/******si title n'est pas vide et title est un int ***************find article by title****************si non null */
// var_dump($_POST);
if (!$article) {
    $_SESSION['messages']['danger'] = "article introuvable.";

    header('Location: /admin/article/index.php');
    exit(302);
};

// Vérification de la soumission du formulaire et que les champs obligatoires ne sont pas vides

if (
    !empty($_POST['title'])
    && !empty($_POST['description'])
) {
    // Nettoyer les données (supprimer les balises HTML) -> faille XSS
    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);
    $enabled = isset($_POST['enabled']) ? 1 : 0;

    // Vérification des contraintes SQL
    $changeTitle = $title !== $article['title'];  // s'il a changé son title

    if (!$changeTitle || !findOneArticleByTitle($title)) {
        // Si il n'a pas changé son title, on peut modifier l'artile
        if (updateArticle($article['id'], $title, $description, $enabled)) {
            // articlee modifié sans erreur
            // on définit un message de succès
            $_SESSION['messages']['success'] = "article modifié avec succès";
            header('Location: /admin/article');
            exit(302);
        } else {
            // articlee modifié avec une erreur
            $errorMessage = "Une erreur est survenue lors de la modification de l'article";
        }
    } else {
        $errorMessage = "Cet enabled est d'jà utilisé";
    }
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un article | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="text-center">Modification d'un article</h1>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="card mt-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required placeholder="title" value="<?= $article['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" id="description" required placeholder="description"><?= $article['description']; ?></textarea>
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