<select <?= \micro\expantAttr($attributes) ?>>
<?php foreach($options as $option): ?>
    <option <?= \micro\expantAttr($option['attributes']) ?>><?= $option['label'] ?></option>
<?php endforeach; ?>
</select>