<?php 

session_start();

// var_dump($_SESSION['user']);

require_once'/app/Requests/article.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="text-center">Welcome sur le blog PHP</h1>
            <div class="mt-4 card-list">
                <?php foreach (findAllArticlesWithCategory() as $article): ?>
                    <div class="card">
                        <h2 class="card-title"><?= $article['title']; ?></h2>
                        <p class="card-text mt-4"><?= substr($article['description'], offset: 0, length: 150);
                        echo strlen($article['description']) > 150 ? "..." : ''; ?></p>
                        <em class="card-date">
                            <?= (new DateTime($article['created_at']))->format('d/m/Y'); ?>
                        </em>
                        <a href="/details-article.php?id=<?= $article['id']; ?>" class="btn btn-primary mt-4">En savoir plus</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>