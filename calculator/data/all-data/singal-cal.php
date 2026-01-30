<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('config.php');												
?>
<!doctype html>

<head>
    <title>Welcome to JKC Wealth Vista</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.png" type="image/gif" sizes="32x32">
    <!-- Custom CSS -->
    <link href="css/bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/fontface.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Slider Css -->
    <link rel="stylesheet" href="css/owl.theme.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <!--animation css-->
    <link rel="stylesheet" type="text/css" href="css/calculator.css" />
    <link rel="stylesheet" type="text/css" href="popup/main.css" />
    <style>
    .value-grid {
        display: flex;
        margin-top: -10px;
        flex-wrap: wrap;
    }

    .value-card {
        max-width: 33.3%;
        padding: 10px;
        width: 100%;
    }

    .value-card-body {
        border: 1px solid #e6e6e6;
        border-radius: 14px;
        padding: 22px;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);


    }

    .value-card:nth-child(1),
    .value-card:nth-child(2) {
        max-width: 50%;
    }



    .ring {
        width: 70px;
        height: 70px;
        margin-bottom: 14px;
    }

    .ring circle {
        transition: stroke-dashoffset 1.4s ease;
    }

    .value-title {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .value-card p {
        margin: 0;
        color: #333;
    }

    .philo-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin: 22px 0;
    }

    .philo-icon {
        min-width:
            42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 18px;
    }

    .icon-maroon {
        background: #7b1215;
    }

    .icon blue {
        background: #292c7c;
    }

    @media only screen and (max-width:767px) {

        .value-card,
        .value-card:nth-child(1),
        .value-card:nth-child(2) {
            max-width: 100%;
        }
    }
    </style>

</head>

<body>
    <?php 												

$query12 = mysqli_query($con,"select * from fslider") or die(mysqli_error($con));												
   $row12 = mysqli_fetch_array($query12);	
  
    if($row12['status']=='1'){?>
    <div id="boxes">
        <div style="top: 165.5px; left: 411.5px; display: block;" id="dialog" class="window">
            <a href="#" class="close agree"><img src="popup/button-close.png" style="width:11%;"></a>
            <div id="lorem">
                <div class="login key_links">
                    <img src="popup/<?php echo $row12['pic'];?>" style="width:100%;">
                </div>
            </div>
        </div>
        <div style="width: 1423px; font-size: 32pt; color: white; height: 1724px; opacity: 0.9; display: block;"
            id="mask"></div>
    </div>

    <div id="grayBG" class="grayBox" style="display:none;"></div>
    <div id="LightBox" class="box_content" style="display:none;"> <img src="images/closebox.png"
            onClick="forgetpassword();" border="0" align="right" class="imgs" />

    </div>
    <?php } ?>

    <div class="main-wrapper">
        <?php include("header.php"); ?>
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <?php include("slider.php"); ?>
                    </div>
                    <div class="col-lg-4">
                        <h2 class="bg_blue">Portfolio Login</h2>
                        <div class="login">

                            <?php
include("login.php");
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--banner-->

        <div class="ticker">
            <div class="" style="background:none">
                <div class="row">
                    <!--<div class="col-lg-6">
        <div class="news_bar">
          <iframe class="news_bar" src="https://my-eoffice.com/bse_ticker.php?width=425&amp;bgc=ff0000&amp;color=fff" scrolling="No" width="100%" height="34px" frameborder="0"></iframe></div>
      </div>-->
                    <div class="col-lg-12">
                        <div class="rvnews_bar">
                            <?php
