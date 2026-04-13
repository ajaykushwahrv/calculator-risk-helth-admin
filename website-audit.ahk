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
Risk Factors <?= $risk_factors = rv_fetchRiskFactors();?>
)
ClipWait, 1
SendInput ^v
return

          
^Numpad4::
Clipboard =
(
Terms & Conditions <?= $termsconditions = rv_fetchTermsConditions();?>
)
ClipWait, 1
SendInput ^v
return


^Numpad5::
Clipboard =
(
Investor Grievance Redressal <?= rv_fetchInvestorGrievanceRedressal([
        'clientname' => $config['rvuserinfo']['clientname'],
        'websitename' => $config['rvuserinfo']['websitename'],
        'mobile'      => $config['rvuserinfo']['mobile'],
        'email'       => $config['rvuserinfo']['email'],
        'address'     => $config['rvuserinfo']['address'],
    ]);
?>
)
ClipWait, 1
SendInput ^v
return


^Numpad6::
Clipboard =
(
Important Links <?= $ImportantLinksData = rv_fetchImportantLinks(); ?>
)
ClipWait, 1
SendInput ^v
return


^Numpad7::
Clipboard =
(
Privacy Policy <?= $privacy_policy = rv_fetchPrivacyPolicy($config['rvuserinfo']['websitename'], $config['rvuserinfo']['email']); ?>
)
ClipWait, 1
SendInput ^v
return

          

^Numpad8::
Clipboard =
(
Commission Disclosures <?= $commission_disclosures = rv_fetchCommissionDisclosures(); ?>
)
ClipWait, 1
SendInput ^v
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
 