
^Numpad1::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\data\all-data\silver-category.php
Clipboard := fileContent
Send, ^v
return


^Numpad2::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\data\all-data\gold-category.php
Clipboard := fileContent
Send, ^v
return


^Numpad3::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\data\all-data\platinum-category.php
Clipboard := fileContent
Send, ^v
return


^Numpad4:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\data\all-data\singal-cal.php
Clipboard := fileContent
Send, ^v
return

^Numpad5::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\data\singal\fund-performance.php
Clipboard := fileContent
Send, ^v
return

  
^Numpad6:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\data\singal\all-news.php
Clipboard := fileContent
Send, ^v
return


^Numpad7:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\data\singal\tickers.php
Clipboard := fileContent
Send, ^v
return


^Numpad8:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\login-page.php
Clipboard := fileContent
Send, ^v
return



 

^Numpad9::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\calculator-style.html
Clipboard := fileContent
Send, ^v
return


!Numpad1:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator\script.html
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
FileRead, fileContent, "E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\final\rvcform.html"
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
<?= $config['rvuserinfo']['base_url']; ?>
)
Send, ^v
return



#!Numpad1::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\website\audit.php
Clipboard := fileContent
Send, ^v
return

#!Numpad2::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\website\commission-disclosures.php
Clipboard := fileContent
Send, ^v
return

#!Numpad3::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\website\important-links.php
Clipboard := fileContent
Send, ^v
return

#!Numpad4::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\website\investor-grievance-redressal.php
Clipboard := fileContent
Send, ^v
return


#!Numpad5::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\website\privacy-policy.php
Clipboard := fileContent
Send, ^v
return

#!Numpad6::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\website\risk-factors.php
Clipboard := fileContent
Send, ^v
return

#!Numpad7::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\website\terms-conditions.php
Clipboard := fileContent
Send, ^v
return


