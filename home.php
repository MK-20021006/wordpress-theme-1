<?php get_header(); ?>
<div id="content">
<div id="inner-content" class="fadeIn wrap">

<main id="main">

<?php parts_add_top(); ?>

<?php
	$toplayout = get_option('stk_archivelayout_home', 'toplayout-card');
	$toplayoutsp = get_option('stk_archivelayout_home_sp', 'toplayout-simple');

	if (is_mobile()) {
		if ( $toplayoutsp == "toplayout-text" ) {
			get_template_part( 'parts/archive_text' );
		} elseif ( $toplayoutsp == "toplayout-big" ) {
			get_template_part( 'parts/archive_big' );
		} elseif ( $toplayoutsp == 'toplayout-card' || $toplayoutsp == 'toplayout-card2' || $toplayoutsp == 'toplayout-overlay' ) {
			get_template_part( 'parts/archive_card' );
		} else {
			get_template_part( 'parts/archive_simple' );
		}
	} else {
		if ( $toplayout == "toplayout-text" ) {
			get_template_part( 'parts/archive_text' );
		} elseif ( $toplayout == "toplayout-big" ) {
			get_template_part( 'parts/archive_big' );
		} elseif ( $toplayout == 'toplayout-card' || $toplayout == 'toplayout-overlay' ) {
			get_template_part( 'parts/archive_card' );
		} else {
			get_template_part( 'parts/archive_simple' );
		}
	}
?>

<?php pagination(); ?>
<?php parts_add_bottom(); ?>
</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>