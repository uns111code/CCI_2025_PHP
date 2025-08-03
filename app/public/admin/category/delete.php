<?php 

session_start();

require_once '/app/Utils/utils.php';
checkAdmin();

require_once '/app/Requests/category.php';

if (
    preg_match('/^[0-9]+$/', $_POST['id'] ?? '')
    && !empty($_SESSION['csrf_token'])
    ) {

    if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {

        $category = findOneCategoryById($_POST['id']);

        if ($category) {

            if (deleteCategory($category['id'])) {

                $_SESSION['messages']['success'] = "Catégorie supprimée avec succès";
            } else {
                $_SESSION['messages']['danger'] = "Erreur lors de la suppression de la catégory";
            }
        } else {
            $_SESSION['messages']['danger'] = "Catégorie introuvable";
        }
    } else {
        $_SESSION['messages']['danger'] = "Token CSRF invalide";
    }
} else {
    $_SESSION['messages']['danger'] = "Champs obligatoire manquants";
}


header('Location: /admin/category/');
exit(302);
