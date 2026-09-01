<?php $slug = isset($_GET['slug']) ? trim($_GET['slug'], '/') : '';

$title = legalhub_get_page_title($tenantId, $apiBase, $apiKey, $slug);
$pageHtml = legalhub_get_page_html($tenantId, $apiBase, $apiKey, $slug);

if ($pageHtml === null) {
    http_response_code(404);
    exit('Page not found.');
}
?>
<?= htmlspecialchars($title ?? ''); ?>
<?= $pageHtml; ?>