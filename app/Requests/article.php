<?php

require_once '/app/config/mysql.php';

function findOneArticleByTitle(string $title): bool|array  // bool si il ne trouve pas array s'il trouve dans BDD
{
    global $db;    //il peut chercher à l'extrieur de la fonction

    $sql = $db->prepare("SELECT * FROM articles WHERE title = :title");
    //     💡 Pourquoi utiliser prepare et :title ?
    // ✅ Sécurise contre les injections SQL
    // ✅ Optimise la requête (PDO peut la précompiler)
    // ✅ Facilite la gestion des valeurs dynamiques
    $sql->execute([
        'title' => $title
    ]);
    // Exécute la requête préparée en remplaçant :title par la vraie valeur
    // Associe la valeur de la variable $title au marqueur nommé :title.
    // PDO va échapper automatiquement $title pour empêcher toute injection SQL.

    return $sql->fetch();
}





function createArticle(string $title, string $description, int $enabled, ?int $categoryId): bool
{

    global $db;
    $query = "INSERT INTO articles (title, description, enabled, category_id) VALUES (:title, :description, :enabled, :category_id)";

    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'title' => $title,
            'description' => $description,
            'enabled' => $enabled,
            'category_id' => $categoryId
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;
}




/**
 * Récupère tous les articles de la base de données.
 *
 * @return array
 */
function findAllArticles(): array
{
    global $db;

    $query = "SELECT * FROM articles ORDER BY created_at DESC";

    $sql = $db->query($query);

    return $sql->fetchAll();
}


function findAllArticlesWithCategory(): array
{
    global $db;

    $query = "SELECT a.*, c.name AS category_name FROM articles a LEFT JOIN category c ON a.category_id = c.id ORDER BY a.created_at DESC";

    $sql = $db->query($query);

    return $sql->fetchAll();
};




/**
 * Met à jour un article en BDD
 *
 * @param int $id ID de l'article à modifier
 * @param string $title
 * @param string $description
 * @param int $enabled
 * @return bool Returns true si l'article a été modifié, false sinon dans le cas d'une erreur.
 */


function updateArticle(int $id, string $title, string $description, int $enabled, int $categoryId): bool
{

    global $db;
    $query = "UPDATE articles SET title = :title, description = :description, enabled = :enabled , category_id = :category_id WHERE id = :id";
    $sql = $db->prepare($query);

    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'title' => $title,
            'description' => $description,
            'enabled' => $enabled,
            'id' => $id,
            'category_id' => $categoryId
        ]);
    } catch (PDOException $e) {
        var_dump($e->getMessage());
        return false;
    }

    return true;
}

// 1; DELETE FROM articles; -- Supprime tous les articles de la base de données

function deleteArticle(int $id): bool
{

    // DELETE FROM articles WHERE id = 1;
    global $db;
    $query = "DELETE FROM articles WHERE id = :id";

    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'id' => $id,
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;
};


 /**
 *  Récupère un article en BDD en filtrant par son id
 * 
 * @param int $id Id de l'article à rechercher
 *  @return bool|array
 */

 function findOneArticleById(int $id): bool|array
 {
     global $db;
 
     $query = "SELECT * FROM articles WHERE id = :id";
 
 
     $sql = $db->prepare($query);
     $sql->execute([
         'id' => $id
     ]);
 
     return $sql->fetch();
 };




function findLatestArticle(int $limit = 3): array
{
    global $db;

    $query = "SELECT a.*, c.name AS categorie_name FROM article a LEFT JOIN category c ON a.categorie_id = c.id ORDER BY a.created_at DESC LIMIT :limit";
    $sql = $db->query($query);
    $sql->execute([
        'limit' => $limit
    ]);

    return $sql->fetchAll();
};

























// /**
//  * Suppression d'un article en BDD
//  * 
//  * @param int $id
//  * 
//  * @return bool
//  */
// function deleteArticle(int $id): bool
// {
//     global $db;

//     try {
//         $sql = $db->prepare("DELETE FROM articles WHERE id = :id");
//         $sql->execute([
//             'id' => $id
//         ]);
//     } catch (PDOException $e) {
//         return false;
//     }

//     return true;
// }

