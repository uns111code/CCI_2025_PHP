<?php foreach ($_SESSION['messages'] ?? [] as $type => $messages): ?>
    <div class="alert alert-<?= $type; ?>">
        <?php
           echo $messages; 
           unset($_SESSION['messages'][$type]);  // Suppression du message après affichage
        ?>
    </div>
<?php endforeach; ?>