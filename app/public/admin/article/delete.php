<?php

session_start();

require_once '/app/Utils/utils.php';

checkAdmin();

// Récupérer les articles grace à title dans $_POST
require_once '/app/Requests/article.php';                // on le met ici et pas en haut pour avoir un bon performance

// On gère les cas d'erreurs si title n'est pas un nombre ou si l'article n'existe pas
$article = preg_match('/^[a-zA-Z0-9]+$/', $_POST['title'] ?? '') ? findOneArticleByTitle($_POST['title']) : null;
// $article = preg_match('/^[0-9]+$/', $_POST['id'] ?? '') ? findOneArticleById($_POST['id']) : null;
// Si l'article n'existe pas on redirige
if (!$article) {
    $_SESSION['messages']['danger'] = "article introuvable";

    header('Location: /admin/articles');
    exit(302);
}

if (deleteArticle($article['title'])) {
    $_SESSION['messages']['success'] = "article supprimé avec succès";
} else {
    $_SESSION['messages']['danger'] = "Erreur lors de la suppression de l'article";
}

header('Location: /admin/article');
exit(302);
