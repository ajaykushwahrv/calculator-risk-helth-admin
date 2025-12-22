<?php $rvauditlink = [
    [ 'title' => 'Risk Factors','url' => $config['rvuserinfo']['base_url'] . '/risk-factors.php', 'target' => '_self' ],
    [ 'title' => 'Terms & Conditions','url' => $config['rvuserinfo']['base_url'] . '/terms-conditions.php', 'target' => '_self' ],
    [ 'title' => 'SID/SAI/KIM','url' => 'https://www.sebi.gov.in/filings/mutual-funds.html', 'target' => '_blank'],
    [ 'title' => 'Code of Conduct','url' => $config['rvuserinfo']['base_url'] . 'images/AMFI_Code-of-Conduct.pdf', 'target' => '_blank' ],
    [ 'title' => 'Investor Grievance Redressal','url' => $config['rvuserinfo']['base_url'] . '/investor-grievance-redressal.php', 'target' => '_self' ],
    [ 'title' => 'Important Links','url' => $config['rvuserinfo']['base_url'] . '/important-links.php', 'target' => '_self' ],
    [ 'title' => 'SEBI Circulars','url' => 'https://www.sebi.gov.in/sebiweb/home/HomeAction.do?doListingAll=yes&search=Mutual+Funds', 'target' => '_blank' ],
    [ 'title' => 'Privacy Policy','url' => $config['rvuserinfo']['base_url'] . '/privacy-policy.php', 'target' => '_self' ],
    [ 'title' => 'Commission Disclosures','url' => $config['rvuserinfo']['base_url'] . '/commission-disclosures.php', 'target' => '_self']
    ];
?>
<div class="legal-links">
    <?php foreach($rvauditlink as  $key =>  $linkitems){?>
    <a href="<?= $linkitems['url'] ?>"  <?= !empty($linkitems['target']) ? 'target="' . $linkitems['target'] .'"' : '' ?> ><?= $linkitems['title'] ?></a> <?php if($key < count($rvauditlink) - 1): ?> | <?php endif; ?>
    <?php } ?>
</div>