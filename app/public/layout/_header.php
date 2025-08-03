<header class="navbar">
    <nav class="navbar-content">
        <a href="/" class="navbar-logo">My first App PHP</a>
        <ul class="navbar-links">
            <li class="navbar-item">
                <a href="#">Accueil</a>
            </li>
            <li class="navbar-item">
                <a href="#">Profil</a>
            </li>
            <li class="navbar-item">
                <a href="#">Blog</a>
            </li>
        </ul>
        <ul class="navbar-buttons">
            <?php if (!empty($_SESSION['user'])): ?>
                <?php if (in_array('ROLE_ADMIN', $_SESSION['user']['roles'])): ?>
                    <li class="navbar-item">
                        <a href="/admin/users" class="btn btn-light">Admin Users</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/admin/category" class="btn btn-light">Admin Catégories</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/admin/article" class="btn btn-light">Admin Articles</a>
                    </li>
                <?php endif; ?>
                <li class="navbar-item">
                    <a href="/logout.php" class="btn btn-danger">Logout</a>
                </li>
            <?php else: ?>
                <li class="navbar-item">
                    <a href="/login.php" class="btn btn-secondary">Login</a>
                </li>
                <li class="navbar-item">
                    <a href="/register.php" class="btn btn-light">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>