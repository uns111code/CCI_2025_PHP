<?php

session_start();

require_once '/app/Utils/utils.php';

checkAdmin();
// Récupérer le user grace à l'id dans l'url (GET)
require_once '/app/Requests/users.php';

$user = preg_match('/^[0-9]+$/', $_GET['id'] ?? '') ? findOneUserById($_GET['id']) : null;

/******si id n'est pas vide et id est un int ***************find user by id****************si non null */

if (!$user) {
    $_SESSION['messages']['danger'] = "User introuvable.";

    header('Location: /admin/users/index.php');
    exit(302);
};

// Vérification de la soumission du formulaire et que les champs obligatoires ne sont pas vides

if (
    !empty($_POST['firstName'])
    && !empty($_POST['lastName'])
    && !empty($_POST['email'])
) {
    // Nettoyer les données (supprimer les balises HTML) -> faille XSS
    $firstName = strip_tags($_POST['firstName']);
    $lastName = strip_tags($_POST['lastName']);
    $email = strip_tags($_POST['email']);
    $password = $_POST['password'] ?? null;

    // Vérification des contraintes SQL
    $changeEmail = $email !== $user['email'];  // s'il a changé son email

    if (!$changeEmail || !findOneUserByEmail($email)) {
        // Si il n'a pas changé son email, on peut modifier l'utilisateur
        if (updateUser($user['id'], $firstName, $lastName, $email, $password)) {
            // Usere modifié sans erreur
            // on définit un message de succès
            $_SESSION['messages']['success'] = "User modifié avec succès";
            header('Location: /admin/users');
            exit(302);
        } else {
            // Usere modifié avec une erreur
            $errorMessage = "Une erreur est survenue lors de la modification de l'utilisateur";
        }
    } else {
        $errorMessage = "Cet email est d'jà utilisé";
    }   
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un user | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="text-center">Modification d'un user</h1>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="card mt-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="firstName">Prénom</label>
                    <input type="text" name="firstName" id="firstName" required placeholder="John" value="<?= $user['first_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Nom</label>
                    <input type="text" name="lastName" id="lastName" required placeholder="Doe" value="<?= $user['last_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required placeholder="john@example.com" value="<?= $user['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="S3CR3T">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </section>
    </main>
</body>

</html>