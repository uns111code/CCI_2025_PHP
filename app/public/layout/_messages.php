<?php foreach ($_SESSION['messages'] ?? [] as $type => $message): ?>
    <div class="alert alert-<?= $type; ?>">
        <?php
           echo $message; 
           unset($_SESSION['messages'][$type]);  // Suppression du message après affichage
        ?>
    </div>
<?php endforeach; ?>