$api_key = '9ddydC7nKajtUWHO8CEAhMKkJgeXImiuVteBU3KP1RnR58r2KIiqn90ZprZQ9dCt';
// Function to fetch news data from the API
function fetch_news($api_key, $table)
{
// Initialize the cURL session
$curl = curl_init();
// Set the cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://websitesbazaar.com/api/financial_news_get_api.php?api_key=' . $api_key . '&table=' . $table,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));
// Execute the cURL request and get the response
$response = curl_exec($curl);
// Close the cURL session
curl_close($curl);
// Return the response
return $response;
}
// Function to display news items
function display_news($api_key, $table)
{
// Call the fetch_news function to get the response from the API
$response = fetch_news($api_key, $table);
// Check if the response is not empty
if ($response) {
    // Decode the JSON response into an associative array
    $data = json_decode($response, true);
    // Check if the JSON was decoded properly
    if (json_last_error() === JSON_ERROR_NONE) {
        // Loop through each news item (assuming it's an array of news)
        foreach ($data as $news_item) {
            // Extract the required fields from the news item
            $title = isset($news_item['title']) ? $news_item['title'] : 'No title';
            $link = isset($news_item['link']) ? $news_item['link'] : 'No link';
            $description = isset($news_item['description']) ? $news_item['description'] : 'No description';
            $image = isset($news_item['image']) ? $news_item['image'] : 'No image';
            $date = isset($news_item['date']) ? $news_item['date'] : 'No date';
            $date = substr($date, 0, 16);
?>
                            <div class="item">
                                <div class="news-box">
                                    <a href="<?= $link ?>" target="_blank" class="inner-box">
                                        <!--<div class="image">
                    <img src="<?= $image ?>" alt="<?= $image ?>">
                    
                </div>-->
                                        <div class="content">
                                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                            <span class="date"><?= $date ?></span>
                                            <h6><?= substr($title, 0, 40) ?>...</h6>
                                            <!--<p><?= substr($description, 0, 75) ?>...</p>-->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
        }
    } else {
        echo "Error generating data response.";
    }
} else {
    echo "No response received from the API.";
}
}
?>

                            <marquee onMouseOver="this.stop()" onMouseOut="this.start()">
                                <!-- <iframe src="https://my-eoffice.com/nse_ticker.php?width=425&amp;bgc=ff0000&amp;color=fff" scrolling="No" width="100%" height="34px" frameborder="0"></iframe></div>-->
                                <div class="rv-news_bar">
                                    <?php display_news($api_key, 'popular_news'); ?><?php display_news($api_key, 'market_news'); ?><?php display_news($api_key, 'ipo_news'); ?>
                                </div>
                            </marquee>
                        </div>
                    </div>
                </div>
                <!--<div class="container">
  <div class="row">
   <div class="col-lg-12">
   <div class="live-ticker">
   <iframe scrolling="yes" src="https://my-eoffice.com/market/style2.php" id="frame1" width="100%" height="100px" frameborder="0"></iframe>
   </div>
 </div>
 </div>
 </div>-->
            </div>
            <!--ticker-->
            <div class="clearfix"></div>

            <!--   <div class="tools">
   <div class="container">
     <div class="row">
       <div class="col-lg-3">
          <div class="invest-in">
            <div class="invest-img"> <img src="images/icons/payment.png"> </div>
              <div class="invest-text">Pay Premium Online</div>
            <div class="click"><a href="pay_premium_online.php">Click Here</a></div>
          </div>
       </div>
      <div class="col-lg-3">
        <div class="invest-in">
          <div class="invest-img"> <img src="images/icons/link.png"> </div>
            <div class="invest-text">Useful Links</div>
          <div class="click"><a href="content.php?id=10">Click Here</a></div>
        </div>
      </div>  
      <div class="col-lg-3">
        <div class="invest-in">
          <div class="invest-img"> <img src="images/icons/download.png"> </div>
            <div class="invest-text">Downloads</div>
          <div class="click"><a href="download.php">Click Here</a></div>
        </div>
      </div>  
      <div class="col-lg-3">
        <div class="invest-in">
        <div class="invest-img"> <img src="images/icons/calculator.png"> </div>
        <div class="invest-text">Financial Calculator</div>
        <div class="click"><a href="calculator.php">Click Here</a></div>
        </div>
      </div>
     </div>
   </div>
 </div> -->
            <!--tools-->


            <div class="clearfix"></div>

            <div class="tools news-form">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                        </div>
                        <div class="col-lg-3 d-none">
                            <h2>Schedule A Meeting</h2>
                            <div class="form">
                                <?php include("form.php"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="tools news-form">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="bg_blue mb-4">How We Actually Add Value</h2>

                            <div class="value-grid">
                                <div class="value-card">
                                    <div class="value-card-body"> <svg class="ring progress-ring" data-progress="20"
                                            viewBox="0 0 36 36">
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#f3d6d8"
                                                stroke-width="3" />
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#7b1215"
                                                stroke-width="3" stroke-dasharray="100" stroke-dashoffset="100" />
                                            <text x="18" y="20.5" text-anchor="middle" font-size="8" fill="#7b1215"
                                                font-weight="bold">20%</text>
                                        </svg>
                                        <div class="value-title">Strategic Financial Planning</div>
                                        <p>We work with you to set meaningful
                                            financial goals, design a structured long-term plan, and create a
                                            personalised portfolio aligned with your
                                            aspirations.</p>
                                    </div>
                                </div>
                                <div class="value-card">
                                    <div class="value-card-body"> <svg class="ring progress-ring" data-progress="80"
                                            viewBox="0 0 36 36">
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#d6daf3"
                                                stroke-width="3" />
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#292c7c"
                                                stroke-width="3" stroke-dasharray="100" stroke-dashoffset="100" />
                                            <text x="18" y="20.5" text-anchor="middle" font-size="8" fill="#292c7c"
                                                font-weight="bold">80%</text>
                                        </svg>
                                        <div class="value-title">Behavioural Guidance</div>
                                        <p>Success is not just about making a plan — it’s
                                            about staying committed. We help you remain disciplined through market
                                            swings, news noise, and
                                            emotional decisions.</p>
                                    </div>
                                </div>
                                <div class="value-card">
                                    <div class="value-card-body"><svg class="ring progress-ring" data-progress="0"
                                            viewBox="0 0 36 36">
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#f3d6d8"
                                                stroke-width="3" />
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#7b1215"
                                                stroke-width="3" stroke-dasharray="100" stroke-dashoffset="100" /> <text
                                                x="18" y="20.5" text-anchor="middle" font-size="8" fill="#7b1215"
                                                font-weight="bold">0%</text>
                                        </svg>
                                        <div class="value-title">No Market Timing</div>
                                        <p>We do not attempt to predict highs and lows.
                                            Long-term participation in the market matters more than trying to time
                                            entry and exit points.</p>
                                    </div>
                                </div>
                                <div class="value-card">
                                    <div class="value-card-body"> <svg class="ring progress-ring" data-progress="0"
                                            viewBox="0 0 36 36">
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#d6daf3"
                                                stroke-width="3" />
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#292c7c"
                                                stroke-width="3" stroke-dasharray="100" stroke-dashoffset="100" />
                                            <text x="18" y="20.5" text-anchor="middle" font-size="8" fill="#292c7c"
                                                font-weight="bold">0%</text>
                                        </svg>
                                        <div class="value-title">No Unnecessary Churning</div>
                                        <p>Your portfolio is not frequently reshuffled
                                            to chase trends. Excessive activity can erode returns and increase costs.
                                        </p>
                                    </div>
                                </div>
                                <div class="value-card">
                                    <div class="value-card-body"> <svg class="ring progress-ring" data-progress="0"
                                            viewBox="0 0 36 36">
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#f3d6d8"
                                                stroke-width="3" />
                                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#7b1215"
                                                stroke-width="3" stroke-dasharray="100" stroke-dashoffset="100" /> <text
                                                x="18" y="20.5" text-anchor="middle" font-size="8" fill="#7b1215"
                                                font-weight="bold">0%</text>
                                        </svg>
                                        <div class="value-title">No Get-Rich-Quick Promises</div>
                                        <p>We focus on steady, disciplined wealth
                                            creation. Sustainable compounding requires patience and time.</p>
                                    </div>
                                </div>

                            </div>
                            <script>
                            const rings = document.querySelectorAll('.progress-ring');
                            const observer = new
                            IntersectionObserver(entries => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        const ring = entry.target;
                                        const progress = ring.getAttribute('data-progress');
                                        const circle = ring.querySelectorAll('circle')[1];
                                        circle.style.strokeDashoffset = 100 - progress;
                                        observer.unobserve(ring);
                                    }
                                });
                            }, {
                                threshold: 0.4
                            });
                            rings.forEach(r => observer.observe(r));
                            </script>
                        </div>

                    </div>
                </div>
            </div>

            <div class="clearfix"></div>


            <div class="tools news-form">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Our Philosophy</h2>

                            <p>At the heart of everything we do is a deep commitment to trust, transparency, and
                                long-term partnership.</p>
                            <p>We stand by these core principles:</p>
                            <div class="philo-row">
                                <div class="philo-card">

                                    <div class="philo-item">
                                        <div class="philo-icon icon-maroon">CF</div>
                                        <div> <strong>Client Interests Come
                                                First</strong><br> Your goals always take priority. Every recommendation
                                            is
                                            made
                                            with your benefit at the
                                            forefront of our thinking. </div>
                                    </div>
                                </div>
                                <div class="philo-card">

                                    <div class="philo-item">
                                        <div class="philo-icon icon-blue">✓</div>
                                        <div> <strong>We Recommend What We
                                                Believe In</strong><br> We propose only those strategies and solutions
                                            we
                                            trust
                                            and would be comfortable
                                            choosing ourselves. If it does not meet our standards, it does not reach
                                            you.
                                        </div>
                                    </div>
                                </div>
                                <div class="philo-card">

                                    <div class="philo-item">
                                        <div class="philo-icon icon-maroon">ED</div>
                                        <div> <strong>Simplify and
                                                Strengthen Financial Understanding</strong><br> Our purpose is to make
                                            finance
                                            easy to understand, so
                                            you feel assured, informed, and in control of your financial journey. </div>
                                    </div>
                                </div>
                                <div class="philo-card">

                                    <div class="philo-item">
                                        <div class="philo-icon icon-blue"> </div>
                                        <div> <strong>Respect for Your Data
                                                and Privacy</strong><br> Your personal and financial information is
                                            handled
                                            with
                                            strict confidentiality and
                                            the highest level of care and security. </div>
                                    </div>
                                </div>
                                <div class="philo-card">
                                    <div class="philo-item">
                                        <div class="philo-icon icon-maroon">FF</div>
                                        <div> <strong>Building Freedom, Not
                                                Just Wealth</strong><br> Our focus goes beyond growing assets — we help
                                            you move
                                            toward genuine
                                            financial independence and lasting peace of mind. </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="clearfix"></div>

            <!-- /TICKER -->
            <div class="tools">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-9">
                            <h2 class="">Client Testimonials</h2>
                            <div class="news">
                                <!-- Carousel wrapper -->
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <!--<ol class="carousel-indicators">-->
                                    <!--  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>-->
                                    <!--  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
                                    <!--  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
                                    <!--</ol>-->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active text-center">
                                            <!--<img class="d-block" src="images/clientfemal.png" alt="First slide">-->
                                            <h3> Suraj Atreya </h3>
                                            <h4 class="mt-0"> Quantitative Trader | Fintech Investor | Developer | Ex -
                                                Citi
                                            </h4>
                                            <p> I am very fortunate to have found Bhaswati to help me manage my personal
                                                finance. She has in-depth knowledge of the of markets and Indian markets
                                                in
                                                particular. She has the distinct ability to listen keenly, thoroughly
                                                analyse the client requirements and recommend the right products. She is
                                                easily reachable over phone or email and I couldn't be more than happy
                                                to
                                                recommend to my friends. </p>
                                        </div>

                                        <div class="carousel-item text-center">
                                            <!--<img class="d-block" src="images/clientfemal.png" alt="Second slide">-->
                                            <h3> Vinod Palakkil </h3>
                                            <h4 class="mt-0"> Sales Director & Head (South,North & East) at PTC </h4>
                                            <p> I got in touch with Ms Bhaswati when my finances were totally haywire
                                                and
                                                like many of my friends had always put personal finances in the back
                                                burner.
                                                Lot of wrong and dead investments resulting in a chaos. It was 18 months
                                                ago
                                                when we did a financial planning to understand that all these years of
                                                good
                                                earning hasn't resulted in any good planning. Insurance was low both
                                                life
                                                and health. Today in a year and a half I'm writing a recommendation on
                                                the
                                                efforts from Ms Bhaswati where I have realized and ensured a crisp
                                                planning
                                                and advice which has been implemented and monitored strictly and have
                                                been
                                                able to come to a comfortable and easy path of achieving GOAL's for me
                                                and
                                                my family. She is strict with implementing the plan which has been
                                                deviced
                                                on our GOALs during the planning and would recommend all my contacts to
                                                get
                                                into such planning mode. It is important especially to tide on such
                                                difficult times. </p>
                                        </div>

                                        <div class="carousel-item text-center">
                                            <!--<img class="d-block" src="images/clientmen.png" alt="Third slide">-->
                                            <h3> Manicka Vinayagam </h3>
                                            <h4 class="mt-0"> Senior Design Engineer at Macbro Technology India Pvt Ltd
                                            </h4>
                                            <p>Modesty with Experience and Knowledge is a personality trait that's seen
                                                in a
                                                few, She's one among them. I've started my financial planning with
                                                Bhaswati
                                                Mam a year ago, one of the good decision I've made. Financial Advisors
                                                don't
                                                have a magic wand to turn money into riches, but have the impact to make
                                                you
                                                think about money from an Investor perspective, the Impact of this
                                                statement
                                                will be felt when you work with her. Simply, She's the best in what she
                                                does. </p>
                                        </div>

                                        <div class="carousel-item text-center">
                                            <!--<img class="d-block" src="images/clientmen.png" alt="Third slide">-->
                                            <h3> Karthikeyan Kannan </h3>
                                            <h4 class="mt-0"> Director at Visa </h4>
                                            <p> Bhaswati is a reliable and trustworthy financial advisor . She is very
                                                knowledgeable about finance. She is exceptional in her ability to
                                                Understand
                                                the market fluctuations and make the right decision on investments. She
                                                did
                                                a great job in planning my financial goals . As a financial advisor ,
                                                Bhaswati earns my highest recommendation.</p>

                                        </div>

                                        <div class="carousel-item text-center">
                                            <!--<img class="d-block" src="images/clientmen.png" alt="Third slide">-->
                                            <h3> Prakash Govindan </h3>
                                            <h4 class="mt-0"> Partner Excellence Program Lead at Mondelez International
                                            </h4>
                                            <p> I realized after my interaction with Bhaswati that she is THE advisor I
                                                should have met and discussed goals/financials 10 years back. Never too
                                                late
                                                to make such decisions in life. It has been an eye opener for all
                                                insights
                                                she brought out from day 1 of my financial planning discussions. I fell
                                                in
                                                love with the relevant insights she brought out in her detailed report,
                                                looking at my current portfolio and summary she provided is clear &
                                                transparent. She detailed out in her report a clear status of my current
                                                financial status and clear update on my goals (if they are
                                                achievable/realistic or unrealistic), and plans to achieve these goals.
                                                Also, she even went on to question some of my goals, which made me
                                                rethink
                                                on my goals/planning. One of the key concept she emphasized “all
                                                investments
                                                should be goal based”. Based on my experience with her professional
                                                guidance, I have been sharing my learning to my friends and colleagues &
                                                I
                                                strongly recommend her to everyone who is willing to look shaping their
                                                financial independence & a robust planning for their future. </p>
                                        </div>

                                        <div class="carousel-item text-center">
                                            <!--<img class="d-block" src="images/clientmen.png" alt="Third slide">-->
                                            <h3> Amit Bose </h3>
                                            <h4 class="mt-0"> FMCG Leader(India,S.E Asia) </h4>
                                            <p> As I continue to work with Bhaswati, what gets abundantly clear is her
                                                hand-in-glove fit with her role of Financial Advisor and Wealth Manager.
                                                Her
                                                meticulous, methodical approach is a perfect overlay on her depth of
                                                knowledge, skill-set and obvious competence. At the center of her
                                                operating
                                                philosophy are two core principles, (a) incredibly high level of
                                                integrity
                                                with complete transparency, and (b) a focused client-centric approach
                                                built
                                                on an in-depth and robust understanding of the client's current status
                                                and
                                                future needs. She is empathetic, humane and sincere, and above all, she
                                                makes a client feel comfortable and secure in the way she conducts
                                                herself
                                                in the professional relationship. I have not had a Financial Advisor of
                                                her
                                                caliber and competence before, and would gladly & unhesitatingly
                                                recommend
                                                her services to anyone looking for this kind of service. We feel
                                                extremely
                                                secure, confident and happy with her managing our finances and future.
                                            </p>
                                        </div>

                                        <div class="carousel-item text-center">
                                            <!--<img class="d-block" src="images/clientmen.png" alt="Third slide">-->
                                            <h3> Ashok Dixit </h3>
                                            <h4 class="mt-0"> General Manager at WCL </h4>
                                            <p> Hi Bhaswati...I am absolutely delighted with your service. It is really
                                                refreshing to work with a financial adviser who is truly interested in
                                                their
                                                client’s needs, circumstances and preferences. What really impressed me
                                                was
                                                the way you took the time to get a feeling for where I was at, your
                                                depth of
                                                knowledge, lateral thinking and your common sense approach. Your
                                                professional, ethical and caring demeanour elicits my trust and respect
                                                and
                                                I gladly recommend your services whenever possible.”
                                                This is what financial advisors should do! I have never had this kind of
                                                experience in the past with financial advisers and this is the kind of
                                                service I have been looking for. It’s nice to have one place to come to,
                                                without being too large or institutional. I feel like you know the whole
                                                picture and if anything happened to me now, I know my family will be
                                                looked
                                                after.” </p>
                                        </div>

                                    </div>
                                    <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                                    <!--  <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                                    <!--  <span class="sr-only">Previous</span>-->
                                    <!--</a>-->
                                    <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                                    <!--  <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                                    <!--  <span class="sr-only">Next</span>-->
                                    <!--</a>-->
                                </div>
                                <!-- Carousel wrapper -->
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <h2>Tools</h2>
                            <div class="tools-list">
                                <ul>

                                    <li><a href="calculator.php"><img src="images/img.png">Financial Calculators</a>
                                    </li>
                                    <li><a href="https://www.cvlkra.com/Index.aspx" target="_blank"><img
                                                src="images/img.png">Check Your KYC</a></li>
                                    <li><a href="https://mfs.kfintech.com/mfs/fatca-kyc.aspx" target="_blank"><img
                                                src="images/img.png">FATCA</a></li>
                                    <li><a href="rvr-risk.php"><img src="images/img.png">Know your Suitability
                                            Profile</a>
                                    </li>
                                    <li><a href="rvh-health.php"><img src="images/img.png">Check your Financial
                                            Fitness</a>
                                    </li>
                                    <!-- <li><a href="https://www.mfcentral.com" target="_blank"><img src="images/img.png">MF Central</a></li> -->
                                    <li><a href="https://www.incometax.gov.in/iec/foportal" target="_blank"><img
                                                src="images/img.png">Pay Tax Online</a></li>
                                    <li><a href="calculator.php?tools=fund-performance" class=""><img
                                                src="images/img.png">Fund Performance</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id='whatsapp-chat' class='hide'>
                <div class='header-chat'>
                    <div class='head-home'>
                        <div class='info-avatar'><img src='images/logo.png' /></div>
                        <p><span class="whatsapp-name">JKC Wealth Vista</span><br><small><span
                                    class="online-icon"></span>
                                Typically replies within an hour</small></p>

                    </div>
                    <div class='get-new hide'>
                        <div id='get-label'></div>
                        <div id='get-nama'></div>
                    </div>
                </div>
                <div class='home-chat'>

                </div>
                <div class='start-chat'>
                    <div pattern="https://elfsight.com/assets/chats/patterns/whatsapp.png"
                        class="WhatsappChat__Component-sc-1wqac52-0 whatsapp-chat-body">
                        <div class="WhatsappChat__MessageContainer-sc-1wqac52-1 dAbFpq">
                            <div style="opacity: 0;" class="WhatsappDots__Component-pks5bf-0 eJJEeC">
                                <div class="WhatsappDots__ComponentInner-pks5bf-1 hFENyl">
                                    <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotOne-pks5bf-3 ixsrax"></div>
                                    <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotTwo-pks5bf-4 dRvxoz"></div>
                                    <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotThree-pks5bf-5 kXBtNt">
                                    </div>
                                </div>
                            </div>
                            <div style="opacity: 1;" class="WhatsappChat__Message-sc-1wqac52-4 kAZgZq">
                                <div class="WhatsappChat__Author-sc-1wqac52-3 bMIBDo">JKC Wealth Vista</div>
                                <div class="WhatsappChat__Text-sc-1wqac52-2 iSpIQi">
                                    <div class="">
                                        <!-- <h2>Vertical (basic) form</h2> -->
                                        <!-- <form action="/action_page.php"> -->
                                        <div class="form-group">
                                            <!--<label for="email">Name:</label>-->
                                            <!-- <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"> -->
                                            <input type="text" name="Name" id="name1" class="form-control"
                                                placeholder="Name *" value="" required="" />
                                        </div>
                                        <div class="form-group">
                                            <!--<label for="pwd">Email:</label>-->
                                            <input type="text" name="Email" id="email1" class="form-control"
                                                placeholder="E-mail *" value="" required="" />
                                        </div>
                                        <div class="form-group">
                                            <!--<label for="pwd">Phone:</label>-->
                                            <input type="number" name="Phone" id="phone1" class="form-control"
                                                placeholder="Phone*" min="0" max="10" value="" required="" />
                                        </div>

                                        <div class="form-group">
                                            <!--<label for="pwd">City:</label>-->
                                            <input type="text" name="city" id="city1" class="form-control"
                                                placeholder="City*" value="" required="" />
                                        </div>

                                        <div class="form-check check-box">
                                            <input class="form-check-input" type="checkbox" checked="checked" id="check"
                                                name="check" onclick="return false;">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Permission required for WhatsApp chat & call
                                            </label>
                                        </div>

                                        <!--<div class="form-group">-->
                                        <!--    <label for="pwd">Upload:</label>-->
                                        <!--    <input type="file" name="file" id="file" class="form-control" required = 'required' />-->

                                        <!--</div>-->


                                        <!--<div class="form-group">-->
                                        <!--    <label for="pwd">Phone:</label>-->
                                        <!--    <select class="form-control" id="service">-->
                                        <!--        <option>service 1 </option>-->
                                        <!--        <option>service 2</option>-->
                                        <!--        <option>service 3</option>-->
                                        <!--      </select>-->
                                        <!--</div>-->
                                        <!-- <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember me</label>
                              </div> -->
                                        <!-- <button type="submit" class="btn btn-default">Submit</button> -->
                                        <input type="submit" onclick='sendContact1()' name="submit" id="submit"
                                            class="btn btn-default btnSubmit btn-block" value="Submit" />
                                        <!-- </form> -->
                                    </div>

                                </div>
                                <div class="WhatsappChat__Time-sc-1wqac52-5 cqCDVm">1:40</div>
                            </div>
                        </div>
                    </div>

                    <div class='blanter-msg'>
                        <textarea id='chat-input' placeholder='Write a response' maxlength='120' row='1'></textarea>
                        <a href='javascript:void;' id='send-it'><svg viewBox="0 0 448 448">
                                <path d="M.213 32L0 181.333 320 224 0 266.667.213 416 448 224z" />
                            </svg></a>

                    </div>
                </div>
                <div id='get-number'></div><a class='close-chat' href='javascript:void'>×</a>
            </div>
            <a class='blantershow-chat' href='javascript:void' title='Show Chat'>
                <svg width="26" viewBox="0 0 26 26">
                    <defs />
                    <path fill="#eceff1"
                        d="M20.5 3.4A12.1 12.1 0 0012 0 12 12 0 001.7 17.8L0 24l6.3-1.7c2.8 1.5 5 1.4 5.8 1.5a12 12 0 008.4-20.3z" />
                    <path fill="#4caf50"
                        d="M12 21.8c-3.1 0-5.2-1.6-5.4-1.6l-3.7 1 1-3.7-.3-.4A9.9 9.9 0 012.1 12a10 10 0 0117-7 9.9 9.9 0 01-7 16.9z" />
                    <path fill="#fafafa"
                        d="M17.5 14.3c-.3 0-1.8-.8-2-.9-.7-.2-.5 0-1.7 1.3-.1.2-.3.2-.6.1s-1.3-.5-2.4-1.5a9 9 0 01-1.7-2c-.3-.6.4-.6 1-1.7l-.1-.5-1-2.2c-.2-.6-.4-.5-.6-.5-.6 0-1 0-1.4.3-1.6 1.8-1.2 3.6.2 5.6 2.7 3.5 4.2 4.2 6.8 5 .7.3 1.4.3 1.9.2.6 0 1.7-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4z" />
                </svg>
                <span style="display: block;"> Enquire Now </span>
            </a>


            <?php include("footer.php"); ?>
        </div>
        <!--main-wrapper-->
        <!--<script src="js/jquery-1.7.2.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.0/SmoothScroll.min.js"></script>-->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.js"></script>
        <script src="js/menu.js"></script>
        <script src="js/jquery.bxSlider.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#sliderr').bxSlider({
                ticker: true,
                tickerSpeed: 5000,
                tickerHover: true
            });
        });
        </script>
        <!--slider-js-->

        <script>
        jQuery(document).ready(function($) {
            $('.fadeOut').owlCarousel({
                navText: ["<img src='images/owl-prev.png'>", "<img src='images/owl-next.png'>"],
                items: 1,
                nav: true,

                autoplay: true,
                autoplayTimeout: 3500,
                loop: true,
            });
        });
        </script>

        <script>
        jQuery(document).ready(function($) {
            $('.fadeouttestimonial').owlCarousel({
                navText: ["<img src='images/owl-prev.png'>", "<img src='images/owl-next.png'>"],
                items: 1,
                autoHeight: true,
                //dots: false,
                //nav:true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true
            });
        });
        </script>

        <!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>-->
        <script src="<?php echo $siteUrl; ?>/js/aes.js"></script>
        <script src="<?php echo $siteUrl; ?>/js/login_script.js"></script>
        <script src="<?php echo $siteUrl; ?>/js/formValidation.js"></script>
        <script src="<?php echo $siteUrl; ?>/js/ajaxCore.js"></script>
        <script src="<?php echo $siteUrl; ?>/js/login.js"></script>
        <script src="js/main.js"></script>
        <script>
        var msgType = '<?php echo $type; ?>';
        var msg = '<?php echo $msg; ?>';
        if (msgType === "error" && msg !== "") {
            $('#loginPageAlertError').html(msg);
            $('#loginPageAlertError').css("display", "block");
        }

        $('input[type=radio][name=loginType]').change(function() {
            var optionValue = this.value;
            $('#loginFor').val('');
            if (optionValue != "" && optionValue != 'undefined') {
                $('#loginFor').val(optionValue);
                $('#type').val(optionValue);
            }
        });
        </script>
        <script>
        $(document).ready(function() {
            $(".close").click(function() {
                $("#exampleModal").addClass("intro");
            });
        });
        </script>

        <script>
        function sendContact1() {
            var valid = validateContact1();


            if (valid) {

                var name = document.getElementById("name1").value;
                var phone = document.getElementById("phone1").value;
                var email = document.getElementById("email1").value;
                var city = document.getElementById("city1").value;
                // var file = document.getElementById("file").value;
                // var service = document.getElementById("service").value;

                var url = "https://wa.me/+919611507492?text=" +
                    "*Name*: " + name + "%0a" +
                    "*Phone*: " + phone + "%0a" +
                    "*E-mail*: " + email + "%0a" +
                    "*City*: " + city + "%0a";
                // + "*File*: " + file  + "%0a";
                // + "*Service*: " + service; 

                window.open(url, '').focus();
            }
        }

        function validateContact1() {
            var valid = true;
            // $(".demoInputBox").css('background-color','');
            // $(".info").html('');

            if (!$("#name1").val()) {
                $("#name1").html("(required)");
                $("#name1").css('background-color', '#FFFFDF');
                $("#name1").css('border', '1px solid #f44336');
                valid = false;
            }
            if (!$("#email1").val()) {
                $("#email1-info").html("(required)");
                $("#email1").css('background-color', '#FFFFDF');
                $("#email1").css('border', '1px solid #f44336');
                valid = false;
            }
            if (!$("#email1").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                $("#email1-info").html("(invalid)");
                $("#email1").css('background-color', '#FFFFDF');
                $("#email1").css('border', '1px solid #f44336');
                valid = false;
            }

            if (!$("#phone1").val()) {
                $("#phone1").html("(required)");
                $("#phone1").css('background-color', '#FFFFDF');
                $("#phone1").css('border', '1px solid #f44336');
                valid = false;
            }

            if (!$("#phone1").val().match(/^(\+\d{1,3}[- ]?)?\d{10}$/)) {
                $("#phone1").html("(required)");
                $("#phone1").css('background-color', '#FFFFDF');
                $("#phone1").css('border', '1px solid #f44336');
                valid = false;
            }

            if (!$("#city1").val()) {
                $("#city1").html("(required)");
                $("#city1").css('background-color', '#FFFFDF');
                $("#city1").css('border', '1px solid #f44336');
                valid = false;
            }


            return valid;
        }
        </script>

        <script>
        /* Whatsapp Chat Widget by www.bloggermix.com */
        $(document).on("click", "#send-it", function() {
                var a = document.getElementById("chat-input");
                if ("" != a.value) {
                    var b = $("#get-number").text(),
                        c = document.getElementById("chat-input").value,
                        d = "https://web.whatsapp.com/send",
                        e = b,
                        f = "&text=" + c;
                    if (
                        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                            navigator.userAgent
                        )
                    )
                        var d = "whatsapp://send";
                    var g = d + "?phone=+31 6 29320129" + e + f;
                    window.open(g, "_blank");
                }
            }),
            $(document).on("click", ".informasi", function() {
                (document.getElementById("get-number").innerHTML = $(this)
                    .children(".my-number")
                    .text()),
                $(".start-chat,.get-new")
                    .addClass("show")
                    .removeClass("hide"),
                    $(".home-chat,.head-home")
                    .addClass("hide")
                    .removeClass("show"),
                    (document.getElementById("get-nama").innerHTML = $(this)
                        .children(".info-chat")
                        .children(".chat-nama")
                        .text()),
                    (document.getElementById("get-label").innerHTML = $(this)
                        .children(".info-chat")
                        .children(".chat-label")
                        .text());
            }),
            $(document).on("click", ".close-chat", function() {
                $("#whatsapp-chat")
                    .addClass("hide")
                    .removeClass("show");
            }),
            $(document).on("click", ".blantershow-chat", function() {
                $("#whatsapp-chat")
                    .addClass("show")
                    .removeClass("hide");
            });


        $(document).ready(function() {
            $(".rsshead a").attr("target", "_");
        });
        </script>


</body>