<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Site</title>
    <!-- <link rel="stylesheet" type="text/css" href="./dist/css/style.css" /> -->
    <meta name="description" content="Super site avec une magnifique intégration">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
        </div>
        <div class="navbar-right">
            <div class="navbar-user">Bonjour, <?php echo $_SESSION["auth_user"]["login"]  ?></div>
            <a href="#" class="fas fa-user" id="user-icon"></a>

            <div class="user-menu" id="user-menu">
                <ul>
                    <li><a href="/update-user">Modifier</a></li>
                    <li>
                        <form method="POST" action="">
                            <button type="submit" name="logout" class="disc-btn">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="/admin"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <li><a href="/page-list"><i class="fas fa-file"></i> Pages</a></li>
            <li><a href="reviews"><i class="fas fa-comments"></i> Commentaires</a></li>
            <li><a href="review-manager"><i class="fas fa-comments"></i> Modération</a></li>
            <li><a href="/register"><i class="fas fa-users"></i> Comptes</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="contenu">
        <!-- intégration de la vue -->
        <?php include $this->view; ?>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var userIcon = document.getElementById('user-icon');
            var userMenu = document.getElementById('user-menu');

            userIcon.addEventListener('click', function(event) {
                event.preventDefault();
                // Toggle l'affichage du menu utilisateur
                if (userMenu.style.display === 'block') {
                    userMenu.style.display = 'none';
                } else {
                    userMenu.style.display = 'block';
                }
            });

            // Cacher le menu quand on clique en dehors de celui-ci
            document.addEventListener('click', function(event) {
                if (!userMenu.contains(event.target) && !userIcon.contains(event.target)) {
                    userMenu.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>