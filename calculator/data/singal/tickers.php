 <?php 
$rvtickersdata = fetchDatasingleAPI('tickers'); 
if (isset($rvtickersdata['error']) || empty($rvtickersdata) || !is_array($rvtickersdata)) {
    echo "<marquee behavior='' direction=''   style='background: #000; display: flex; align-items: center; color:red;'>We're currently experiencing a temporary server issue. Don't worry, our team is already working on it, and the Tools will be back online shortly. Thank you for your patience.</marquee>";
} else { ?>
    <div style="position: relative; height: 48px;">
     
        <iframe src="<?= $rvtickersdata['domainName']; ?>/<?= $rvtickersdata['directoryName']; ?>/<?= $rvtickersdata['toolscat']; ?>/<?= $rvtickersdata['urlName']; ?>?apikey=<?= $rvtickersdata['apikey']; ?>&primarycolor=000&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} width="100%" height="48px" title="<?= $rvtickersdata['directoryName']; ?>"    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
<?php } ?>