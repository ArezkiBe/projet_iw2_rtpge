     <!-- Dans votre vue approved_reviews.php -->
<h1>En attente de Moderation</h1>

<?php if (!empty($review)): ?>
    <?php foreach ($review as $rev): ?>
          <div class="review">
               <p><?= $rev["content"]?></p>
               <p>Créé le <?= $rev["created"] ?></p>
               <form action="/myreview" method="POST">
                    <input type="hidden"  value="<?php echo $rev['id']; ?>" name="id">
                    <?php $this->modal("form", $form) ?>
               </form>
          </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune critique à afficher.</p>
<?php endif; ?>
