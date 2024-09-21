<!-- views/back/unapproved_reviews.php -->

<h1>Avis en attente d'approbation</h1>

<?php foreach ($unapprovedReviews as $review): ?>
    <div class="review">
        <p><?= $review->getContent() ?></p>
        <p>Créé le <?= $review->getCreated() ?></p>
        <form action="/approve-review" method="post">
            <input type="hidden" name="review_id" value="<?= $review->getId() ?>">
            <button type="submit">Approuver</button>
        </form>
    </div>
<?php endforeach; ?>
