<?php
ob_start();

require __DIR__ . '/rvm-include/config.php';

ob_clean();

header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

$baseUrl = 'https://www.goldenmeanfinserv.com';

$lastmod = !empty($row['updated_at'])
    ? date('c', strtotime($row['updated_at']))
    : date('c');
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:xhtml="http://www.w3.org/1999/xhtml" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc><?= $baseUrl; ?>/</loc>
        <lastmod><?= $lastmod; ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <?php
    $staticPages = [
        ['url' => 'login.php', 'priority' => '0.80',],
    ];

    foreach ($staticPages as $page) {
        ?>
        <url>
            <loc><?= $baseUrl . '/' . $page['url']; ?></loc>
            <lastmod><?= $lastmod; ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority><?= $page['priority']; ?></priority>
        </url>
        <?php
    }

    if (!isset($con)) {
        echo '<!-- Database connection not found -->';
    } else {

        $result = $con->query("SELECT * FROM `post` ORDER BY `post`.`id` ASC");

        if ($result) {
            while ($row = $result->fetch_assoc()) {

                $url = $baseUrl . "/blog" . $row['slug_url'];

                ?>
                <url>
                    <loc><?= htmlspecialchars($url, ENT_XML1, 'UTF-8'); ?></loc>
                    <lastmod><?= $lastmod; ?></lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>0.60</priority>
                </url>
                <?php
            }
        } else {
            echo '<!-- Query Error: ' . htmlspecialchars($con->error, ENT_XML1, 'UTF-8') . ' -->';
        }
    }
    ?>

</urlset>