<?php 
    // Template variables
    $for = isset($id) ? " for=\"$id\"" : "";
    $id = isset($id) ? " id=\"$id\"" : "";
    $value = isset($value) ? " value=\"$value\"" : "";
    $placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
?>
<div class="form-group row">
    <label<?= $for ?> class="col-sm-2 col-form-label"><?= $label ?></label>
    <div class="col-sm-10">
        <input type="<?= $input ?>" class="form-control" name="<?= $name ?>"<?= $placeholder . $id . $value ?>>
    </div>
</div>