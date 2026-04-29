<div class="">
    <div class="text-center"> 
          <?=  rv_fetchDynamic('footer-content', $config_data); ?>
</div>
    <div class="legal-links text-center   mt-2 mb-2">
        <?php $rvi=1; foreach($rvasallaudits as     $linkitems){ if ( $linkitems['id'] == 15) { continue; }?>
        <a class=" " href="<?= $linkitems['rvasurl'] ?>" <?= !empty($linkitems['target']) ? 'target="' . $linkitems['target'] .'"' : '' ?> <?= !empty($linkitems['download']) ? 'download' : '' ?>><?= $linkitems['title'] ?></a>
        <?php if($rvi < count($rvasallaudits) - 1): ?>   | <?php endif; ?>
        <?php $rvi++; } ?>
    </div>
    <p style="--rvcfo-color:var(--rv-white);  text-align:center;">
        <small>
            <?=  rv_fetchDynamic('audit-content', $config_data); ?>
        </small>
    </p>
    <div><?=  rv_fetchDynamic('amfimfsh-img', $config_data); ?></div>
</div>
<?=  $cookiedata = rv_fetchDynamic('cookie-banner', $config_data); ?>