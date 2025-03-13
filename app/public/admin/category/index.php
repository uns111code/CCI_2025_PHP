<?php

session_start();

require_once '/app/Utils/utils.php';
checkAdmin();

require_once '/app/Requests/category.php'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégorie</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>
<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <section class="container mt-4">
            <h1 class="text-center">Catégorie</h1>
            <a href="/admin/category/create.php" class="btn btn-primary">Créer une catégorie</a>
            <table class="card mt-4">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Actif</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(findAllCategory() as $category): ?>
                    <tr>
                        <td><?= $category['name'] ?></td>
                        <td>
                            <span class="badge bg-<?= $category['enabled'] ? 'success' : 'danger'; ?>">
                                 <?= $category['enabled'] ? 'Actif' : 'Inactif'; ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-btn">
                                <a href="/admin/category/update.php?id=<?= $category['id']; ?>" class="btn btn-secondary">Modifier</a>
                                <button type="submit" class="btn btn-danger">Supprimer</button>
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

