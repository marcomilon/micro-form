<div class="new-item">
    <a href="#" id="new-item__button-<?= $uniqueId ?>" class="new-item__button">New Item</a>
</div>
<div class="repeater" id="repeater-<?= $uniqueId ?>">
    <?= $isBlock ? '<div id="'.$blockId.'" class="repeater__block">' : '' ?>
    <?= $output ?>
    <?= $isBlock ? '</div>' : '' ?>
</div>
<script>
document.getElementById("new-item__button-<?= $uniqueId ?>").addEventListener("click", function() {    
    var itm = document.getElementById("repeater-<?= $uniqueId ?>").lastElementChild;
    var cln = itm.cloneNode(true);
    document.getElementById("repeater-<?= $uniqueId ?>").appendChild(cln);
});
</script>