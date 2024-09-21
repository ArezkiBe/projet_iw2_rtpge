<div class="reviewsMod-container">
     <?php if (!empty($review)): ?>
          <table class="reviewsMod-table">
               <thead>
                    <tr>
                         <th>En attente de modération</th>
                         <th>Actions</th>
                    </tr>
               </thead>
               <tbody>

                    <?php foreach ($review as $rev): ?>
                         <tr class="review-row">
                              <td class="review-content">
                                   <p><?= $rev["content"] ?></p>
                                   <p class="review-date">Créé le <?= $rev["created"] ?></p>
                              </td>
                              <td class="review-actions">
                                   <form method="POST" action="/review-manager" class="action-form">
                                        <input type="hidden" value="<?php echo $rev['id']; ?>" name="id">
                                        <button type="submit" name="action" value="approve" class="btn approve-btn">Valider</button>
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