<?php 
    // Template variables
    $for = isset($id) ? " for=\"$id\"" : "";
    $id = isset($id) ? " id=\"$id\"" : "";
    $value = isset($value) ? $value : "";
    $rows = isset($row) ? $row : '3';
    $placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
?>
<div class="form-group">
    <label<?= $for ?>><?= $label ?></label>
    <textarea class="form-control"<?= $id ?> rows="<?= $rows ?>" name="<?= $name ?>"><?= $value ?></textarea>
</div>