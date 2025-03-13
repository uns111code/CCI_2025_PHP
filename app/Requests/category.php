<?php

require_once '/app/config/mysql.php';


function findAllCategory(): array
{
    global $db;

    $query = "SELECT * FROM category ORDER BY name";

    $sql = $db->query($query);
    return $sql->fetchAll();
};


function createCategory(string $name, int $enabled): bool
{
    global $db;

    $query = "INSERT INTO category (name, enabled)  value (:name, :enabled)";
    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'name' => $name,
            'enabled' => $enabled
        ]);
    } catch (PDOException $e) {
        return false;
    }
    return true;
};

function findOneCategoryById(int $id) :bool|array
{
    global $db;

    $query = "SELECT * FROM category WHERE id = :id";
    $sql = $db->prepare($query);
    $sql->execute([
        'id' => $id
    ]);
    return $sql->fetch();
};


function findOneCategoryByName(string $name): bool|array
{
    global $db;

    $query = "SELECT * FROM category WHERE name = :name";
    $sql = $db->prepare($query);
    $sql->execute([
        'name' => $name
    ]);
    return $sql->fetch();
};


function updateCategory (int $id, string $name, int $enabled) : bool
{
    global $db;
    $query = "UPDATE category SET name = :name, enabled = :enabled WHERE id = :id";

    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'name' => $name,
            'enabled' => $enabled,
            'id' => $id,
        ]);
    } catch (PDOException $e) {
        var_dump($e->getMessage());
        return false;
    }
    return true;
}
