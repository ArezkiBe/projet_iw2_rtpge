<div class="pages-container">
    <table class="pages-table">
        <thead>
            <tr>
                <th>Nom de la page</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pages)): ?>
                <?php foreach ($pages as $page): ?>
                    <tr class="page-row">
                        <td class="page-title"><?= htmlspecialchars($page["title"]) ?></td>
                        <td class="page-actions">
                            <form method="POST" action="/page-list" class="action-form">
                                <input type="hidden" name="id" value="<?= $page['id'] ?>">
                                <button type="submit" name="action" value="edit" class="btn edit-btn">Modifier</button>
                                <button type="submit" name="action" value="delete" class="btn delete-btn">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Aucune page à afficher.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="add-page">
        <form method="POST" action="/page-list">
            <button type="submit" name="action" value="add" class="btn add-btn">Ajouter une page</button>
        </form>
    </div>
</div>
