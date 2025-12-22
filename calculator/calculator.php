<?php include('include/config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('include/head.php'); ?>
    <title><?= $config['rvuserinfo']['websitename']; ?> </title>
    <meta charset="UTF-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <link type="text/css" rel="stylesheet" href="assets/css/calculator-style.css">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <!-- 

scategory
gcategory


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



 
 
function fetchDatasingleAPI($urlName) {
    if (is_array($urlName)) {
        $urlName = implode(',', $urlName);
    }
    $baseUrl = "https://www.redvisiontechnologies.com/api/calculatorsget.php";
    $url = $baseUrl . "?urlName=" . urlencode($urlName);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);

    $result = curl_exec($ch);

    if ($result === false) {
        return ["error" => "cURL Error: " . curl_error($ch)];
    }

    curl_close($ch);

    $decoded_result = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return ["error" => "JSON Decode Error: " . json_last_error_msg()];
    }

    return $decoded_result;
}

		  
	 

<?php $rvtickersdata = fetchDatasingleAPI('tickers'); ?>
<iframe src="<?= $rvtickersdata['domainName']; ?>/<?= $rvtickersdata['directoryName']; ?>/<?= $rvtickersdata['toolscat']; ?>/<?= $rvtickersdata['urlName']; ?>?apikey=<?= $rvtickersdata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} width="100%" height="66px"></iframe>




<?php $rvcaliFundPerformancedata =  fetchDatasingleAPI('fund-performance'); ?>
<iframe src="<?= $rvcaliFundPerformancedata['domainName']; ?>/<?= $rvcaliFundPerformancedata['directoryName']; ?>/<?= $rvcaliFundPerformancedata['toolscat']; ?>/<?= $rvcaliFundPerformancedata['urlName']; ?>?apikey=<?= $rvcaliFundPerformancedata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000&primaryactive=fff" frameBorder={0} height=480px; width="100%"></iframe>



Popular News
<?php $rvPopularNewsdata = fetchDatasingleAPI('popular-news');?>
<iframe src="<?= $rvPopularNewsdata['domainName']; ?>/<?= $rvPopularNewsdata['directoryName']; ?>/<?= $rvPopularNewsdata['toolscat']; ?>/<?= $rvPopularNewsdata['urlName']; ?>?apikey=<?= $rvPopularNewsdata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} height=510px; width="100%"></iframe>




<?php $rvMarketNewsdata = fetchDatasingleAPI('market-news'); ?>
<iframe src="<?= $rvMarketNewsdata['domainName']; ?>/<?= $rvMarketNewsdata['directoryName']; ?>/<?= $rvMarketNewsdata['toolscat']; ?>/<?= $rvMarketNewsdata['urlName']; ?>?apikey=<?= $rvMarketNewsdata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} height=510px; width="100%"></iframe>



<?php $rvIPONewsdata = fetchDatasingleAPI('ipo-news'); ?>
<iframe src="<?= $rvIPONewsdata['domainName']; ?>/<?= $rvIPONewsdata['directoryName']; ?>/<?= $rvIPONewsdata['toolscat']; ?>/<?= $rvIPONewsdata['urlName']; ?>?apikey=<?= $rvIPONewsdata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} height=510px; width="100%"></iframe>

<div style="position: relative; height: 48px;">
<?php $rvallNewsdata = fetchDatasingleAPI('all-news'); ?>
<iframe src="<?= $rvallNewsdata['domainName']; ?>/<?= $rvallNewsdata['directoryName']; ?>/<?= $rvallNewsdata['toolscat']; ?>?apikey=<?= $rvallNewsdata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} height=510px; width="100%"></iframe>
</div>



    
-->



</head>

<body data-page="tools">

    <?php include('include/header.php'); ?>


    <?php 
 
function fetchallDataAPI($con) {
    $baseUrl = "https://redvisiontechnologies.com/api/calculators.php"; 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $result = curl_exec($ch);
    if ($result === false) {
        curl_close($ch);
        return ["error" => "cURL Error: " . curl_error($ch)];
    }
    curl_close($ch);

    $decoded_result = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ["error" => "JSON Decode Error: " . json_last_error_msg()];
    }
    
    return $decoded_result;
}

