<div class="form-group">
    <label for="<?= $attributes['for'] ?>"><?= $attributes['label'] ?></label>
    <select <?= \micro\expandAttr($attributes, ['tag', 'value']) ?> class="form-select">
        <?php foreach ($attributes['value'] as $option) : ?>
            <option <?= \micro\expandAttr($option, ['label', 'tag']) ?>><?= $option['label'] ?></option>
        <?php endforeach; ?>
    </select>
</div>