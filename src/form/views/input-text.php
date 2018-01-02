<div class="form-group">
    <label<?= isset($id) ? ' for="'. $id . '"' : '' ?>><?= $label ?></label>
    <input type="<?= $input ?>" class="form-control" name="<?= $name ?>"<?= isset($placeholder) ? ' placeholder="' . $placeholder . '"' : ''?><?= isset($id) ? ' id="' . $id . '"' : ''?>>
</div>