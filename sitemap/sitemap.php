<?php
ob_start();

require __DIR__ . '/rvm-include/config.php';

ob_clean();

header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

$baseUrl = 'https://www.redvisiontechnologies.com';

$lastmod = !empty($row['updated_at'])
    ? date('c', strtotime($row['updated_at']))
    : date('c');
?>
<!-- Page Type	Priority
Homepage	1.0
Main Service Pages	0.9
Category Pages	0.8
Important Landing Pages	0.8
Blog Category Pages	0.7
Blog Posts	0.6
Contact/About Us	0.5
Privacy Policy/Terms	0.3 -->

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:xhtml="http://www.w3.org/1999/xhtml" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc><?= $baseUrl; ?>/</loc>
        <lastmod><?= $lastmod; ?></lastmod>
        <priority>1.0</priority>
    </url>

    <?php
    $staticPages = [
        ['url' => 'about.php', 'priority' => '0.50',],
        ['url' => 'mutual-fund-software-for-distributors.php', 'priority' => '0.90',],

    ];
    if (isset($con)) {

        $result = $con->query("SELECT slug_url, updated_at FROM post ORDER BY id ASC");

        if ($result) {
            while ($row = $result->fetch_assoc()) {

                $slug = trim($row['slug_url']);
                $slug = ltrim($slug, '/');

                $staticPages[] = [
                    'url' => 'blog/' . $slug,
                    'priority' => '0.64',
                    'lastmod' => !empty($row['updated_at'])
                        ? date('c', strtotime($row['updated_at']))
                        : date('c')
                ];
            }
        }
    }
    usort($staticPages, function ($a, $b) {

        // Priority High → Low
        $priorityCompare = (float) $b['priority'] <=> (float) $a['priority'];

        if ($priorityCompare !== 0) {
            return $priorityCompare;
        }

        // Same priority ho to URL ke according A → Z
        return strcasecmp($a['url'], $b['url']);
    });
    foreach ($staticPages as $page) {

        $url = rtrim($baseUrl, '/') . '/' . ltrim($page['url'], '/');

        $pageLastmod = !empty($page['lastmod'])
            ? $page['lastmod']
            : $lastmod;
        ?>
        <url>
            <loc><?php echo htmlspecialchars($url, ENT_XML1, 'UTF-8'); ?></loc>
            <lastmod><?php echo htmlspecialchars($pageLastmod, ENT_XML1, 'UTF-8'); ?></lastmod>
            <priority><?php echo htmlspecialchars($page['priority'], ENT_XML1, 'UTF-8'); ?></priority>
        </url>
    <?php } ?>

</urlset>