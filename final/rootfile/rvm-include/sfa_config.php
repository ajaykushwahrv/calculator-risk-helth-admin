<?php 
  return [
    'db' => [
      'dsn' => 'mysql:host=localhost;dbname=data;charset=utf8mb4',
      'user' => 'user',   
      'pass' => 'sdasd',        
      'rdata' => 'data',  
    ],

    'smtp' => [
      'host' => 'smtp.gmail.com',   
      'port' => 587,                     
      'secure' => 'tls',                     
      'username' => 'ajaykushwahredvision@gmail.com', //smtp email
      'password' => 'zojfafebkxycwuvh',   //smtp password
      'from_email' => 'ajaykushwahredvision@gmail.com', //send email
      'CC_email' => '', 
      'BCC_email' => '', 
    ],

    'otp' => [
      'length' => 6,                  // OTP digits (e.g., 6 = 123456)
      'expiry_seconds' => 300,        // OTP expire time (in seconds) — 300 = 5 minutes
      'max_requests_per_minute' => 3, // Ek user 1 minute me kitni baar OTP maang sakta hai
      'max_attempts' => 3             // OTP verify karne ki max attempts
    ],
    'rvrhcinfo' => [
      'rvrhc_logo'   => '/images/logo.png',
      'rvrhc_favicon'   => '/images/favicon.ico',
      'rvrhc_contact' => '/contact-us.php',
      'rvrhc_rvrh_css' => '/rvm-include/rvrh.css',
      'rvrhc_rvrh_js' => '/rvm-include/rvrh.js',
      'rvrhc_jquery360' => '/rvm-include/jquery-3.6.0.min.js',
      'rvrhc_bootstrap_icons' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
    ],
    'rvuserinfo' => [
      'base_url'   => '',
      'clientname'   => '',
      'designation'   => '',
      'websitename'   => '',
      'email'   => '',
      'mobile'   => '',
      'mobile1'   => '',
      'mobile2'   => '',

      // AMFI AMFI Registered Mutual Fund Distributor | ARN - No | Validity: Start Date TO End Date
      'mfarn'   => '155130',
      'mfarnDate'   => 'AMFI Registered Mutual Fund Distributor | ARN - 155130',

      // APMI APMI Registered PMS Distributor | APRN - No | Validity: Start Date TO End Date
      'apmi'   => '123465',
      'apmiDate'   => '',

      // IRDAI IRDAI Registered Insurance Distributor | IRDAI - No | Validity: Start Date TO End Date
      'irdai'   => '123465',
      'irdaiDate'   => '',
      
      // AIF
      'aif'   => '',
      // SIF
      'sif'   => '',
      // GIFT CITY
      'giftcity'   => '',
      // BONDS 
      'bonds'   => '',

      // GSTIN
      'gstin'   => '',

      // WORKING HOURS
      'workinghours'   => '',
      'city'   => '',

  

      'domain'   => '',
      'address'   => '',
      'mapsrc'   => '',
      'mapurl'   => '',
    ],
    'rvlogin' => [
      'callbackUrl'   => '',
      'siteUrl' => 'https://wealthelite.in',
      'wheatlebalsiteUrl' => ''
    ],
    'webapplinks' => [
      'androidUrl'   => '',
      'iosUrl' => '',
 
    ]
  ];
?>