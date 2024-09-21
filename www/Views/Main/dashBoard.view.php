<h2>Dashboard</h2>
<div class="dashboard">
    <div class="dashboard-grid">
        <!-- Bloc pour les utilisateurs -->
        <div class="dashboard-card">
            <h3>Utilisateurs</h3>
            <p>Total : <?= $totalUsers; ?></p>
            <a href="/admin/users" class="button button-primary">Gérer les utilisateurs</a>
        </div>

        <!-- Bloc pour les pages -->
        <div class="dashboard-card">
            <h3>Pages</h3>
            <p>Total : <?= $totalPages; ?></p>
            <a href="/admin/pages" class="button button-primary">Gérer les pages</a>
        </div>
    </div>
</div>