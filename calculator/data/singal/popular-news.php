 <?php 
$rvPopularNewsdata = fetchDatasingleAPI('popular-news'); 
if (isset($rvPopularNewsdata['error']) || empty($rvPopularNewsdata) || !is_array($rvPopularNewsdata)) {
    echo "<marquee behavior='' direction=''   style='background: #000; display: flex; align-items: center; color:red;'>We're currently experiencing a temporary server issue. Don't worry, our team is already working on it, and the Tools will be back online shortly. Thank you for your patience.</marquee>";
} else { ?>
      
        <iframe src="<?= $rvPopularNewsdata['domainName']; ?>/<?= $rvPopularNewsdata['directoryName']; ?>/<?= $rvPopularNewsdata['toolscat']; ?>/<?= $rvPopularNewsdata['urlName']; ?>?apikey=<?= $rvPopularNewsdata['apikey']; ?>&primarycolor=293895&secondarycolor=a0cd3a&bgcolo=0000" frameBorder={0} height=210px; width="100%" title="<?= $rvPopularNewsdata['directoryName']; ?>"    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<?php } ?>