<?php
include('include/function.php');

/*
|--------------------------------------------------------------------------
| MAIN ROUTER
|--------------------------------------------------------------------------
| Supports:
| 1. Blog listing        /blog
| 2. Blog detail         /blog/blog-slug
| 3. Service page        /service-slug
| 4. Dynamic page        /dynamic-slug
|--------------------------------------------------------------------------
*/

$rvaslug = $_GET['slug'] ?? '';
$rvaslug = trim($rvaslug, " /");

/*
|--------------------------------------------------------------------------
| Blog routing
|--------------------------------------------------------------------------
| If your .htaccess sends /blog or /blog/slug to this file using ?slug=...
| this block handles both listing and detail pages.
*/
$isBlog = ($rvaslug === 'blog' || strpos($rvaslug, 'blog/') === 0);

$blogSlug = '';

if ($isBlog) {
    $blogSlug = trim(substr($rvaslug, 5), " /");
}

/*
|--------------------------------------------------------------------------
| Blog detail
|--------------------------------------------------------------------------
*/
$post = null;
$category = null;
$post_id = null;
$blog_id = null;

if ($isBlog && $blogSlug !== '') {

    $post = getPostBySlug($con, '/' . $blogSlug);

    /*
     * Some existing getPostBySlug() implementations may expect only the
     * slug. If the above does not return a post, try the raw slug.
     */
    if (!is_array($post) || empty($post['id'])) {
        $post = getPostBySlug($con, $blogSlug);
    }

    if (!is_array($post) || empty($post['id'])) {
        header("Location: /rv-not-found.php", true, 302);
        exit;
    }

    $post_id = $post['id'];
    $blog_id = $post['category_id'] ?? 0;

    if ($blog_id) {
        $category = rvFetchSingleData(
            $con,
            $blog_id,
            'id',
            'post_category'
        );
    }
}

/*
|--------------------------------------------------------------------------
| Service / Dynamic page routing
|--------------------------------------------------------------------------
*/
$rvasfound = false;
$pageType = '';
$pageData = null;

