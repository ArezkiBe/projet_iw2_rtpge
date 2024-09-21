<h2>Modifier la page</h2>

<form id="page-form" method="POST" action="/page-edit?id=<?= $page->getId(); ?>">
    <!-- Champ pour modifier le titre de la page -->
    <label for="title">Titre de la page</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($page->getTitle()); ?>" required>
    <br>

    <!-- Page Builder pour modifier le contenu -->
    <input type="hidden" id="content" name="content">
    <div id="gjs" style="height: 500px; border: 1px solid #ccc;">
        <?= $page->getContent(); ?>
    </div>

    <br>
    <button type="submit">Enregistrer les modifications</button>
</form>

<!-- Intégration de GrapesJS -->
<link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet"/>
<script src="https://unpkg.com/grapesjs"></script>
<script src="https://unpkg.com/grapesjs-preset-webpage"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editor = grapesjs.init({
            container: '#gjs',
            fromElement: true,
            height: '500px',
            width: 'auto',
            storageManager: { type: null }, // Désactiver le stockage automatique pour GrapesJS
            plugins: ['gjs-preset-webpage'], // Utilisation du plugin pour enrichir l'éditeur
            pluginsOpts: {
                'gjs-preset-webpage': {} // Configurations supplémentaires du plugin si nécessaire
            }
        });

        const blockManager = editor.BlockManager;
        editor.addComponents('<link rel="stylesheet" href="../../dist/css/style.css" />');

        // Bloc de texte
        blockManager.add('text', {
            label: 'Texte',
            content: '<p>Ceci est un texte éditable</p>',
            category: 'Basic',
            attributes: { class: 'fa fa-text' }
        });

        // Bloc d'image
        blockManager.add('image', {
            label: 'Image',
            content: '<img src="https://via.placeholder.com/350x150" alt="Image" />',
            category: 'Basic',
            attributes: { class: 'fa fa-image' }
        });

        // Bloc de bouton
        blockManager.add('button', {
            label: 'Bouton',
            content: '<button class="button button-secondary button-sm">Cliquez ici</button>',
            category: 'Basic',
            attributes: { class: 'fa fa-button' }
        });

        // Bloc de section
        blockManager.add('section', {
            label: 'Section',
            content: '<section><h1>Titre de la section</h1><p>Contenu de la section...</p></section>',
            category: 'Basic',
            attributes: { class: 'fa fa-section' }
        });

        // Bloc pour le slider
        blockManager.add('slider', {
            label: 'Slider',
            content: `
                <div class="slider" data-width="600" data-height="400">
                    <img src="https://via.placeholder.com/600x400" alt="Image 1">
                    <img src="https://via.placeholder.com/600x400" alt="Image 2">
                    <img src="https://via.placeholder.com/600x400" alt="Image 3">
                </div>
            `,
            category: 'Components',
            attributes: { class: 'fa fa-sliders' }
        });

        // Bloc pour le système de grille
        blockManager.add('grid', {
            label: 'Grid',
            content: `
                <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <div class="grid-item">Colonne 1</div>
                    <div class="grid-item">Colonne 2</div>
                </div>
            `,
            category: 'Layout',
            attributes: { class: 'fa fa-th' }
        });

        // Sauvegarder le contenu lors de la soumission du formulaire
        document.getElementById('page-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire
            document.getElementById('content').value = editor.getHtml();
            document.getElementById('page-form').submit(); // Soumet le formulaire avec le contenu de GrapesJS
        });
    });
</script>
