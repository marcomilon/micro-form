<div class="form-group">
    <label<?= isset($id) ? ' for="'. $id . '"' : '' ?>><?= $label ?></label>
    <textarea class="form-control"<?= isset($id) ? ' id="' . $id . '"' : ''?> rows="<?= isset($row) ? $row : '3' ?>" name="<?= $name ?>"><?= isset($value) ? $value : '' ?></textarea>
</div>