if (!$isBlog) {

    if ($rvaslug === '') {
        header("Location: /rv-not-found.php", true, 302);
        exit;
    }

    $Serviceurl = '/' . $rvaslug;
    $Service = getServicesBySlug($con, $Serviceurl);

    if (
        is_array($Service) &&
        !empty($Service['slug_url']) &&
        $Serviceurl === $Service['slug_url']
    ) {
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
            header("Location: /rv-not-found.php", true, 302);
            exit;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Escape helper
|--------------------------------------------------------------------------
*/
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/*
|--------------------------------------------------------------------------
| Page variables
|--------------------------------------------------------------------------
*/
if ($isBlog) {

    if ($post) {
        $pageTitle = $post['title'] ?? 'Blog';
        $metaDescription = $post['metadescription'] ?? '';
        $metaKeywords = $post['keyword'] ?? '';
        $canonical = ($userinfo['base_url'] ?? '') . '/blog' . ($post['slug_url'] ?? '');
    } else {
        $pageTitle = 'Blog';
        $metaDescription = '';
        $metaKeywords = '';
        $canonical = ($userinfo['base_url'] ?? '') . '/blog';
    }

} else {

    $pageTitle = $pageData['title'] ?? '';
    $metaDescription = $pageData['metadescription'] ?? '';
    $metaKeywords = $pageData['keyword'] ?? '';

    if ($pageType === 'service') {
        $canonical = ($userinfo['base_url'] ?? '') . '/' . $rvaslug;
    } else {
        $canonical = ($userinfo['base_url'] ?? '') . '/' . ($pageData['rvasfile'] ?? '');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= e($userinfo['name'] ?? '') ?> || <?= e($pageTitle) ?></title>

    <meta name="description" content="<?= e($metaDescription) ?>">
    <meta name="keywords" content="<?= e($metaKeywords) ?>">
    <meta name="author" content="<?= e($userinfo['name'] ?? '') ?>">

    <link rel="canonical" href="<?= e($canonical) ?>">

    <?php include('include/head.php'); ?>

    <?php if ($pageType === 'service') { ?>

    <link rel="stylesheet" href="<?= e($userinfo['base_url'] ?? '') ?>/assets/css/common/services-page.css">

    <?php } elseif ($pageType === 'dynamic') { ?>

    <style>
    .about-home-section h6 {
        font-size: 1.1rem;
    }
    </style>

    <?php } ?>

</head>

<body data-page="<?= $isBlog ? 'blog' : ($pageType === 'service' ? 'services' : 'aboutus') ?>">

    <?php include('include/header.php'); ?>


    <?php
/*
|--------------------------------------------------------------------------
| BLOG
|--------------------------------------------------------------------------
*/
if ($isBlog) {
?>

    <?php allPagesBanner($con, 2); ?>

    <?php if ($post) { ?>

    <!-- =========================================================
             BLOG DETAIL
        ========================================================== -->

    <section class="main-section blog_section pt-0">

        <div class="container">

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-8">

                    <div class="post-detail">

                        <div class="main_heading pb-0">
                            <h2><?= e($post['title'] ?? '') ?></h2>
                        </div>

                        <span class="time">
                            <a class="badge bg-primary">
                                <?= !empty($post['date_time'])
                                        ? date('F jS, Y', strtotime($post['date_time']))
                                        : '' ?>
                            </a>
                        </span>

                        <?php if (!empty($category['name'])) { ?>
                        <span class="category">
                            <a class="badge bg-secondary">
                                <?= e($category['name']) ?>
                            </a>
                        </span>
                        <?php } ?>

                        <?php if (!empty($post['img'])) { ?>

                        <div class="view_img mt-3">

                            <img class="d-block w-100"
                                src="<?= e($userinfo['base_url'] ?? '') ?>/assets/images/admin/blog/<?= e($post['img']) ?>"
                                alt="<?= e($post['title'] ?? '') ?>" title="<?= e($post['title'] ?? '') ?>">

                        </div>

                        <?php } ?>

                        <div class="info">

                            <?= $post['content'] ?? '' ?>

                        </div>

                    </div>


                    <!-- Social Share -->

                    <div class="social-media-share">

                        <h4>Share On Social Media</h4>

                        <ul class="social-list mt-4">

                            <li>
                                <a href="https://www.facebook.com/sharer.php?u=<?= urlencode($canonical) ?>"
                                    aria-label="Facebook" target="_blank" rel="nofollow noopener noreferrer"
                                    title="Facebook">
                                    <i class="bi bi-facebook fa-fw"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://twitter.com/intent/tweet?url=<?= urlencode($canonical) ?>"
                                    aria-label="Twitter" target="_blank" rel="nofollow noopener noreferrer"
                                    title="Twitter">
                                    <i class="bi bi-twitter-x fa-fw"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($canonical) ?>"
                                    aria-label="Linkedin" target="_blank" rel="nofollow noopener noreferrer"
                                    title="Linkedin">
                                    <i class="bi bi-linkedin fa-fw"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://t.me/share/url?url=<?= urlencode($canonical) ?>" aria-label="Telegram"
                                    target="_blank" rel="nofollow noopener noreferrer" title="Telegram">
                                    <i class="bi bi-telegram fa-fw"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://wa.me/?text=<?= urlencode($canonical) ?>" aria-label="Whatsapp"
                                    target="_blank" rel="nofollow noopener noreferrer" title="Whatsapp">
                                    <i class="bi bi-whatsapp fa-fw"></i>
                                </a>
                            </li>

                            <li>
                                <a href="mailto:?subject=Article&body=<?= urlencode($canonical) ?>" aria-label="Email"
                                    target="_blank" rel="nofollow noopener noreferrer" title="Email">
                                    <i class="bi bi-envelope fa-fw"></i>
                                </a>
                            </li>

                            <li>
                                <span id="clickCopyString" data-copy-url="<?= e($canonical) ?>" aria-label="Copy"
                                    title="Copy Link">
                                    <i class="bi bi-copy fa-fw"></i>
                                </span>
                            </li>

                        </ul>

                    </div>

                </div>


                <!-- Related Posts -->

                <div class="col-sm-12 col-md-12 col-lg-4">

                    <div class="main_heading pb-0">

                        <div class="main-heading ml-0">
                            <h3 class="main-title">Related Post</h3>
                        </div>

                    </div>

                    <div class="related-section-content">

                        <div class="latest-blog-loop">

                            <?php

                                if ($blog_id) {

                                    $relatedPosts = rvFetchAllDataSpecific(
                                        $con,
                                        $blog_id,
                                        'category_id',
                                        'post'
                                    );

                                    foreach ($relatedPosts as $relatedPost) {

                                        if (($relatedPost['id'] ?? 0) == $post_id) {
                                            continue;
                                        }

                                        ?>

                            <div class="item">

                                <a
                                    href="<?= e($userinfo['base_url'] ?? '') ?>/blog<?= e($relatedPost['slug_url'] ?? '') ?>">

                                    <div class="blog">

                                        <div class="images">

                                            <?php if (!empty($relatedPost['img'])) { ?>

                                            <img src="<?= e($userinfo['base_url'] ?? '') ?>/assets/images/admin/blog/<?= e($relatedPost['img']) ?>"
                                                alt="<?= e($relatedPost['title'] ?? '') ?>"
                                                title="<?= e($relatedPost['title'] ?? '') ?>">

                                            <?php } ?>

                                        </div>

                                        <div class="client-info">

                                            <ul>

                                                <li>
                                                    <?= e($category['name'] ?? '') ?>
                                                </li>

                                                <li>
                                                    <?= !empty($relatedPost['date_time'])
                                                                    ? date('M d, Y', strtotime($relatedPost['date_time']))
                                                                    : '' ?>
                                                </li>

                                            </ul>

                                            <h4 class="text-lin-2">
                                                <?= e($relatedPost['title'] ?? '') ?>
                                            </h4>

                                        </div>

                                    </div>

                                </a>

                            </div>

                            <?php
                                    }
                                }
                                ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <?php } else { ?>

    <!-- =========================================================
             BLOG LISTING
        ========================================================== -->

    <section class="main-section blog-section pt-0">

        <div class="container">

            <!-- Tabs -->

            <ul class="blog-tabs">

                <li class="tab-btn active" data-tab="all">
                    All
                </li>

                <?php

                    $categories = rvFetchAllData($con, 'post_category');

                    foreach ($categories as $cat) {

                        ?>

                <li class="tab-btn" data-tab="cat<?= e($cat['id']) ?>">
                    <?= e($cat['name']) ?>
                </li>

                <?php } ?>

            </ul>


            <!-- Tabs Content -->

            <div class="custom-tab-content">


                <!-- All Blogs -->

                <div class="custom-tab-pane active" id="all">

                    <div class="row g-4">

                        <?php

                            $posts = rvFetchAllData($con, 'post');

                            foreach ($posts as $postItem) {

                                $postCategory = rvFetchSingleData(
                                    $con,
                                    $postItem['category_id'],
                                    'id',
                                    'post_category'
                                );

                                ?>

                        <div class="col-lg-4 col-md-6">

                            <div class="blog-card">

                                <a
                                    href="<?= e($userinfo['base_url'] ?? '') ?>/blog<?= e($postItem['slug_url'] ?? '') ?>">

                                    <div class="blog-img">

                                        <?php if (!empty($postItem['img'])) { ?>

                                        <img src="<?= e($userinfo['base_url'] ?? '') ?>/assets/images/admin/blog/<?= e($postItem['img']) ?>"
                                            alt="<?= e($postItem['title'] ?? '') ?>"
                                            title="<?= e($postItem['title'] ?? '') ?>">

                                        <?php } ?>

                                        <span class="blog-tag">
                                            <?= e($postCategory['name'] ?? '') ?>
                                        </span>

                                    </div>

                                    <div class="blog-body">

                                        <ul class="blog-meta">

                                            <li>
                                                <i class="fa fa-user"></i>
                                                Admin
                                            </li>

                                            <li>
                                                <i class="fa fa-calendar"></i>
                                                <?= !empty($postItem['date_time'])
                                                            ? date('M d, Y', strtotime($postItem['date_time']))
                                                            : '' ?>
                                            </li>

                                        </ul>

                                        <h5 class="blog-title">
                                            <?= e($postItem['title'] ?? '') ?>
                                        </h5>

                                    </div>

                                </a>

                            </div>

                        </div>

                        <?php } ?>

                    </div>

                </div>


                <!-- Category Blogs -->

                <?php

                    foreach ($categories as $cat) {

                        $catPosts = rvFetchAllDataSpecific(
                            $con,
                            $cat['id'],
                            'category_id',
                            'post'
                        );

                        ?>

                <div class="custom-tab-pane" id="cat<?= e($cat['id']) ?>">

                    <div class="row g-4">

                        <?php foreach ($catPosts as $catPost) { ?>

                        <div class="col-lg-4 col-md-6">

                            <div class="blog-card">

                                <a
                                    href="<?= e($userinfo['base_url'] ?? '') ?>/blog<?= e($catPost['slug_url'] ?? '') ?>">

                                    <div class="blog-img">

                                        <?php if (!empty($catPost['img'])) { ?>

                                        <img src="<?= e($userinfo['base_url'] ?? '') ?>/assets/images/admin/blog/<?= e($catPost['img']) ?>"
                                            alt="<?= e($catPost['title'] ?? '') ?>"
                                            title="<?= e($catPost['title'] ?? '') ?>">

                                        <?php } ?>

                                        <span class="blog-tag">
                                            <?= e($cat['name']) ?>
                                        </span>

                                    </div>

                                    <div class="blog-body">

                                        <ul class="blog-meta">

                                            <li>
                                                <i class="fa fa-user"></i>
                                                Admin
                                            </li>

                                            <li>
                                                <i class="fa fa-calendar"></i>
                                                <?= !empty($catPost['date_time'])
                                                                ? date('M d, Y', strtotime($catPost['date_time']))
                                                                : '' ?>
                                            </li>

                                        </ul>

                                        <h5 class="blog-title">
                                            <?= e($catPost['title'] ?? '') ?>
                                        </h5>

                                    </div>

                                </a>

                            </div>

                        </div>

                        <?php } ?>

                    </div>

                </div>

                <?php } ?>

            </div>

        </div>

    </section>

    <?php } ?>


    <?php
/*
|--------------------------------------------------------------------------
| SERVICE PAGE
|--------------------------------------------------------------------------
*/
} elseif ($pageType === 'service') {
?>

    <?php allPagesBanner1($con, e($pageData['title'] ?? '')); ?>

    <section class="main-section services-page-section pt-0">

        <div class="container">

            <div class="info-box">

                <div>
                    <?= $pageData['description'] ?? '' ?>
                </div>

            </div>

            <?php if (!empty($pageData['get_in_touch'])) { ?>

            <div class="mt-4">

                <a href="<?= e($userinfo['base_url'] ?? '') ?>/contact-us.php" class="btn btn-primary">

                    <span>
                        <?= e($pageData['get_in_touch']) ?>
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </a>

            </div>

            <?php } ?>

        </div>

    </section>


    <?php
/*
|--------------------------------------------------------------------------
| DYNAMIC PAGE
|--------------------------------------------------------------------------
*/
} else {
?>

    <?php allPagesBanner1($con, e($pageData['title'] ?? '')); ?>

    <section class="main-section about-home-section pt-0">

        <div class="container">

            <?= rv_fetchDynamic($rvaslug, $config_data); ?>

        </div>

    </section>

    <?php } ?>


    <?php if ($isBlog) { ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const tabs = document.querySelectorAll(".blog-tabs .tab-btn");
        const panes = document.querySelectorAll(".custom-tab-pane");

        tabs.forEach(function(tab) {

            tab.addEventListener("click", function() {

                tabs.forEach(function(t) {
                    t.classList.remove("active");
                });

                panes.forEach(function(p) {
                    p.classList.remove("active");
                });

                this.classList.add("active");

                const target = document.getElementById(
                    this.dataset.tab
                );

                if (target) {
                    target.classList.add("active");
                }

            });

        });


        /*
         * Copy blog URL
         */

        const copyButton = document.getElementById("clickCopyString");

        if (copyButton) {

            copyButton.addEventListener("click", function() {

                const url = this.getAttribute("data-copy-url");

                if (navigator.clipboard && url) {

                    navigator.clipboard.writeText(url)
                        .then(function() {

                            const oldTitle =
                                copyButton.getAttribute("title");

                            copyButton.setAttribute(
                                "title",
                                "Copied!"
                            );

                            setTimeout(function() {

                                copyButton.setAttribute(
                                    "title",
                                    oldTitle || "Copy Link"
                                );

                            }, 1500);

                        })
                        .catch(function() {
                            console.log("Unable to copy URL.");
                        });

                }

            });

        }

    });
    </script>

    <?php } ?>


    <?php include('include/footer.php'); ?>
    <?php include('include/foot.php'); ?>

</body>

</html>