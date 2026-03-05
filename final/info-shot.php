<!-- 
1 Sip Calculator                    calculator.php?tools=sip-calculator
2 Lumpsum Calculator                calculator.php?tools=lumpsum-calculator
3 Stp Calculator                    calculator.php?tools=stp-calculator
4 Swp Calculator                    calculator.php?tools=swp-calculator
5 Retirement Planning               calculator.php?tools=retirement-plan
6 Delay Planning Calculator         calculator.php?tools=delay-plan
7 Life Insurance Calculator         calculator.php?tools=life-insurance-plan
8 Emi Planning Calculator           calculator.php?tools=emi-plan
9 Tax Calculator                    calculator.php?tools=calculator.php
10 Marriage Planning Calculator     calculator.php?tools=marriage-plan
11 Education Planning Calculator    calculator.php?tools=education-plan
12 Home Loan Calculator             calculator.php?tools=house-plan
13 Car Planning Calculator          calculator.php?tools=car-plan
14 Vacation Planning Calculator     calculator.php?tools=vacation-plan
15 Step Up Calculator               calculator.php?tools=stepup-calculator
16 Crorepati Calculator             calculator.php?tools=crorepati-calculator
17 SIP Performance                  calculator.php?tools=sip-performance
18 STP Performance                  calculator.php?tools=stp-performance
19 SWP Performance                  calculator.php?tools=swp-performance
20 Scheme Performance               calculator.php?tools=scheme-performance
21 Fund Performance                 calculator.php?tools=fund-performance
22 NAV Finder Calculator            calculator.php?tools=nav-finder
23 Ipo News                         calculator.php?tools=ipo-news
24 Market News                      calculator.php?tools=market-news
25 Popular News                     calculator.php?tools=popular-news
26 Tickers                          calculator.php?tools=tickers


 -->


$config = require 'rvfaotp/sfa_config.php';

$mail->Host = $config['smtp']['host'];
$mail->Port = 587;
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Username = $config['smtp']['username']; // Server Mail ID
$mail->Password = $config['smtp']['password'];
$mail->SetFrom($config['smtp']['from_email'], $config['rvuserinfo']['websitename']);


ajay@2023#2025h*VY!P=p2#=C
po>*:iaCR:s[


<!-- admin ME smtpemail NAME KI file add krna he  -->

smtpemail
base_url
smpassword

<!-- is folder ko uplode krna he  -->
rvfaotp

<!-- admin me logout file dalna he   or chenge krna he jis folder se name diya he   dalna he  -->

$config = require __DIR__ . './../webpbrajeshsadmin/sfa_config.php';

<!-- ise us folsder me run krnahe  -->

change_password.php







Login
admin Login
Calculators
News
Fund Performance
Ticker
Download Form
admin me 2 file dalna
logout pr url chang krna




risk_user
risk_result_pop
risk_result
risk_question
risk_ans
result_pop
result
question_opt
testmonial
user


popup show hide krna ho to https://www.vsave.in/ ke admin me he




<!--'Ctrl + 2'-->
<!--'footer Content'-->
<?= $footerContent = rv_fetchfooterContent($userinfo['name']);?>

<!--'Ctrl + 3'-->
<!--'Risk Factors'-->
<?= $risk_factors =  rv_fetchRiskFactors();?>

<!--'Ctrl + 4'-->
<!--'Terms & Conditions'-->
<?= $termsconditions = rv_fetchTermsConditions();?>

<!--'SID/SAI/KIM'-->
<?= $sid = rv_fetchSidsaikim();?>

<!--'Code of Conduct'-->
<?= $cConduct = rv_fetchCodeofConduct();?>

<!--'Ctrl + 5'-->
<!--'Investor Grievance Redressal'-->
<?= rv_fetchInvestorGrievanceRedressal([
        'clientname' => $userinfo['clientname'],
        'websitename' => $userinfo['websitename'],
        'mobile'      => $userinfo['mobile'],
        'email'       => $userinfo['email'],
        'address'     => $userinfo['address'],
    ]);
?>

<!--'Ctrl + 6'-->
<!--'Important Links'-->
<?= $ImportantLinksData = rv_fetchImportantLinks(); ?>

<!--'SEBI Circulars'-->
<?= $sebiCirculars = rv_fetchCirculars();?>

<!--'Ctrl + 7'-->
<!--'Privacy Policy'-->
<?= $privacy_policy = rv_fetchPrivacyPolicy($config['rvuserinfo']['websitename'], $config['rvuserinfo']['email']); ?>

<!--'Ctrl + 8'-->
<!--'Commission Disclosures'-->
<?= $commission_disclosures = rv_fetchCommissionDisclosures(); ?>

<!--'Ctrl + 9'-->
<!--'REDVision Global Technologies'-->
<span style="--rvc-color:var(--rv-secondary)"><?=  $copyrightdata = rv_fetchCopyright();?></span>













<?php echo $privacy_policy = fetchPrivacyPolicy($config['rvuserinfo']['websitename'], $config['rvuserinfo']['email']); ?>



ctrl + 1 = silver-category
ctrl + 2 = gold-category
ctrl + 3 = platinum-category
ctrl + 4 = singal-cal php code
ctrl + 5 = fund-performance
ctrl + 6 = all-news
ctrl + 7 = tickers
ctrl + 8 = login-page
ctrl + 9 = calculator-style css
Alt + 1 = script
Alt + 2 = css/calculator-style.css
Alt + 3 = &redirecturl=</?= $config[""rvuserinfo""][""base_url""]; ?>/login.php
Alt + 4 = calculator.php?tools=fund-performance
Alt + 5 = justify-content-center
Alt + 6 = calculator-style.css
Alt + 7 = rvh-health.php
Alt + 8 = rvr-risk.php
Ctrl + Alt + 1 = contect form rvcform.php
Ctrl + Alt + 2 = $config = require __DIR__ . '/rvm-include/sfa_config.php';
Ctrl + Alt + 3 = $siteUrl = !empty($config['rvlogin']['wheatlebalsiteUrl']) ? $config['rvlogin']['wheatlebalsiteUrl'] :
$config['rvlogin']['siteUrl'];
Ctrl + Alt + 4 = <?= !empty($config['rvuserinfo']['arn']) ? $config['rvuserinfo']['arn'] : '' ?>;
Ctrl + Alt + 5 = <?= $config['rvuserinfo']['base_url']; ?>;

win + Alt + 1 = adit;
win + Alt + 2 = commission-disclosures;
win + Alt + 3 = important-links;
win + Alt + 4 = investor-grievance-redressal;
win + Alt + 5 = privacy-policy;
win + Alt + 6 = risk-factors;
win + Alt + 7 = terms-conditions;
win + Alt + 8 = STP Calculator;