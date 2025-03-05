<?php

try {
    $dsn = "mysql:host=dataBase;dbname=cours_php;charset=utf8mb4";

    $db = new PDO(
        dsn: $dsn,
        username: 'root',
        password: null,
        options: [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $error) {
    die("Erreur de connexion à la base de données : " . $error->getMessage());
}




// var_dump(
//     $db->query('SELECT * FROM users')->fetchAll()
// );
