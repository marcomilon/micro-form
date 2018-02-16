<div class="toolbar--add">
    <a href="#" class="<?= $block ? 'toolbar--add__block' : 'toolbar--add__add' ?>">Add Item</a>
</div>
<div class="repeater">
    <div class="element">
        <?php if($repeat): ?>
            <div class="toolbar--delete" style="display:none">
                <a href="#" class="toolbar--delete__delete">Delete Item</a>
            </div>
        <?php endif; ?>
        <?= $output ?>
    </div>
</div>