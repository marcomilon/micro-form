<div class="form-group">
    <label<?= isset($id) ? ' for="'. $id . '"' : '' ?>><?= $label ?></label>
    <input type="<?= $inputType ?>" class="form-control" name="<?= $name ?>"<?= isset($placeholder) ? ' placeholder="' . $placeholder . '"' : ''?><?= isset($id) ? ' id="' . $id . '"' : ''?>>
</div>