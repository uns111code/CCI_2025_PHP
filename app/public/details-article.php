<?php

session_start();

require_once'/app/Requests/article.php';

$article = (isset($_GET['id']) && trim($_GET['id']) !== '') ? findOneArticleByTitle($_GET['id']) : null;

if(!$article) {
    $_SESSION['messages']['danger'] = "article introuvable.";

    header('Location: /admin/article/index.php');
    exit(302);
};

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article['title']; ?> | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="text-center">Détails de l'article: </h1>
            <article>
                <?= $article['description']; ?>
            </article>
        </section>
    </main>
</body>

</html>