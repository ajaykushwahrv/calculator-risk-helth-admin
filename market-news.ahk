
^Numpad1::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\silver-category.php
Clipboard := fileContent
Send, ^v
return


^Numpad2::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\gold-category.php
Clipboard := fileContent
Send, ^v
return


^Numpad3::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\platinum-category.php
Clipboard := fileContent
Send, ^v
return


^Numpad4:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\singal-cal.php
Clipboard := fileContent
Send, ^v
return

^Numpad5::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\fund-performance.php
Clipboard := fileContent
Send, ^v
return

  
^Numpad6:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\all-news.php
Clipboard := fileContent
Send, ^v
return


^Numpad7:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\tickers.php
Clipboard := fileContent
Send, ^v
return


^Numpad8:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\login-page.php
Clipboard := fileContent
Send, ^v
return



 

^Numpad9::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\calculator-style.html
Clipboard := fileContent
Send, ^v
return


!Numpad1:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\script.html
Clipboard := fileContent
Send, ^v
return

  
!Numpad2::
Clipboard :="
(
<link type=""text/css"" rel=""stylesheet"" href=""css/calculator-style.css""  media=""all"" />
)"
Send, ^v
return


 
!Numpad3::
Clipboard =
(
 &redirecturl=<?= $config[""rvuserinfo""][""base_url""]; ?>/login.php
)
Send, ^v
return

 
!Numpad4::
Clipboard =
(
 calculator.php?tools=fund-performance
)
Send, ^v
return


!Numpad5::
Clipboard =
(
 justify-content-center
)
Send, ^v
return


!Numpad6::
Clipboard =
(
 calculator-style.css
)
Send, ^v
return



!Numpad7:: 
FileRead, fileContent, "E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\final\rvcform.html"
Clipboard := fileContent
Send, ^v
return



 
!Numpad8::
Clipboard =
(
 rvh-health.php
)
Send, ^v
return


!Numpad9::
Clipboard =
(
 rvr-risk.php
)
Send, ^v
return


^!Numpad1::
Clipboard =
(
 rvcform.php;
)
Send, ^v
return

^!Numpad2::
Clipboard =
(
 $config = require __DIR__ . './rvm-include/sfa_config.php';
)
Send, ^v
return

^!Numpad3::
Clipboard =
(
$callbackUrl = $config['rvlogin']['callbackUrl'];
$siteUrl = !empty($config['rvlogin']['wheatlebalsiteUrl']) ? $config['rvlogin']['wheatlebalsiteUrl'] : $config['rvlogin']['siteUrl'];
)
Send, ^v
return

^!Numpad4::
Clipboard =
(
 $siteUrl = <?= !empty($config['rvuserinfo']['arn']) ? $config['rvuserinfo']['arn'] : '' ?>
)
Send, ^v
return

^!Numpad5::
Clipboard =
(
 $config['rvlogin']['callbackUrl'];
)
Send, ^v
return

^!Numpad6::
Clipboard =
(
<?= $config['rvuserinfo']['base_url']; ?>
)
Send, ^v
return



#!Numpad1::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\audit.php
Clipboard := fileContent
Send, ^v
return

#!Numpad2::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\commission-disclosures.php
Clipboard := fileContent
Send, ^v
return

#!Numpad3::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\important-links.php
Clipboard := fileContent
Send, ^v
return

#!Numpad4::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\investor-grievance-redressal.php
Clipboard := fileContent
Send, ^v
return


#!Numpad5::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\privacy-policy.php
Clipboard := fileContent
Send, ^v
return

#!Numpad6::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\risk-factors.php
Clipboard := fileContent
Send, ^v
return

#!Numpad7::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\website\terms-conditions.php
Clipboard := fileContent
Send, ^v
return

#!Numpad8::
Clipboard =
(
<p><b>Disclaimer:</b> The returns used in this calculator are hypothetical and for illustration purposes only. They do not represent projections, promises, or guarantees of future performance. Actual returns may differ and are subject to market risks. Please read all scheme related documents carefully.</p>
)
Send, ^v
return


