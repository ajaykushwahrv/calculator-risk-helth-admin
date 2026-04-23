<?php if(!empty($config['rvuserinfo']['mfarn'])){ ?>
<p class="text-center text-white">
    <?= 'AMFI Registered Mutual Fund Distributor | ARN- ' . $config['rvuserinfo']['mfarn'] ?>
    <?= !empty($config['rvuserinfo']['mfarnDate_start']) ? ' | Validity: ' . $config['rvuserinfo']['mfarnDate_start'] : '' ?>
    <?= !empty($config['rvuserinfo']['mfarnDate_end']) ? ' TO ' . $config['rvuserinfo']['mfarnDate_end'] : '' ?>
</p>
<?php } ?>

<?php if(!empty($config['rvuserinfo']['apmi'])){ ?>
<p class="text-center text-white">
    <?= 'APMI Registered PMS Distributor | APRN ' . $config['rvuserinfo']['apmi'] ?>
    <?= !empty($config['rvuserinfo']['apmiDate_start']) ? ' | Validity: ' . $config['rvuserinfo']['apmiDate_start'] : '' ?>
    <?= !empty($config['rvuserinfo']['apmiDate_end']) ? ' TO ' . $config['rvuserinfo']['apmiDate_end'] : '' ?>
</p>
<?php } ?>

<?php if(!empty($config['rvuserinfo']['irdai'])){ ?>
<p class="text-center text-white">
    <?= 'IRDAI Registered Insurance Distributor | IRDAI ' . $config['rvuserinfo']['irdai'] ?>
    <?= !empty($config['rvuserinfo']['irdaiDate_start']) ? ' | Validity: ' . $config['rvuserinfo']['irdaiDate_start'] : '' ?>
    <?= !empty($config['rvuserinfo']['irdaiDate_end']) ? ' TO ' . $config['rvuserinfo']['irdaiDate_end'] : '' ?>
</p>
<?php } ?>
 
<div class="legal-links text-center text-white mt-4 mb-4">
    <?php foreach($rvasallaudits as  $key =>  $linkitems){ if ( $linkitems['id'] == 15) { continue; }?>
    <a class="text-white" href="<?= $linkitems['rvasurl'] ?>"
        <?= !empty($linkitems['target']) ? 'target="' . $linkitems['target'] .'"' : '' ?>><?= $linkitems['title'] ?></a>
    <?php if($key < count($rvasallaudits) - 1): ?> | <?php endif; ?>
    <?php } ?>
</div>


<div style="--rvcfo-color:var(--rv-white);  text-align:center;"><?=  rv_fetchDynamic('audit-content', $config_data); ?></div>

<p><b>We are not a SEBI Registered Investment Adviser. We distribute financial products and do not provide investment advisory services.</b></p>
<p class="text-center text-white">
    <?php if(!empty($config['rvuserinfo']['gstin'])){ ?><?= '<b>GSTIN:</b> ' . $config['rvuserinfo']['gstin'] ?><?php } ?>
    <?= !empty($config['rvuserinfo']['address']) ? ' | <b>Office:</b> ' . $config['rvuserinfo']['address'] : '' ?>
</p>

 
<p class="text-center text-white">
    <b>Grievance Redressal Officer: </b>
    <?= !empty($config['rvuserinfo']['clientname']) ? $config['rvuserinfo']['clientname'] : '' ?>
    <?= !empty($config['rvuserinfo']['email']) ? ' | <a href="tel:+91' .$config['rvuserinfo']['email']. '">' .$config['rvuserinfo']['email']. '</a>' : '' ?>
    <?= !empty($config['rvuserinfo']['mobile']) ? ' | <a href="tel:+91' .$config['rvuserinfo']['mobile']. '">' .$config['rvuserinfo']['mobile']. '</a>' : '' ?>
</p>
 

<div><?=  rv_fetchDynamic('amfimfsh-img', $config_data); ?></div>
