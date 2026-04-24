    <?php $rvaslug = $_GET['slug']; ?>
<?php 
    foreach ($rvasallaudits as $rvasitems) {
        $rvasfile = $rvasitems['rvasfile'] ?? '';
    if ($rvaslug == $rvasfile) {

?>
     
        <?= $rvasitems['title'];?> 
         <?=  rv_fetchDynamic($rvaslug, $config_data); ?>
<?php 
    $rvasfound = true;
    break;
    } }
    if (!$rvasfound) {
        header("Location: /rv-not-found.php");
    }
?>
