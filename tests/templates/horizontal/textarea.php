<?php 
    // Template variables
    $for = isset($id) ? " for=\"$id\"" : "";
    $id = isset($id) ? " id=\"$id\"" : "";
    $value = isset($value) ? $value : "";
    $rows = isset($row) ? $row : '3';
    $placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
?>
<div class="form-group row">
    <label<?= $for ?> class="col-sm-2 col-form-label"><?= $label ?></label>
    <div class="col-sm-10">
        <textarea class="form-control"<?= $id ?> rows="<?= $rows ?>" name="<?= $name ?>"><?= $value ?></textarea>
    </div>
</div>