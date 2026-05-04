<div class="rvafootercolor"  style="--rvcfo-color:var(--rv-white); --rvatextalign:center; --rva-ateg:var(--rv-secondary);">
    <div class="text-center"> 
          <?=  rv_fetchDynamic('footer-content', $config_data); ?>
</div>
    <div class="legal-links text-center   mt-2 mb-2">
        <?php  $filtered = array_filter($rvasallaudits, function($item) { return $item['id'] != 15; });
            $total = count($filtered);
            $rvi = 0;
            foreach($filtered as $linkitems){
            ?>
            <a href="<?= $linkitems['rvasurl'] ?>" 
                <?= !empty($linkitems['target']) ? 'target="'.$linkitems['target'].'"' : '' ?> 
                <?= !empty($linkitems['download']) ? 'download' : '' ?>>
                <?= $linkitems['title'] ?>
            </a>
            <?php if($rvi < $total - 1): ?> | <?php endif; ?>
        <?php $rvi++; }  ?>
    </div>
    <p >
        <small>
            <?=  rv_fetchDynamic('audit-content', $config_data); ?>
        </small>
    </p>
    <div><?=  rv_fetchDynamic('amfimfsh-img', $config_data); ?></div>
</div>
<?=  $cookiedata = rv_fetchDynamic('cookie-banner', $config_data); ?>