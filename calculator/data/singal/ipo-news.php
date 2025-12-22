 <?php 
$rvIPONewsdata = fetchDatasingleAPI('ipo-news');  
if (isset($rvIPONewsdata['error']) || empty($rvIPONewsdata) || !is_array($rvIPONewsdata)) {
    echo "<marquee behavior='' direction=''   style='background: #000; display: flex; align-items: center; color:red;'>We're currently experiencing a temporary server issue. Don't worry, our team is already working on it, and the Tools will be back online shortly. Thank you for your patience. </marquee>";
} else { ?>
      
<iframe src="<?= $rvIPONewsdata['domainName']; ?>/<?= $rvIPONewsdata['directoryName']; ?>/<?= $rvIPONewsdata['toolscat']; ?>/<?= $rvIPONewsdata['urlName']; ?>?apikey=<?= $rvIPONewsdata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} height=210px; width="100%" title="<?= $rvIPONewsdata['directoryName']; ?>"    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<?php } ?>