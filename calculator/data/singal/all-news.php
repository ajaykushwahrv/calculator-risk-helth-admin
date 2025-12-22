 <?php 
$rvallNewsdata = fetchDatasingleAPI('all-news');  
if (isset($rvallNewsdata['error']) || empty($rvallNewsdata) || !is_array($rvallNewsdata)) {
    echo "<marquee behavior='' direction=''   style='background: #000; display: flex; align-items: center; color:red;'>We're currently experiencing a temporary server issue. Don't worry, our team is already working on it, and the Tools will be back online shortly. Thank you for your patience.</marquee>";
} else { ?>
<iframe 
    id="fundNews"
    frameborder="0" 
    height="280" 
    width="100%" 
    title="<?= $rvallNewsdata['directoryName']; ?>"
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade"
    >
</iframe>

<script>
// CSS variables se values lo
const rvPrimary1   = getComputedStyle(document.documentElement).getPropertyValue('--rvc-primary').trim().replace("#","");
const rvSecondary1 = getComputedStyle(document.documentElement).getPropertyValue('--rvc-secondary-light').trim().replace("#","");

// Iframe ka src JS se set karo
document.getElementById("fundNews").src =
    "<?= $rvallNewsdata['domainName']; ?>/<?= $rvallNewsdata['directoryName']; ?>/<?= $rvallNewsdata['toolscat']; ?>" +
    "?apikey=<?= $rvallNewsdata['apikey']; ?>" +
    "&primarycolor=" + rvPrimary1 +
    "&secondarycolor=" + rvSecondary1 +
    "&bgcolo=0000&primaryactive=fff" ;
</script>


<?php } ?>




 

