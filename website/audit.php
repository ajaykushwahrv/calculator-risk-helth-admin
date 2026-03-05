<p class="text-center text-white"> AMFI Registered mutual fund Distributor |
    <?= !empty($config['rvuserinfo']['arn']) ? 'ARN- ' . $config['rvuserinfo']['arn'] : '' ?>
    <?= !empty($config['rvuserinfo']['arn_start_date']) ? 'Current Validity: ' . $config['rvuserinfo']['arn_start_date'] : '' ?>
    <?= !empty($config['rvuserinfo']['arn_end_date']) ? 'TO ' . $config['rvuserinfo']['arn_end_date'] : '' ?> |
    <?= !empty($config['rvuserinfo']['euin']) ? 'EUIN- ' . $config['rvuserinfo']['euin'] : '' ?>
    <?= !empty($config['rvuserinfo']['euin_start_date']) ? 'Current Validity: ' .  $config['rvuserinfo']['euin_start_date'] : '' ?>
    <?= !empty($config['rvuserinfo']['euin_end_date']) ? 'TO ' .  $config['rvuserinfo']['euin_end_date'] : '' ?>
</p>
<?php $rvauditlink = [
    [ 'title' => 'Risk Factors','url' => $config['rvuserinfo']['base_url'] . '/risk-factors.php', 'target' => '_self' ],
    [ 'title' => 'Terms & Conditions','url' => $config['rvuserinfo']['base_url'] . '/terms-conditions.php', 'target' => '_self' ],
    [ 'title' => 'SID/SAI/KIM','url' =>  $sid = rv_fetchSidsaikim(), 'target' => '_blank'],
    [ 'title' => 'Code of Conduct','url' =>  $cConduct = rv_fetchCodeofConduct(), 'target' => '_blank' ],
    [ 'title' => 'Investor Grievance Redressal','url' => $config['rvuserinfo']['base_url'] . '/investor-grievance-redressal.php', 'target' => '_self' ],
    [ 'title' => 'Important Links','url' => $config['rvuserinfo']['base_url'] . '/important-links.php', 'target' => '_self' ],
    [ 'title' => 'SEBI Circulars','url' =>  $sebiCirculars = rv_fetchCirculars(), 'target' => '_blank' ],
    [ 'title' => 'Privacy Policy','url' => $config['rvuserinfo']['base_url'] . '/privacy-policy.php', 'target' => '_self' ],
    [ 'title' => 'Commission Disclosures','url' => $config['rvuserinfo']['base_url'] . '/commission-disclosures.php', 'target' => '_self']
    ];
?>
<div class="legal-links text-center text-white mt-4 mb-4">
    <?php foreach($rvauditlink as  $key =>  $linkitems){?>
    <a class="text-white" href="<?= $linkitems['url'] ?>"
        <?= !empty($linkitems['target']) ? 'target="' . $linkitems['target'] .'"' : '' ?>><?= $linkitems['title'] ?></a>
    <?php if($key < count($rvauditlink) - 1): ?> | <?php endif; ?>
    <?php } ?>
</div>