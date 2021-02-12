<select <?= \micro\expandAttr($attributes) ?>>
<?php foreach($options as $option): ?>
    <option <?= \micro\expandAttr($option['attributes']) ?>><?= $option['label'] ?></option>
<?php endforeach; ?>
</select>