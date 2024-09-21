<div class="comments-container">
    <div class="comments-box">
        <h2>Commentaires</h2>
        <?php foreach ($review as $rev): ?>
            <div class="comment">
                <p class="comment-author"><?= isset($rev["userName"]) ? $rev["userName"] : "Anonyme" ?></p>
                <p class="comment-content"><?= $rev["content"] ?></p>
                <p class="comment-date">Créé le <?= $rev["created"] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>