$allCulatorsDaat = fetchallDataAPI($con);


 
    ?>

    scategory

    <div class="calculatorlist-section">
        <div class="row">
            <div class="col-sm-12">
                <ul class="calculator-list">
                    <!-- 
                        //$allowedIds = [1, 8, 2, 11, 10, 17, 18, 19, 22,5,13, 14,12, 7, 6];
                        //$i=1; foreach($allCulatorsDaat as $allCulators):
                        //if (in_array($allCulators['id'], $allowedIds)){
                        //calculator.php?tools=</?= $allCulators['urlName']; ?>
                        -->

                    <?php $i=1; foreach($allCulatorsDaat as $allCulators):
                            if($allCulators['scategory'] == 1){
                            ?>
                    <li>
                        <a href="#!" class="calculatorHendler" data-titlename="<?= $allCulators['titleName']; ?>"
                            data-toolscat="<?= $allCulators['toolscat']; ?>"
                            data-urlname="<?= $allCulators['urlName']; ?>" data-apikey="<?= $allCulators['apikey']; ?>"
                            data-rvsrcimg="<?= $allCulators['rvicone']; ?>"
                            data-rvdomain="<?= $allCulators['domainName']; ?>"
                            data-rvdirectory="<?= $allCulators['directoryName']; ?>"
                            data-rvminheight="<?= $allCulators['minHeight']; ?>"
                            data-rvmaxheight="<?= $allCulators['maxHeight']; ?>"
                            aria-label="<?= $allCulators['urlName'];?>">

                            <div class="image">
                                <img src="<?= $allCulators['rvicone'];?>" alt="<?= $allCulators['titleName'];?>">
                            </div>
                            <span> <?= $allCulators['titleName'];?></span>
                        </a>
                    </li>
                    <?php $i++; }  endforeach; ?>
                </ul>
            </div>
            <div class="col-sm-12">
                <div class=" calculators_section ">
                    <div class="calculator-title"></div>
                    <div class="calculator-text">
                        <div class="rvcaliframe"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
  gcategory


    <section class="main-section">
        <div class="container">
            <div class="calculatorlist-section">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Financial Calculators</h3>
                        <ul class="calculator-list">
                            <!-- 
                        //$allowedIds = [1, 8, 2, 11, 10, 17, 18, 19, 22,5,13, 14,12, 7, 6];
                        //$i=1; foreach($allCulatorsDaat as $allCulators):
                        //if (in_array($allCulators['id'], $allowedIds)){
                        //calculator.php?tools=</?= $allCulators['urlName']; ?>
                        -->

                            <?php $i=1; foreach($allCulatorsDaat as $allCulators):
                            if($allCulators['calculators_name'] == 2 && $allCulators['gcategory'] == 1){
                            ?>
                            <li>
                                <a href="#!" class="calculatorHendler"
                                    data-titlename="<?= $allCulators['titleName']; ?>"
                                    data-toolscat="<?= $allCulators['toolscat']; ?>"
                                    data-urlname="<?= $allCulators['urlName']; ?>"
                                    data-apikey="<?= $allCulators['apikey']; ?>"
                                    data-rvsrcimg="<?= $allCulators['rvicone']; ?>"
                                    data-rvdomain="<?= $allCulators['domainName']; ?>"
                                    data-rvdirectory="<?= $allCulators['directoryName']; ?>"
                                    data-rvminheight="<?= $allCulators['minHeight']; ?>"
                                    data-rvmaxheight="<?= $allCulators['maxHeight']; ?>"
                                    aria-label="<?= $allCulators['urlName'];?>">

                                    <div class="image">
                                        <img src="<?= $allCulators['rvicone'];?>"
                                            alt="<?= $allCulators['titleName'];?>">
                                    </div>
                                    <span> <?= $allCulators['titleName'];?></span>
                                </a>
                            </li>
                            <?php $i++; }  endforeach; ?>
                        </ul>
                        <h3>MF Tools Calculators</h3>
                        <ul class="calculator-list">
                            <?php $i=1; foreach($allCulatorsDaat as $allCulators):
                            if($allCulators['calculators_name'] == 1  && $allCulators['gcategory'] == 1){
                            ?>
                            <li>
                                <a href="#!" class="calculatorHendler"
                                    data-titlename="<?= $allCulators['titleName']; ?>"
                                    data-toolscat="<?= $allCulators['toolscat']; ?>"
                                    data-urlname="<?= $allCulators['urlName']; ?>"
                                    data-rvsrcimg="<?= $allCulators['rvicone']; ?>"
                                    data-apikey="<?= $allCulators['apikey']; ?>"
                                    data-rvdomain="<?= $allCulators['domainName']; ?>"
                                    data-rvdirectory="<?= $allCulators['directoryName']; ?>"
                                    data-rvminheight="<?= $allCulators['minHeight']; ?>"
                                    data-rvmaxheight="<?= $allCulators['maxHeight']; ?>"
                                    aria-label="<?= $allCulators['urlName'];?>">
                                    <div class="image">
                                        <img src="<?= $allCulators['rvicone'];?>"
                                            alt="<?= $allCulators['titleName'];?>">
                                    </div>
                                    <span> <?= $allCulators['titleName'];?></span>
                                </a>
                            </li>
                            <?php $i++; }  endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <div class=" calculators_section ">
                            <div class="calculator-title"></div>
                            <div class="calculator-text">
                                <div class="rvcaliframe"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




     <section class="main-section">
        <div class="container">
            <div class="calculatorlist-section">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Financial Calculators</h3>
                        <ul class="calculator-list">
                            <!-- 
                                //$allowedIds = [1, 8, 2, 11, 10, 17, 18, 19, 22,5,13, 14,12, 7, 6];
                                //$i=1; foreach($allCulatorsDaat as $allCulators):
                                //if (in_array($allCulators['id'], $allowedIds)){
                                //calculator.php?tools=</?= $allCulators['urlName']; ?>
                                rvcoloricone
                                -->

                            <?php $i=1; foreach($allCulatorsDaat as $allCulators):
                            if($allCulators['calculators_name'] == 2){
                            ?>
                            <li>
                                <a href="#!" class="calculatorHendler"
                                    data-titlename="<?= $allCulators['titleName']; ?>"
                                    data-toolscat="<?= $allCulators['toolscat']; ?>"
                                    data-urlname="<?= $allCulators['urlName']; ?>"
                                    data-apikey="<?= $allCulators['apikey']; ?>"
                                    data-rvsrcimg="<?= $allCulators['rvicone']; ?>"
                                    data-rvdomain="<?= $allCulators['domainName']; ?>"
                                    data-rvdirectory="<?= $allCulators['directoryName']; ?>"
                                    data-rvminheight="<?= $allCulators['minHeight']; ?>"
                                    data-rvmaxheight="<?= $allCulators['maxHeight']; ?>"
                                    aria-label="<?= $allCulators['urlName'];?>">

                                    <div class="image">
                                        <img src="<?= $allCulators['rvicone'];?>"
                                            alt="<?= $allCulators['titleName'];?>">
                                    </div>
                                    <span> <?= $allCulators['titleName'];?></span>
                                </a>
                            </li>
                            <?php $i++; }  endforeach; ?>
                        </ul>
                        <h3>MF Tools Calculators</h3>
                        <ul class="calculator-list">
                            <?php $i=1; foreach($allCulatorsDaat as $allCulators):
                            if($allCulators['calculators_name'] == 1){
                            ?>
                            <li>
                                <a href="#!" class="calculatorHendler"
                                    data-titlename="<?= $allCulators['titleName']; ?>"
                                    data-toolscat="<?= $allCulators['toolscat']; ?>"
                                    data-urlname="<?= $allCulators['urlName']; ?>"
                                    data-rvsrcimg="<?= $allCulators['rvicone']; ?>"
                                    data-apikey="<?= $allCulators['apikey']; ?>"
                                    data-rvdomain="<?= $allCulators['domainName']; ?>"
                                    data-rvdirectory="<?= $allCulators['directoryName']; ?>"
                                    data-rvminheight="<?= $allCulators['minHeight']; ?>"
                                    data-rvmaxheight="<?= $allCulators['maxHeight']; ?>"
                                    aria-label="<?= $allCulators['urlName'];?>">
                                    <div class="image">
                                        <img src="<?= $allCulators['rvicone'];?>"
                                            alt="<?= $allCulators['titleName'];?>">
                                    </div>
                                    <span> <?= $allCulators['titleName'];?></span>
                                </a>
                            </li>
                            <?php $i++; }  endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <div class=" calculators_section ">
                            <div class="calculator-title"></div>
                            <div class="calculator-text">
                                <div class="rvcaliframe"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <link type="text/css" rel="stylesheet" href="assets/css/calculator-style.css">



  
    <div class="rv-d-flex">
        <a href=""></a>
    </div>






    <?php include('include/footer.php') ?>


    <link type="text/css" rel="stylesheet" href="<?= $config['rvuserinfo']['base_url']; ?>/assets/css/calculator-style.css">

    <script>
        if (jQuery('.calculatorHendler').length) {
            jQuery(document).on('click', '.calculatorHendler', function() {
                var titlename = jQuery(this).data('titlename');
                var toolscat = jQuery(this).data('toolscat');
                var urlname = jQuery(this).data('urlname');
                var apikey = jQuery(this).data('apikey');
                var rvsrcimg = jQuery(this).data('rvsrcimg');
                var rvdomain = jQuery(this).data('rvdomain');
                var rvdirectory = jQuery(this).data('rvdirectory');
                var rvminheight = jQuery(this).data('rvminheight');
                var rvmaxheight = jQuery(this).data('rvmaxheight');

                jQuery('.calculatorHendler').removeClass('active');
                jQuery(this).addClass('active');
                jQuery('.calculators_section').addClass('active');

                jQuery('.calculator-title').html(
                    '<img src="' + rvsrcimg + '"alt=" ' + titlename + ' "> <span>' + titlename + '</span>')
                var rvPrimary = jQuery("html").css("--rvc-primary").replace("#", "").trim();
                var rvSecondary = jQuery("html").css("--rvc-secondary").replace("#", "").trim();
                var rvwhite = jQuery("html").css("--rvc-white").replace("#", "").trim();

                jQuery('.calculator-text .rvcaliframe').html(
                    '<iframe src="' + rvdomain + '/' + rvdirectory + '/' + toolscat + '/' + urlname +
                    '?apikey=' + apikey +
                    '&primarycolor=' + rvPrimary +
                    '&secondarycolor=' + rvSecondary +
                    '&primaryactive=' + rvwhite +
                    '&bgcolo=000000" frameBorder="0"></iframe>'
                );
                jQuery("html, body").animate({
                    scrollTop: jQuery(".calculators_section").offset().top - 130
                }, 0);
                jQuery(".calculatorlist-section").css({
                    "--rvmaxh": rvmaxheight,
                    "--rvminh": rvminheight
                });
            });
        }
    </script>
    <?php if (isset($_GET['tools'])) { 
        $tools= $_GET['tools'];
            echo "<script>jQuery('.calculatorHendler[data-urlname=\"$tools\"]').trigger('click');</script>";
        } else{
            //echo "<script>jQuery('.calculatorHendler.active').trigger('click');</script>";
        }
    ?>


&primaryactive=fff


<ul>
    <li>c-ca1-silver-1</li>
    <li>c-ca2-gold-2</li>
    <li>c-ca3-platinum-3</li>


    <li>ca4-fetchallDataAPI-4</li>
    <li>ca5-fetchallDatasingal-5</li>

    <li>ca6-fund-performance-name-f6</li>
    <li>ca7-fund-performance-f7</li>
    <li>cw1-justify-content-center</li>
    <li>cw2-calculator-style.css</li>
    <li>cw3-jquery-3.6.0.min</li>

    
    <li>n-cs1-s1-market-news</li>
    <li>n-cs2-s2-ipo-news</li>
    <li>n-cs3-s3-popular-news</li>
    <li>n-cs4-s4-all-news</li>
    <li>n-cs5-s5-tickers</li>
    <li>n-cs5-s6-script</li>

</ul>
    <script src="../jquery-3.6.0.min.js"></script>
    <?php include ('include/foot.php');?>



 

     <?php $i=1; foreach($toolsData as $itemtools): ?>
        
    <?php $i++; endforeach; ?>





    <marquee behavior="" direction=""></marquee>