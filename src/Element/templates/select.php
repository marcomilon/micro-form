<select <?= \micro\expandAttr($attributes, ['tag', 'value']) ?>>
<?php foreach($attributes['value'] as $option): ?>
    <option <?= \micro\expandAttr($option, ['label', 'tag']) ?>><?= $option['label'] ?></option>
<?php endforeach; ?>
</select>