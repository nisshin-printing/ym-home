<?php
	global $is_mobile;
	$height = ( $is_mobile ) ? '150' : '400';
?>
<section class="fp-googlemap">
<div id="rin-map" class="map" style="width: 100%; height: <?php echo $height; ?>px;"></div>
</section>