<div>
    <a href="#" id="add-element">Add Item</a>
</div>
<div id="repeater">
    <?= $output ?>
</div>
<script>
document.getElementById("add-element").addEventListener("click", function() {    
    var itm = document.getElementById("repeater").lastElementChild;
    var cln = itm.cloneNode(true);
    document.getElementById("repeater").appendChild(cln);
});
</script>