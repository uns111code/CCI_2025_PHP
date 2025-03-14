<?php

session_start();

require_once '/app/Utils/utils.php';

checkAdmin();

require_once '/app/Requests/article.php';

$_SESSION['csrf_token'] = bin2hex(random_bytes(72));

// var_dump($_SESSION)
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Articles | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="text-center">Création des Articles</h1>
            <a href="/admin/article/create.php" class="btn btn-primary">Créer un Article</a>
            <a href="/admin/category" class="btn btn-primary">Catégorie</a>
            <table class="card mt-4">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Catégorie</th>
                        <th>Date de création</th>
                        <th>Actif</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(findAllArticlesWithCategory() as $article): ?>
                            <tr>
                                <td><?= "$article[title]"; ?></td>
                                <td><?= $article['description']; ?></td>
                                <!-- <td><?php var_dump($article); ?></td> -->
                                <td><?= $article['category_name'] ?? 'Pas de catégorie' ?></td>
                                <td><?= (new DateTime($article['created_at']))->format('d-m-Y'); ?></td>
                                <td>
                                    <span class="badge bg-<?= $article['enabled'] ? 'success' : 'danger'; ?>">
                                        <?= $article['enabled'] ? 'Actif' : 'Inactif'; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="table-btn">
                                        <a href="/admin/article/update.php?title=<?= $article['title']; ?>" class="btn btn-secondary">Modifier</a>
                                        <form action="/admin/article/delete.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet Article ?');">
                                            <input type="hidden" name="id" value="<?= $article['id'];?>">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ;?>">
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>