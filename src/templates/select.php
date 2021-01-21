<select <?= _attr($attributes) ?>>
<?php foreach($options as $option): ?>
    <option <?= _attr($option['attributes']) ?>><?= $option['label'] ?></option>
<?php endforeach; ?>
</select>