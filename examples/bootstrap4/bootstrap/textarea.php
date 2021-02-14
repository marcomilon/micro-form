<div class="form-group">
    <label for="<?= $attributes['for'] ?>"><?= $attributes['label'] ?></label>
    <textarea <?= \micro\expandAttr($attributes, ['tag', 'for', 'label']) ?>></textarea>
</div>