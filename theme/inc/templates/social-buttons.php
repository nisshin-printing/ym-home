<?php
$changeUrlReal = substr( '.dev', '.com', get_permalink() );
$url_encode   = urlencode( $changeUrlReal );
$title_encode = urlencode( get_the_title() );
?>
<div id="social-buttons" data-permalink="<?php echo $url_encode; ?>">
	<a href="http://twitter.com/intent/tweet?text=<?php echo $title_encode; ?> <?php echo $url_encode; ?>" class="waves-effect btn-twitter" target="_blank">
		<i class="fa fa-twitter"></i>
		<span id="countjs-twitter">
			<i class="fa fa-spinner fa-spin"></i>
		</span>
	</a>
	<a href="http://www.facebook.com/share.php?u=<?php echo $url_encode; ?>" class="waves-effect btn-facebook" onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"  target="_blank">
		<i class="fa fa-facebook"></i>
		<span id="countjs-facebook">
			<i class="fa fa-spinner fa-spin"></i>
		</span>
	</a>
	<a href="http://b.hatena.ne.jp/entry/<?php echo $url_encode; ?>" class="waves-effect btn-hatena" target="_blank" data-hatena-bookmark-title="<?php echo $title_encode; ?>" data-hatena-bookmark-layout="simple" title="このエントリーをはてなブックマークに追加">
		<i class="fa fa-bookmark"></i>
		<span id="countjs-hatena">
			<i class="fa fa-spinner fa-spin"></i>
		</span>
	</a>
	<a href="https://plus.google.com/share?url=<?php echo $url_encode; ?>" onclick="window.open(this.href, 'Gwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="waves-effect btn-googleplus">
		<i class="fa fa-google-plus"></i>
		<span id="countjs-googleplus">
			<i class="fa fa-spinner fa-spin"></i>
		</span>
	</a>
	<a href="http://getpocket.com/edit?url=<?php echo $url_encode; ?>" class="waves-effect btn-pocket" target="_blank">
		<i class="fa fa-get-pocket"></i>
		<span id="countjs-pocket">
			<i class="fa fa-spinner fa-spin"></i>
		</span>
	</a>
</div>