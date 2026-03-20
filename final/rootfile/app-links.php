<?php
// --- Configure your store links ---
include ('include/function.php');
$androidUrl = !empty($config['webapplinks']['androidUrl']) ? $config['webapplinks']['androidUrl'] : 'https://play.google.com/store/search?q=wealth+elite&c=apps';
$iosUrl     = !empty($config['webapplinks']['iosUrl']) ? $config['webapplinks']['iosUrl'] : 'https://apps.apple.com/us/app/wealth-elite/id1518518606';
 
// Optional: desktop/unknown fallback (a landing page with both buttons)
$fallbackUrl = $config['rvuserinfo']['base_url'] . '/app-landing';
 
// --- Basic user-agent detection ---
$ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
 
// iOS (iPhone, iPod, iPad incl. iPadOS Safari)
$isIOS = (strpos($ua, 'iphone') !== false) ||
         (strpos($ua, 'ipad') !== false)   ||
         (strpos($ua, 'ipod') !== false);
 
// Android (phones/tablets/Chrome on Android)
$isAndroid = (strpos($ua, 'android') !== false);
 
// Huawei AppGallery etc. (optional: treat as Android)
$isHuawei = (strpos($ua, 'huawei') !== false) || (strpos($ua, 'honor') !== false);
 
if ($isIOS) {
    header('Location: ' . $iosUrl, true, 302);
    exit;
}
 
if ($isAndroid || $isHuawei) {
    header('Location: ' . $androidUrl, true, 302);
    exit;
}
 
// Everything else (desktop, bots, unknown): show landing or choose one
header('Location: ' . $fallbackUrl, true, 302);
exit;
?>