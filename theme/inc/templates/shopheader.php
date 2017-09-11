<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'このページヘアクセスする権限がありません！　　　You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * The template for displaying the header and header image
 *
 *
 * @author 		Ringo
 * @package 	templates
 * @version     1.0
 */


$headimg = get_header_image();
$defimg  = get_template_directory_uri() . '/assets/styles/framework-images/defimg.jpg';
$ringotitle = '';


$ringotitle 	= '<h1 class="rin_cust_font">' . woocommerce_page_title() . '</h1>';


?>
<!-- draw the section -->
<section id="ringoheader">
	<div class="row rin_headerrow">
		<div class="large-12 column rin_headerrow">
			<div class="page_title">
				<div class="page_title_inner">
					<?php echo $ringotitle; ?>
				</div>
			</div>
		</div>
	</div>
</section>
