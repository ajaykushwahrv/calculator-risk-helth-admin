<div class="">
    <p class="text-center"> 
        <?php if(!empty($config['rvuserinfo']['mfarnDate'])){ ?><b><?=  $config['rvuserinfo']['websitename'] ?></b> </br><?php } ?> 
        <?php if(!empty($config['rvuserinfo']['mfarnDate'])){ ?><b><?=  $config['rvuserinfo']['mfarnDate'] ?></b></br><?php } ?>
        <?php if(!empty($config['rvuserinfo']['apmiDate'])){ ?><b><?=  $config['rvuserinfo']['apmiDate'] ?></b></br><?php } ?>
        <?php if(!empty($config['rvuserinfo']['irdaiDate'])){ ?><b><?=  $config['rvuserinfo']['irdaiDate'] ?></b></br><?php } ?>
    </p>
    <div class="legal-links text-center   mt-2 mb-2">
        <?php $rvi=1; foreach($rvasallaudits as     $linkitems){ if ( $linkitems['id'] == 15) { continue; }?>
        <a class=" " href="<?= $linkitems['rvasurl'] ?>" <?= !empty($linkitems['target']) ? 'target="' . $linkitems['target'] .'"' : '' ?>><?= $linkitems['title'] ?></a>
        <?php if($rvi < count($rvasallaudits) - 1): ?>   | <?php endif; ?>
        <?php $rvi++; } ?>
    </div>
    <p style="--rvcfo-color:var(--rv-white);  text-align:center;">
        <small>
            <?=  rv_fetchDynamic('audit-content', $config_data); ?>
            <?php if(!empty($config['rvuserinfo']['gstin'])){ ?><?= '<b>GSTIN:</b> ' . $config['rvuserinfo']['gstin'] . ' | '?><?php } ?>
            <?= !empty($config['rvuserinfo']['address']) ? '<b>Office:</b> ' . $config['rvuserinfo']['address'] : '' ?>
            </br>    
            <b>Grievance Redressal Officer: </b>
            <?= !empty($config['rvuserinfo']['clientname']) ? $config['rvuserinfo']['clientname'] : '' ?>
            <?= !empty($config['rvuserinfo']['email']) ? ' | <a href="tel:+91' .$config['rvuserinfo']['email']. '">' .$config['rvuserinfo']['email']. '</a>' : '' ?>
            <?= !empty($config['rvuserinfo']['mobile']) ? ' | <a href="tel:+91' .$config['rvuserinfo']['mobile']. '">' .$config['rvuserinfo']['mobile']. '</a>' : '' ?>
        </small>
    </p>
    <div><?=  rv_fetchDynamic('amfimfsh-img', $config_data); ?></div>
</div>