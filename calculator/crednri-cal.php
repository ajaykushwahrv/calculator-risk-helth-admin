<?php include ('../include/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
		include("../include/head.php"); 
 
	?>
    <title><?= $config['rvuserinfo']['websitename']; ?> | Financial Calculators</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="<?= $config['rvuserinfo']['base_url']; ?>/assets/css/calculator-style.css" rel="stylesheet"
        type="text/css" media="all" />
<?php
        function fetchallDataAPI($con) {
            $baseUrl = "https://redvisiontechnologies.com/api/calculators.php"; // Use full URL if using from another domain
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $baseUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
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
        $allCulatorsDaat = fetchallDataAPI($con);
    ?>
</head>

<body data-page="tools">
    <?php include("../include/header.php"); ?>
    <section class="top-banner-section" style="background-image:url(<?= $config['rvuserinfo']['base_url']; ?>/assets/images/banner/calculator.webp);">
        <div class="container">
            <div class="banner-box">
                <div class="rv-title-style">
                    <div class="text ">
                        <div class="decor-left"><span></span></div>
                        <h3> Financial Calculators </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
<section class="main-section calculator-section">
    <div class="container">
        <!-- Heading for the first set of calculators -->
        <div class="row">
            <div class="col-sm-12">
                <h2 class="calculator-heading">MF Tools Calculators</h2>
            </div>
        </div>

        <div class="row">
           <?php

                        $allowedIds = [17, 18, 19, 20, 21, 22];
                        $i=1; foreach($allCulatorsDaat as $allCulators):
                        if (in_array($allCulators['id'], $allowedIds)){
                         
                        
	
	
 
                            if($allCulators['calculators_name'] == 1){
                            ?>
            <div class="col-md-3 col-sm-6">
                <div class="calculator-card">
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
                        <div class="card-content-cal">
                            <div class="row"> 
                                <div class="col-4 logo-col">
                                   <?php 
switch($i) {
    case 1: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/line-chart.png" alt="Line Chart" />';
        break;
    case 2: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/calculator.png" alt="Calculator" />';
        break;
    case 3: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/stack-overflow.png" alt="Stack Overflow" />';
        break;
    case 4: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/pie-chart.png" alt="Pie Chart" />';
        break;
    case 5: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/universal-access.png" alt="Universal Access" />';
        break;
    case 6: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/history.png" alt="History" />';
        break;
    case 7: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/table.png" alt="Table" />';
        break;
    case 8: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/money.png" alt="Money" />';
        break;
}
?>

                                </div>
                                <div class="col-8 name-col">
                                    <span><?= $allCulators['titleName']; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 description-col">
                                    <?php switch($i){
                                        case 1 : echo "Calculate your SIP returns with ease."; break;
                                        case 2 : echo "Analyze STP performance over time."; break;
                                        case 3 : echo "Evaluate SWP performance for better planning."; break;
                                        case 4 : echo "Identify top-performing funds."; break;
                                        case 5 : echo "Find NAVs for various schemes."; break;
                                        case 6 : echo "Track dividend histories of your investments."; break;
                                        case 7 : echo "Balance your SIPs and lump sum investments."; break;
                                        case 8 : echo "Assess scheme performance with detailed insights."; break;
                                    }?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
         <?php $i++; } } endforeach; ?>
        </div>

        <!-- Heading for the second set of calculators -->
        <div class="row">
            <div class="col-sm-12">
                <h2 class="calculator-heading">Financial Calculators</h2>
            </div>
        </div>

        <div class="row">
            <?php for($i=1; $i<=12; $i++){?>
            <div class="col-md-3 col-sm-6">
                <div class="calculator-card <?php switch($i){case 12 : echo 'active'; break;}?>">
                    <a href="javascript:void(0)" class="calculatorHendler" rvdata="<?php switch($i){
                        case 1 : echo "sipcalc"; break;
                        case 2 : echo "ajax_marriage_calc"; break;
                        case 3 : echo "ajax_Education_calc"; break;
                        case 4 : echo "delaycost"; break;
                        case 5 : echo "lumpsum_calc"; break;
                        case 6 : echo "humanlife"; break;
                        case 7 : echo "retierment_calc"; break;
                        case 8 : echo "emi_calculator"; break;
                        case 9 : echo "incometaxcalc"; break;
                        case 10 : echo "House_calc"; break;
                        case 11 : echo "Car_calc"; break;
                        case 12 : echo "Vacation_calc"; break;
                    }?>.php">
                        <div class="card-content-cal">
                            <div class="row">
                                <div class="col-4 logo-col">
                                   <?php 
switch($i) {
    case 1: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/line-chart.png" alt="Line Chart" />';
        break;
    case 2: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/gratipay.png" alt="Gratipay" />';
        break;
    case 3: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/graduation-cap.png" alt="Graduation Cap" />';
        break;
    case 4: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/clock.png" alt="Clock" />';
        break;
    case 5: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/pie-chart.png" alt="Pie Chart" />';
        break;
    case 6: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/universal-access.png" alt="Universal Access" />';
        break;
    case 7: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/blind.png" alt="Blind" />';
        break;
    case 8: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/table.png" alt="Table" />';
        break;
    case 9: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/money.png" alt="Money" />';
        break;
    case 10: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/home.png" alt="Home" />';
        break;
    case 11: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/car.png" alt="Car" />';
        break;
    case 12: 
        echo '<img src="'.$config['rvuserinfo']['base_url'].'assets/images/cal/vac.png" alt="Plane" />';
        break;
}
?>

                                </div>
                                <div class="col-8 name-col">
                                    <span><?php switch($i){
                                        case 1  : echo "SIP Calculator"; break;
                                        case 2  : echo "Marriage Planning"; break;
                                        case 3  : echo "Education Planning"; break;
                                        case 4  : echo "Delay Cost"; break;
                                        case 5  : echo "Lumpsum"; break;
                                        case 6  : echo "Life Insurance Planning"; break;
                                        case 7  : echo "Retirement Planning"; break;
                                        case 8  : echo "EMI Calculator"; break;
                                        case 9  : echo "Income Tax"; break;
                                        case 10 : echo "House Planning"; break;
                                        case 11 : echo "Car Planning"; break;
                                        case 12 : echo "Vacation Planning"; break;
                                    }?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 description-col">
                                    <?php switch($i){
                                        case 1  : echo "Compute your SIP investments."; break;
                                        case 2  : echo "Plan for marriage expenses effectively."; break;
                                        case 3  : echo "Calculate education costs and savings."; break;
                                        case 4  : echo "Calculate the cost of delays in planning."; break;
                                        case 5  : echo "Estimate lumpsum investment returns."; break;
                                        case 6  : echo "Plan life insurance coverage and needs."; break;
                                        case 7  : echo "Prepare for retirement with comprehensive planning."; break;
                                        case 8  : echo "Calculate your EMIs easily."; break;
                                        case 9  : echo "Assess income tax obligations and savings."; break;
                                        case 10 : echo "Plan for house expenses and investments."; break;
                                        case 11 : echo "Budget for car purchases and expenses."; break;
                                        case 12 : echo "Plan your vacation budget efficiently."; break;
                                    }?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php } ?>
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
</section>


	
	
	
    <?php include("../include/footer.php"); ?>
<script src="<?= $config['rvuserinfo']['base_url']; ?>/assets/js/jquery-3.6.0.min.js"></script>
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
    <?php include ('../include/foot.php');?>