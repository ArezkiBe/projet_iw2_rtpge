<?php if (!empty($errors)): ?>
  <div style="background-color: red;">
    <?php echo implode("<br>", $errors); ?>
  </div>
<?php endif; ?>


<form
  action="<?= $config["config"]["action"] ?? "" ?>"
  method="<?= $config["config"]["method"] ?? "POST" ?>"
  id="<?= $config["config"]["id"] ?? "" ?>"
  class="<?= $config["config"]["class"] ?? "" ?>">

  <div class="input-group">
    <?php foreach ($config["elements"]["inputs"] as $name => $input): ?>
      <label for="<?= $input["id"] ?? "" ?>"> <?= $input["label"] ?>
      </label>
      <input
        name="<?= $name ?>"
        type="<?= $input["type"] ?? "text" ?>"
        class="<?= $input["class"] ?? "" ?>"
        value="<?= $input["value"] ?? "" ?>"
        id="<?= $input["id"] ?? "" ?>"
        placeholder="<?= $input["placeholder"] ?? "" ?>"
        <?= $input["required"] ? "required" : ""  ?>><br>
    <?php endforeach; ?>
  </div>

  <?php if (isset($config["elements"]["dropdowns"])): ?>
    <div class="dropdown-wrapper">
      <?php foreach ($config["elements"]["dropdowns"] as $name => $dropdown): ?>
        <label class="dropdown-label" for="<?= $dropdown["id"] ?? "" ?>"> <?= $dropdown["label"] ?>
        </label>
        <div class="dropdown">
          <select id="<?= $dropdown["id"] ?? "" ?>" name="<?= $name ?>" class="dropdown-select">
            <?php foreach ($dropdown["values"] as $value): ?>
              <option value="<?= $value ?>"><?= $value ?></option>
            <?php endforeach; ?>
          </select>
        </div><br>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>



  <input type="submit" class="<?= $config["config"]["class"] ?? "" ?>" value="<?= $config["config"]["submit"] ?? "Envoyer" ?>">
</form>