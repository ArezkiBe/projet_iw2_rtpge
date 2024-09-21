<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Site</title>
    <!-- <link rel="stylesheet" type="text/css" href="./dist/css/style.css" /> -->
    <meta name="description" content="Super site avec une magnifique intégration">
</head>

<body>
    <nav class="front-navbar">
        <div class="navbar-container">
            <ul class="navbar-menu">
                <li><a href="/menus">Menus</a></li>
                <li><a href="/entrees">Entrées</a></li>
                <li><a href="/plats">Plats</a></li>
                <li><a href="/desserts">Desserts</a></li>
            </ul>
        </div>
    </nav>

    <!-- intégration de la vue -->
    <?php include $this->view; ?>
</body>

</html>