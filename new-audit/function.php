$tenantId = 'id';
$apiBase = 'https://legal-webplatform.vercel.app';
$apiKey = 'pass';

function legalhub_fetch($url, $apiKey)
{
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-Api-Key: $apiKey"]);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$body = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
return ($status === 200 && $body !== false) ? $body : null;
}
function legalhub_footer($tenantId, $apiBase, $apiKey)
{
$html = legalhub_fetch("$apiBase/api/v1/$tenantId/footer/render", $apiKey);
if ($html === null)
return '';
return str_replace("/$tenantId/legal/", "/", $html);
}
function legalhub_get_page_title($tenantId, $apiBase, $apiKey, $slug)
{
$json = legalhub_fetch("$apiBase/api/v1/$tenantId/legal-pages/$slug", $apiKey);
if ($json === null)
return null;
$data = json_decode($json, true);
return $data['title'] ?? null;
}

function legalhub_get_page_html($tenantId, $apiBase, $apiKey, $slug)
{
return legalhub_fetch("$apiBase/api/v1/$tenantId/legal-pages/$slug/render", $apiKey);
}


function legalhub_amclogo($tenantId, $apiBase, $apiKey)
{
$html = legalhub_fetch("$apiBase/api/v1/$tenantId/amc-logos", $apiKey);

if ($html === null || $html === '') {
return [];
}
$html = str_replace("/$tenantId/legal/", "/", $html);

$data = json_decode($html, true);

if (json_last_error() !== JSON_ERROR_NONE) {
return [];
}
return $data;
}
// $amsclogo = legalhub_amclogo($tenantId, $apiBase, $apiKey);
// $amcLogos = $amsclogo['amcLogos'] ?? [];