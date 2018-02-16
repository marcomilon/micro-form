<div class="toolbar--add">
    <a href="#" class="toolbar--add__add">Add Item</a>
</div>
<div class="repeater">
    <div class="element">
        <?php if($repeat): ?>
            <div class="toolbar--delete">
                <a href="#" class="toolbar--delete__delete">Delete Item</a>
            </div>
        <?php endif; ?>
        <?= $output ?>
    </div>
</div>