<header class="navbar">
    <nav class="navbar-content">
        <a href="/" class="navbar-logo">My first App PHP</a>
        <ul class="navbar-links">
            <li class="navbar-item">
                <a href="/index.php">Accueil</a>
            </li>
            <li class="navbar-item">
                <a href="#">Profil</a>
            </li>
            <li class="navbar-item">
                <a href="#">Blog</a>
            </li>
        </ul>
        <ul class="navbar-buttons">
            <li class="navbar-item">
                <?php if (!empty($_SESSION['user'])) :?>
                    <a href="/logout.php" class="btn btn-danger">logout</a>
                <?php else :?>
                    <a href="/login.php" class="btn btn-secondary">login</a>
                <?php endif;?>
            </li>
        </ul>
    </nav>
</header>