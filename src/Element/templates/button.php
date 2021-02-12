<button <?= \micro\expandAttr($attributes, ['tag', 'value']) ?>>
<?= $attributes['value'] ?? 'Submit' ?>
</button>