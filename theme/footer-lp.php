<?php
	// File Security Check
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( 'このページヘアクセスする権限がありません！　　　You do not have sufficient permissions to access this page!' );
	}
?>
<div id="page-top" class="rin_cust_bg"><a href="#PageTop" title="一番上まで行く"><i class="fa fa-arrow-up"></i></a></div>
<?php wp_footer(); ?>
</body>
</html>