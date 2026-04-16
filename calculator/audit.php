<p class="text-center text-white"> AMFI Registered mutual fund Distributor
    <?= !empty($config['rvuserinfo']['arn']) ? ' | ARN- ' . $config['rvuserinfo']['arn'] : '' ?>
    <?= !empty($config['rvuserinfo']['arn_start_date']) ? ' | Current Validity: ' . $config['rvuserinfo']['arn_start_date'] : '' ?>
    <?= !empty($config['rvuserinfo']['arn_end_date']) ? 'TO ' . $config['rvuserinfo']['arn_end_date'] : '' ?>
    <?= !empty($config['rvuserinfo']['euin']) ? ' | EUIN- ' . $config['rvuserinfo']['euin'] : '' ?>
    <?= !empty($config['rvuserinfo']['euin_start_date']) ? ' | Current Validity: ' .  $config['rvuserinfo']['euin_start_date'] : '' ?>
    <?= !empty($config['rvuserinfo']['euin_end_date']) ? 'TO ' .  $config['rvuserinfo']['euin_end_date'] : '' ?>
</p>
 
<div class="legal-links text-center text-white mt-4 mb-4">
    <?php foreach($rvauditlink as  $key =>  $linkitems){?>
    <a class="text-white" href="<?= $linkitems['url'] ?>"
        <?= !empty($linkitems['target']) ? 'target="' . $linkitems['target'] .'"' : '' ?>><?= $linkitems['title'] ?></a>
    <?php if($key < count($rvauditlink) - 1): ?> | <?php endif; ?>
    <?php } ?>
</div>

<div style="--rvcfo-color:var(--rv-white);  text-align:center;"><?= $footerContent = rv_fetchfooterContent($config['rvuserinfo']['websitename']);?></div>