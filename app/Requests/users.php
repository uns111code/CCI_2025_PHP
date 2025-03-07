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
 *  Récupère un utilisateur en BDD en filtrant par son id
 * 
 * @param int $id Id de l'utilisateur à rechercher
 *  @return bool|array
 */

function findOneUserById(int $id): bool|array
{
    global $db;

    $query = "SELECT * FROM users WHERE id = :id";


    $sql = $db->prepare($query);
    $sql->execute([
        'id' => $id
    ]);

    return $sql->fetch();
};

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

/**
 * Met à jour un utilisateur en BDD
 *
 * @param int $id ID de l'utilisateur à modifier
 * @param string $firstName
 * @param string $lastName
 * @param string $email
 * @param null|string $password
 * @return bool Returns true si l'utilisateur a été modifié, false sinon dans le cas d'une erreur.
 */


function updateUser(int $id, string $firstName, string $lastName, string $email, ?string $password): bool
// ->?string -> sting|null
{

    // UPDATE users SET first_name = first_name, last_name = last_name, email = email, password = 'S24yfgh" WHERE id = 1;
    global $db;
    $query = "UPDATE users SET first_name = :firstName, last_name = :lastName, email = :email";
    $params = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
    ];
    if (!empty($password)) {
        $query .= ", password = :password";
        $params['password'] = password_hash($password, PASSWORD_ARGON2I);
    }
    $query .= " WHERE id = :id";
    $params['id'] = $id;

    // var_dump($query, $params);

    try {
        $sql = $db->prepare($query);
        $sql->execute($params);
    } catch (PDOException $e) {
        // var_dump($e->getMessage());
        return false;
    }

    return true;
}

// 1; DELETE FROM users; -- Supprime tous les utilisateurs de la base de données

function deleteUser(int $id): bool
{

    // DELETE FROM users WHERE id = 1;
    global $db;
    $query = "DELETE FROM users WHERE id = :id";

    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'id' => $id,
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;
}





function findOneArticleByTitle(string $title): bool|array
{
    global $db;

    $sql = $db->prepare("SELECT * FROM articles WHERE title = :title");
    $sql->execute([
        'title' => $title
    ]);

    return $sql->fetch();
}





function createArticle(string $title, string $description): bool
{
    // INSERT INTO article (title, description)
    global $db;

    try {
        $query = "INSERT INTO articles (title, description) VALUES (:title, :description)";

        $sql = $db->prepare($query);
        $sql->execute([
            'title' => $title,
            'description' => $description
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;
}
