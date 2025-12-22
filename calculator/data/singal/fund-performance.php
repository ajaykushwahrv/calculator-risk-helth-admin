 <?php 
$rvcaliFundPerformancedata = fetchDatasingleAPI('fund-performance'); 
if (isset($rvcaliFundPerformancedata['error']) || empty($rvcaliFundPerformancedata) || !is_array($rvcaliFundPerformancedata)) {
    echo "<marquee behavior='' direction=''   style='background: #000; display: flex; align-items: center; color:red;'>We're currently experiencing a temporary server issue. Don't worry, our team is already working on it, and the Tools will be back online shortly. Thank you for your patience. </marquee>";
} else { ?>

<iframe 
    id="fundFrame"
    frameborder="0" 
    height="480" 
    width="100%"
    title="<?= $rvcaliFundPerformancedata['directoryName']; ?>"
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade"
    >
</iframe>

<script>
// CSS variables se values lo
const rvPrimary   = getComputedStyle(document.documentElement).getPropertyValue('--rvc-primary').trim().replace("#","");
const rvSecondary = getComputedStyle(document.documentElement).getPropertyValue('--rvc-secondary').trim().replace("#","");

// Iframe ka src JS se set karo
document.getElementById("fundFrame").src =
    "<?= $rvcaliFundPerformancedata['domainName']; ?>/<?= $rvcaliFundPerformancedata['directoryName']; ?>/<?= $rvcaliFundPerformancedata['toolscat']; ?>/<?= $rvcaliFundPerformancedata['urlName']; ?>" +
    "?apikey=<?= $rvcaliFundPerformancedata['apikey']; ?>" +
    "&primarycolor=" + rvPrimary +
    "&secondarycolor=" + rvSecondary +
    "&bgcolo=0000&primaryactive=fff&redirecturl=<?= $config['rvuserinfo']['base_url']; ?>/login.php";
</script>
<?php } ?>