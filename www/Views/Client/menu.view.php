<div class="menu-container">
        <h1>Liste des Menus</h1>
        <ul class="menu-list">
            <?php foreach ($menus as $menu): ?>
                <li class="menu-item">
                    <a href="/page?id=<?php echo $menu['id']; ?>" class="menu-link"><?php echo htmlspecialchars($menu['title']); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>