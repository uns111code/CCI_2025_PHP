<?php 



if(
    !empty($_POST['name']) 
    && !empty($_POST['email']) 
    && !empty($_POST['message'])
    ) {
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $message = strip_tags($_POST['message']);
    } else {
        header('Location: /');
        exit(302);
    }


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>
<body>
       <?php require_once '/app/public/layout/_header.php'; ?>
        <main>
            <h1>
                votre message
            </h1>
            <p><?= $name; ?></p>
            <p><?= $email; ?></p>
            <p><?= $message; ?></p>
        </main>
</body>
</html>