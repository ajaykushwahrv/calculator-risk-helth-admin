<?php   
    $rvaslug = $_GET['slug'];

    $rvaspages = [
        [
            "title" => "Risk Factors",
            "rvasurl" => "risk-factors",
            "content" => function() {
                return rv_fetchRiskFactors();
            }
        ],
        [
            "title" => "Terms & Conditions",
            "rvasurl" => "terms-conditions",
            "content" => function() {
                return rv_fetchTermsConditions();
            }
        ],
        [
            "title" => "Investor Grievance Redressal",
            "rvasurl" => "investor-grievance-redressal",
            "content" => function() use ($config) {
                return  rv_fetchInvestorGrievanceRedressal([
                        'clientname' => $config['rvuserinfo']['clientname'],
                        'websitename' => $config['rvuserinfo']['websitename'],
                        'mobile'      => $config['rvuserinfo']['mobile'],
                        'email'       => $config['rvuserinfo']['email'],
                        'address'     => $config['rvuserinfo']['address'],
                ]);
            
            }
        ],
        [
            "title" => "Important Links",
            "rvasurl" => "important-links",
            "content" => function() {
                return rv_fetchImportantLinks();
            }
        ],
        [
            "title" => "Privacy Policy",
            "rvasurl" => "privacy-policy",
            "content" => function() use ($config) {
                return rv_fetchPrivacyPolicy(
                    $config['rvuserinfo']['websitename'],
                    $config['rvuserinfo']['email']
                );
            }
        ],
        [
            "title" => "Commission Disclosures",
            "rvasurl" => "commission-disclosures",
            "content" => function() {
                return rv_fetchCommissionDisclosures();
            }
        ],
    ];
?>
<?php 
    foreach ($rvaspages as $rvasitems) {
        if ($rvaslug == $rvasitems['rvasurl']) {
?>
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
