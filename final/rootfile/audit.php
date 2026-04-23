<?php $rvaslug = $_GET['slug']; ?>
<?php 
    foreach ($rvasallaudit as $rvasitems) {
    if ($rvaslug == $rvasitems['rvcurl']) {
?>
        <?= $rvasitems['rvcurl'];?> 
        <?= $rvasitems['title'];?> 
        <?= $rvasitems['content']();?>
<?php 
    $rvasfound = true;
    break;
    } }
    if (!$rvasfound) {
        header("Location: /rv-not-found.php");
    }
?>
