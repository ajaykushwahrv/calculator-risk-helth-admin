<?php
include('include/function.php');

$rvaslug = $_GET['slug'] ?? '';
$rvaslug = trim($rvaslug);

if ($rvaslug === '') {
    header("Location: /rv-not-found.php");
    exit;
}

$Serviceurl = '/' . $rvaslug;
$Service = getServicesBySlug($con, $Serviceurl);

$rvasfound = false;
$pageType = '';
$pageData = null;

if (is_array($Service) && !empty($Service['slug_url']) && $Serviceurl === $Service['slug_url']) {
    $pageType = 'service';
    $pageData = $Service;
} else {
    foreach ($rvasallaudits as $rvasitems) {
        $rvasfile = $rvasitems['rvasfile'] ?? '';

        if ($rvaslug === $rvasfile) {
            $rvasfound = true;
            $pageType = 'dynamic';
            $pageData = $rvasitems;
            break;
        }
    }

    if (!$rvasfound) {
        header("Location: /rv-not-found.php");
        exit;
    }
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php if ($pageType === 'service') { ?>

        <title><?= e($userinfo['name'] ?? '') ?> || <?= e($pageData['title'] ?? '') ?></title>
        <meta name="description" content="<?= e($pageData['metadescription'] ?? '') ?>">
        <meta name="keywords" content="<?= e($pageData['keyword'] ?? '') ?>">
        <meta name="author" content="<?= e($userinfo['name'] ?? '') ?>">
        <link rel="canonical" href="<?= e($userinfo['base_url'] ?? '') ?>/<?= e($rvaslug) ?>">

        <?php include("include/head.php"); ?>
        <link rel="stylesheet" href="<?= e($userinfo['base_url'] ?? '') ?>/assets/css/common/services-page.css">

    <?php } else { ?>

        <title><?= e($userinfo['name'] ?? '') ?> || <?= e($pageData['title'] ?? '') ?></title>
        <meta name="description" content="<?= e($pageData['metadescription'] ?? '') ?>">
        <meta name="keywords" content="<?= e($pageData['keyword'] ?? '') ?>">
        <meta name="author" content="<?= e($userinfo['name'] ?? '') ?>">
        <link rel="canonical" href="<?= e($userinfo['base_url'] ?? '') ?>/<?= e($pageData['rvasfile'] ?? '') ?>">

        <?php include("include/head.php"); ?>

        <style>
            .about-home-section h6 {
                font-size: 1.1rem;
            }
        </style>

    <?php } ?>
</head>

<body data-page="<?= $pageType === 'service' ? 'services' : 'aboutus' ?>">

    <?php include('include/header.php'); ?>

    <?php if ($pageType === 'service') { ?>

        <section class="top-banner-section"
            style="background-image:url('<?= e($userinfo['base_url'] ?? '') ?>/assets/images/admin/webpage/<?= e($pageData['img'] ?? '') ?>');">
            <div class="banner-box container">
                <h1><?= e($pageData['title'] ?? '') ?></h1>
            </div>
        </section>

        <section class="main-section services-page-section">
            <div class="container">

                <div class="info-box">
                    <div class="image">
                        <img src="<?= e($userinfo['base_url'] ?? '') ?>/assets/images/admin/webpage/<?= e($pageData['img_content'] ?? '') ?>"
                            alt="<?= e($pageData['title'] ?? '') ?>">
                    </div>

                    <div>
                        <?= $pageData['description'] ?? '' ?>
                    </div>
                </div>

                <?php if (!empty($pageData['get_in_touch'])) { ?>
                    <div class="mt-4">
                        <a href="<?= e($userinfo['base_url'] ?? '') ?>/contact-us.php" class="btn btn-primary">
                            <span><?= e($pageData['get_in_touch']) ?> <i class="bi bi-arrow-right"></i></span>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </section>

    <?php } else { ?>

        <section class="top-banner-section">
            <div class="banner-box container">
                <h1><?= e($pageData['title'] ?? '') ?></h1>
            </div>
        </section>

        <section class="main-section about-home-section">
            <div class="container">
                <?= rv_fetchDynamic($rvaslug, $config_data); ?>
            </div>
        </section>

    <?php } ?>

    <?php include('include/footer.php'); ?>
    <?php include('include/foot.php'); ?>

</body>

</html>