<?php 
    // Template variables
    $for = isset($id) ? " for=\"$id\"" : "";
    $id = isset($id) ? " id=\"$id\"" : "";
    $value = isset($value) ? " value=\"$value\"" : "";
    $placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
?>
<div class="form-group">
    <label<?= $for ?>><?= $label ?></label>
    <input type="<?= $input ?>" class="form-control" name="<?= $name ?>"<?= $placeholder . $id . $value ?>>
</div>