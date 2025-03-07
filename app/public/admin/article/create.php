<?php 

session_start();

require_once '/app/Utils/utils.php';

checkAdmin();


require_once '/app/Requests/users.php';
// Vérifier si les données du formulaire sont bien présentes
if (
    !empty($_POST['title'])
    && !empty($_POST['description'])
) {
    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);

    $articleExist = findOneArticleByTitle($title);

    // Insérer l'article en BDD (sql)


    if (!$articleExist) {
        // On peut créer l'article en BDD
        if (createArticle($title, $description)) {
            // Définir un message de success
            $_SESSION['messages']['success'] = "Votre article a bien été créé";

            // Redirection vers la page de connexion
            header('Location: /admin/article/create.php');
            exit(302);
        } else {
            $errorMessage = "Une erreur est survenue lors de la création de votre compte";
        }
    } else {
        $errorMessage = "Ce titre est déjà utilisé";
    }
}



var_dump(
    $_POST
);

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
            <form action="#" method="POST" class="card mt-4">
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
                    <label for="Description">Description</label>
                    <textarea name="description" id="description" required placeholder="Description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </section>
    </main>
</body>

</html>