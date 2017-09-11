<?php
/**
 * meta box taxonomy functions
 *
 */



function client_define_tax_metas() {
	$client_taxes = array(
		array(
			'taxname' 			=> 'client-cat',
			'values' 			=> array(
				array(		
					'type' 		=> 'getsidebar',
					'fn' 		=> 'rin_cat_sbar',
					'heading'	=> __('サイドバー', 'ringo'),
					'options'	=> '',
					'desc' 		=> __('カテゴリーごとに異なるサイドバーを設定できます。', 'ringo')
				),
				array(		
					'type' 		=> 'getselect',
					'fn' 		=> 'rin_cat_opt',
					'heading'	=> __('サイドバーの表示場所', 'ringo'),
					'options'	=> array(__('右','ringo'),__('左','ringo'),__('なし','ringo')),
					'desc' 		=> __('カテゴリーアーカイブページでのサイドバーの表示位置を選択してください。', 'ringo')
				)
			)
		)
	);
	return apply_filters( 'client_define_tax_metas',$client_taxes );
}


// ADDS THE TAXONOMY TERMS IN THE TAXONOMY PAGE
function client_taxonomy_fieldadd() {

	$op = '';


	// CHECK VALUES AND PERMISSIONS
	if ( is_admin() && isset( $_GET['taxonomy'] )) {
		$client_taxname = $_GET['taxonomy'];
	}
	

	// WALKS THROUGH ARRAYS
	foreach (client_define_tax_metas() as $rinv){
		if (isset($rinv['taxname']) && $rinv['taxname'] == $client_taxname) {
			if (isset($rinv['values'])){$rinvarr = $rinv['values'];}
			foreach ($rinvarr as $rinvv) {


				// START THE FIELD
				$op .= '<div class="form-field">';
				$op .= '<label for="term_meta[' . $rinvv['fn']  . ']">' .  $rinvv['heading'] . '</label>';



				// FORMFIELD TYPE SWITCHER
				switch ($rinvv['type']) {
					case 'getinput':
						$op .= '<input type="text" name="term_meta[' . $rinvv['fn']  . ']" id="term_meta[' . $rinvv['fn']  . ']" value="">';
					break;	

					case 'getsidebar':
						$optlist = get_option( 'ringosh_sidebars');
						$op .= '<select  name="term_meta[' . $rinvv['fn']  . ']" id="term_meta[' . $rinvv['fn']  . ']">';
						$op .= '<option value="0">' . __('メインサイドバー', 'ringo') . '</option>';

						if (isset($optlist) && $optlist != '') {
							foreach ($optlist as $rinv) {

								$op .= '<option value="' .  sanitize_title($rinv)  . '">' . $rinv  .   '</option>';
							}

						}
						$op .= '</select>';
					break;

					case 'getselect':
						$op .= '<select  name="term_meta[' . $rinvv['fn']  . ']" id="term_meta[' . $rinvv['fn']  . ']">';

						$ctr = 1;
						foreach ($rinvv['options']  as $rinv) {
							$op .= '<option value="' . $ctr  . '">' . $rinv  .   '</option>';
							$ctr++;
						}

						$op .= '</select>';
					break;
				}


				// CLOSE THE FIELD
				$op .= '<p class="description">' .  $rinvv['desc']  . '</p>';
				$op .= '</div>';

			}
		}
	}

	echo $op;
}



// Edit term page
function client_taxonomy_fieldedit($term) {


	$trm_id = $term->term_id;
	$term_meta = get_option( 'taxonomy_' . $trm_id);
	$op = '';

	// CHECK VALUES AND PERMISSIONS
	if ( is_admin() && isset( $_GET['taxonomy'] )) {
		$client_taxname = $_GET['taxonomy'];
	}

	$sdef = 'taxonomy_' . $_GET['tag_ID'];

	$def = get_option($sdef);
	

	// WALKS THROUGH ARRAYS
	foreach (client_define_tax_metas() as $rinv){

		if (isset($rinv['taxname']) && $rinv['taxname'] == $client_taxname){
			if (isset($rinv['values'])){$rinvarr = $rinv['values'];}
			foreach ($rinvarr as $rinvv) {

				// START THE FIELD
				$op .= '<tr class="form-field"><th scope="row" valign="top">';
				$op .= '<label for="term_meta[' . $rinvv['fn']  . ']">' .  $rinvv['heading'] . '</label><td>';



				// FORMFIELD TYPE SWITCHER
				switch ($rinvv['type']) {
					case 'getinput':
						$op .= '<input type="text" name="term_meta[' . $rinvv['fn']  . ']" id="term_meta[' . $rinvv['fn']  . ']" value="">';
					break;	

					case 'getsidebar':
						$optlist = get_option( 'ringosh_sidebars');
						$op .= '<select  name="term_meta[' . $rinvv['fn']  . ']" id="term_meta[' . $rinvv['fn']  . ']">';
						$op .= '<option value="0">' . __('メインサイドバー', 'ringo') . '</option>';
						

						if (isset($optlist) && $optlist != '') {
							foreach ($optlist as $rinv) {

								$op .= '<option value="' .  sanitize_title($rinv)  . '" ' . selected( $def[$rinvv['fn']], sanitize_title($rinv), false ) . '>' . $rinv  .   '</option>';
							}

						}
						$op .= '</select>';
					break;

					case 'getselect':
						$op .= '<select  name="term_meta[' . $rinvv['fn']  . ']" id="term_meta[' . $rinvv['fn']  . ']">';

						$ctr = 1;
						foreach ($rinvv['options']  as $rinv) {
							$op .= '<option value="' . $ctr  . '"  ' . selected( $def[$rinvv['fn']], $ctr, false ) . '>' . $rinv  .   '</option>';
							$ctr++;
						}

						$op .= '</select>';
					break;				
				}


				// CLOSE THE FIELD
				$op .= '<p class="description">' .  $rinvv['desc']  . '</p></td>';
				$op .= '</th></tr>';
			}
		}
	}

	echo $op;
}




// Save extra taxonomy fields callback function.
function client_save_taxmeta( $term_id ) {
	$pr = client_define_tax_metas();
	$pname = '';
	$tmeta = '';
	foreach ($pr as $value) {
		if ($value['taxname'] == $_POST['taxonomy']){
			$pname = $value['taxname'];
		}
	}
	if ($pname && isset($_POST['taxonomy'])) { 
		$term_meta = get_option( 'taxonomy_' . $term_id );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
				update_option( 'taxonomy_' . $term_id, $term_meta);
			}
		}
	}
}
if ( isset( $_GET['taxonomy'] )) {
	add_action( $_GET['taxonomy'] . '_add_form_fields', 'client_taxonomy_fieldadd', 10, 2 );
	add_action( $_GET['taxonomy'] . '_edit_form_fields', 'client_taxonomy_fieldedit', 10, 2 );
}
if ( isset( $_POST['taxonomy'] )) {
	add_action( 'edited_' . $_POST['taxonomy'] , 'client_save_taxmeta', 10, 2 );  
	add_action( 'create_' . $_POST['taxonomy'] , 'client_save_taxmeta', 10, 2 );
}
?>