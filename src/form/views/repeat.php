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
    
    var inputNodes = cln.getElementsByTagName('input');
    for(var i = 0; i < inputNodes.length; i++){
        var inputNode = inputNodes[i];
        var index = inputNode.name.match(/[0-9]+/);
        var tokens = inputNode.name.split(/[0-9]+/);
        
        var newIndex = parseInt(index) + 1;
        var name = tokens[0] + newIndex + tokens[1];
        inputNode.name = name;
        inputNode.value = '';
    }
    
    document.getElementById("repeater-<?= $uniqueId ?>").appendChild(cln);
});
</script>