<!DOCTYPE html>
<html lang="en">

<?php
session_start();

include("./rvm-include/config.php");
?>



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['rvuserinfo']['websitename']; ?> || Not Found</title>
    <link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
    <link rel="stylesheet" href="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_rvrh_css']; ?>">


    <style>

    </style>
</head>

<body>



    <section class="rvrhsection-section rvrhc-notfound-section">
        <div class="notfound-thank">
            <div class="result-card">
              <div class="logo-images">
                    <img src="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_logo']; ?>" alt="Logo">
                </div>
                <div class="result-card-body">
                    <h1>404</h1>
                    <h3>Sorry, Page Not Found</h3>
                    <p>The page you requested could not be found</p>
                    <div class="btn-box">
                        <a href="<?= $config['rvuserinfo']['base_url']; ?>" class="btn btn-primary">Go To Home</a>
                        <a href="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_contact']; ?>" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>