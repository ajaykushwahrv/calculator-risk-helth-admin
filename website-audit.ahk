^Numpad0::
Clipboard =
(
require __DIR__ . '/rvm-include/config.php';
)
Send, ^v
return


^Numpad1::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\audit.php
Clipboard := fileContent
Send, ^v
return


^Numpad2::
Clipboard =
(
<span style="--rvc-color:var(--rv-secondary)"><?=  $copyrightdata = rv_fetchDynamic('copyright', $config_data); ?></span>
)
Send, ^v
return


^Numpad3::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\useful-links.php
Clipboard := fileContent
Send, ^v
return
 

^Numpad4::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\login-page.php
Clipboard := fileContent
Send, ^v
return 

          
!Numpad1::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\silver-category.php
Clipboard := fileContent
Send, ^v
return


!Numpad2::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\gold-category.php
Clipboard := fileContent
Send, ^v
return


!Numpad3::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\all-data\platinum-category.php
Clipboard := fileContent
Send, ^v
return
 

!Numpad4::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\fund-performance.php
Clipboard := fileContent
Send, ^v
return

  
!Numpad5:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\all-news.php
Clipboard := fileContent
Send, ^v
return


!Numpad6:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\data\singal\tickers.php
Clipboard := fileContent
Send, ^v
return


!Numpad7::
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\calculator-style.css
Clipboard := fileContent
Send, ^v
return


!Numpad8:: 
FileRead, fileContent, E:\xampp\htdocs\ajay-data\NEW-data\admin-calculator\calculator-risk-helth-admin\calculator\script.html
Clipboard := fileContent
Send, ^v
return

