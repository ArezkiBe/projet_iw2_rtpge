<!-- <div class="comments-container">
    <div class="comments-box">
        <h2>Commentaires</h2>
        <?php foreach ($reviews as $rev): ?>
            <div class="comment">
                <p class="comment-author"><?= isset($rev["userName"]) ? $rev["userName"] : "Anonyme" ?></p>
                <p class="comment-content"><?= $rev["content"] ?></p>
                <p class="comment-date">Créé le <?= $rev["created"] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div> -->

<div class="allReviews-container">
     <?php if (!empty($reviews)): ?>
          <table class="allReviews-table">
               <thead>
                    <tr>
                         <th>Commentaire</th>
                         <th>Etat</th>
                         <th>Actions</th>
                    </tr>
               </thead>
               <tbody>

                    <?php foreach ($reviews as $rev): ?>
                         <tr class="review-row">
                              <td class="review-content">
                                   <p><?= $rev["content"] ?></p>
                                   <p class="review-date">Créé le <?= $rev["created"] ?></p>
                              </td>
                              <td class="review-state">
                                   <p class="review-date"><?= $rev["approved"] ? "approuvé" : "en attente" ?></p>
                              </td>
                              <td class="review-actions">
                                   <form method="POST" action="/reviews" class="action-form">
                                        <input type="hidden" value="<?php echo $rev['id']; ?>" name="id">
                                        <button type="submit" name="action" value="delete" class="btn delete-btn">Supprimer</button>
                                   </form>
                              </td>
                         </tr>
                    <?php endforeach; ?>


               </tbody>
          </table>
     <?php else: ?>
          <p>Aucune critique à afficher.</p>
     <?php endif; ?>
</div>