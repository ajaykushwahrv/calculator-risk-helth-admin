<?php if (isset($usefullinksData['error']) || empty($usefullinksData) || !is_array($usefullinksData)) { ?>
    <marquee behavior='' direction='' style='display: flex; align-items: center; color:red;'>We're currently experiencing a
     temporary server issue. Don't worry, our team is already working on it, and the Tools will be back online shortly.
     Thank you for your patience. </marquee>
    <?php } else { $i=1; if (!empty($usefullinksData)) {  foreach($usefullinksData as $usefullinksitems): ?>
     
<?= $usefullinksitems['link']; ?>
<?=  $usefullinksitems['title']; ?>
<?=  $usefullinksitems['description'];?>
<?= $usefullinksitems['image']; ?>
https://redvisionweb.com/ 
    <li><a href="<?= $usefullinksitems['link']; ?>" target="_blank" aria-label="<?=  $usefullinksitems['title']; ?>"><?=  $usefullinksitems['title']; ?></a></li>
<?php $i++; endforeach; } else { echo "<p>Currently Data not Available. Please try again later.</p>"; }  } ?>
							
					