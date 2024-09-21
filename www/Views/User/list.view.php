<?php
// Mapping des rôles
$roles = [
    'Administrateur' => 2,
    'Modérateur' => 3,
    'Editeur' => 4,
];
?>

<div class="userList-container">
    <table class="users-table">
        <thead>
            <tr>
                <th>Login</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr class="user-row">
                        <td class="user-login"><?= htmlspecialchars($user["login"]) ?></td>
                        <td class="user-email"><?= htmlspecialchars($user["email"]) ?></td>
                        <td class="user-role">
                            <form method="POST" action="/user-list" class="action-form">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <select name="role" class="role-dropdown">
                                    <?php foreach ($roles as $roleName => $roleValue): ?>
                                        <option value="<?= $roleValue ?>" <?= $user['role'] == $roleValue ? 'selected' : '' ?>>
                                            <?= $roleName ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                        </td>
                        <td class="user-actions">
                                <button type="submit" name="action" value="edit" class="btn edit-btn">Sauvegarder</button>
                                <button type="submit" name="action" value="delete" class="btn delete-btn">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun utilisateur à afficher.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
