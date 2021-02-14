<div class="form-group">
  <label for="<?= $attributes['for'] ?>"><?= $attributes['label'] ?></label>
  <input <?= \micro\expandAttr($attributes, ['tag', 'for', 'label']) ?>>
  <?php if (isset($attributes['tip'])) : ?>
    <small class="form-text text-muted"><?= $attributes['tip'] ?></small>
  <?php endif ?>
</div>