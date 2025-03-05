<?php 

require_once '/app/config/mysql.php';


/**
 * Récupère tous les utilisateurs de la base de données.
 *
 * @return array
 */
function findAllUsers(): array 
{
    global $db;

    $query = "SELECT * FROM users";

    $sql = $db->query($query);

    return $sql->fetchAll();
}

/**
 *  Récupère un utilisateur en BDD en filtrant par son email
 * 
 * @param string $email Email de l'utilisateyr à rechercher
 *  @return 
 */

function findOneUserByEmail(string $email): bool|array 
{
    global $db;

    $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
    $sql->execute([
        'email' => $email
    ]);

    return $sql->fetch();
}


// 1; DELETE FROM users; -- Supprime tous les utilisateurs de la base de données