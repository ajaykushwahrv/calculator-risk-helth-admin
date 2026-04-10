^Numpad0::
Clipboard =
(
require __DIR__ . '/rvm-include/config.php';
)
Send, ^v
return


^Numpad1::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\audit.php
Clipboard := fileContent
Send, ^v
return


^Numpad2::
Clipboard =
(
 <?= $footerContent = rv_fetchfooterContent($config['rvuserinfo']['websitename']);?>
)
Send, ^v
return

^Numpad3::
Clipboard =
(
<?= $risk_factors =  rv_fetchRiskFactors();?>
)
Send, ^v
return

          
^Numpad4::
Clipboard =
(
<?= $termsconditions = rv_fetchTermsConditions();?>
)
Send, ^v
return


^Numpad5::
Clipboard =
(
<?= rv_fetchInvestorGrievanceRedressal([
        'clientname' => $config['rvuserinfo']['clientname'],
        'websitename' => $config['rvuserinfo']['websitename'],
        'mobile'      => $config['rvuserinfo']['mobile'],
        'email'       => $config['rvuserinfo']['email'],
        'address'     => $config['rvuserinfo']['address'],
    ]);
?>
)
Send, ^v
return


^Numpad6::
Clipboard =
(
<?= $ImportantLinksData = rv_fetchImportantLinks(); ?>
)
Send, ^v
return


^Numpad7::
Clipboard =
(
<?= $privacy_policy = rv_fetchPrivacyPolicy($config['rvuserinfo']['websitename'], $config['rvuserinfo']['email']); ?>
)
Send, ^v
return

          

^Numpad8::
Clipboard =
(
<?= $commission_disclosures = rv_fetchCommissionDisclosures(); ?>
)
Send, ^v
return


^Numpad9::
Clipboard =
(
<span style="--rvc-color:var(--rv-secondary)"><?=  $copyrightdata = rv_fetchCopyright();?></span>
)
Send, ^v
return

          


!Numpad0::
Clipboard =
(
$callbackUrl = rtrim($config['rvuserinfo']['base_url'], '/') . '/' . ltrim($config['rvlogin']['callbackUrl'], '/');
$siteUrl = !empty($config['rvlogin']['wheatlebalsiteUrl']) ? $config['rvlogin']['wheatlebalsiteUrl'] : $config['rvlogin']['siteUrl'];
)
Send, ^v
return


!Numpad1:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\login-page.php
Clipboard := fileContent
Send, ^v
return 

          
!Numpad2::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\silver-category.php
Clipboard := fileContent
Send, ^v
return


!Numpad3::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\gold-category.php
Clipboard := fileContent
Send, ^v
return


!Numpad4::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\platinum-category.php
Clipboard := fileContent
Send, ^v
return
 

!Numpad5::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\fund-performance.php
Clipboard := fileContent
Send, ^v
return

  
!Numpad6:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\all-news.php
Clipboard := fileContent
Send, ^v
return


!Numpad7:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\tickers.php
Clipboard := fileContent
Send, ^v
return



!Numpad8::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\calculator-style.html
Clipboard := fileContent
Send, ^v
return

!Numpad9:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\script.html
Clipboard := fileContent
Send, ^v
return

^!Numpad0::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\useful-links.php
Clipboard := fileContent
Send, ^v
return
 