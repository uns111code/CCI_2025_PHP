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

/**
 * Créeation d'un utilisateur dans la base de données.
 *
 * @param string $firstName  prénom de l'utilisateur
 * @param string $lastName
 * @param string $email
 * @param string $password
 * @return bool Returns true si l'utilisateur a été créé, false sinon.
 */
function createUser(string $firstName, string $lastName, string $email, string $password): bool 
{
    // INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)
    global $db; 

    try {
        $query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";

        $sql = $db->prepare($query);
        $sql->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_ARGON2I),
        ]);
    } catch (PDOException $e) {
        return false;
    }
    
    return true;
}


// 1; DELETE FROM users; -- Supprime tous les utilisateurs de la base de données