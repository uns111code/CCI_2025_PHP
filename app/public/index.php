<?php 

session_start();

// var_dump($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/layout/_header.php'; ?>
    <main>
        <form action="/contact.php" method="POST">
            <label for="name">Votre Nom</label>
            <input type="text" id="name" name="name">
            <label for="email">Votre Email</label>
            <input type="email" id="email" name="email">
            <label for="message">Votre Message</label>
            <textarea id="message" name="message"></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </main>
</body>

</html>