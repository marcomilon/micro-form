<?php 
// Template variables
$for = isset($id) ? " for=\"$id\"" : "";
$id = isset($id) ? " id=\"$id\"" : "";
$placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
?>
<div class="form-group">
    <label<?= $for ?>><?= $label ?></label>
    <select class="form-control" name="<?= $name ?>"<?= $placeholder . $id ?>>
        <?php foreach($options as $key => $value): ?>
            <option values="<?= $key ?>"><?= $value ?></option>
        <?php endforeach; ?>
    </select>
</div>