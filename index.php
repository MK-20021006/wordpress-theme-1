<?php get_header(); ?>
<div id="content">
<div id="inner-content" class="fadeIn wrap">
<main id="main">

<?php 

	$h_tag = 'h1';
	$blogparts_id = '';
	$term_id = '';


	if(is_category()) {
		$term_id = get_query_var('cat');
	} elseif(is_tag()) {
		$term_id = get_query_var('tag_id');
	}

	$meta = get_term_meta($term_id);
	$blogparts_id = isset($meta['cat_blogpart_id'][0]) ? $meta['cat_blogpart_id'][0] : null;
	$cat_blogpart_select = isset($meta['cat_blogpart_select'][0]) ? $meta['cat_blogpart_select'][0] : null;
	$cat_title_replace = isset($meta['cat_title_replace'][0]) ? $meta['cat_title_replace'][0] : null;
	$cat_title_hidden = isset($meta['cat_title_hidden'][0]) ? $meta['cat_title_hidden'][0] : null;
	$cat_base_archives = isset($meta['cat_base_archives'][0]) ? $meta['cat_base_archives'][0] : null;

	if (is_category())
	{
		stk_pr_notation();
	
		if(!$cat_title_hidden)
		{
			$cat_ttl = $cat_title_replace ? $cat_title_replace : single_cat_title('',false);
			echo '<'.$h_tag.' class="archive-title ttl-category h2">';
			echo $cat_ttl;
			echo '</'.$h_tag.'>';
		}

	} elseif (is_tag()) {
	
		stk_pr_notation();

		if(!$cat_title_hidden)
		{
			$tag_ttl = $cat_title_replace ? $cat_title_replace : single_tag_title('',false);
			echo '<'.$h_tag.' class="archive-title ttl-tags h2">';
			echo $tag_ttl;
			echo '</'.$h_tag.'>';
		}

	} elseif (is_search()) {
		echo '<'.$h_tag.' class="archive-title ttl-search h2">';
		echo '<span>キーワード</span> ';
		echo esc_attr(get_search_query());
		echo '</'.$h_tag.'>';
	} elseif (is_author()) {
		$author_id = get_the_author_meta('ID');
		$meta = get_user_meta($author_id);
		$blogparts_id = isset($meta['user_blogpart_id'][0]) ? $meta['user_blogpart_id'][0] : null;
		$user_blogpart_select = isset($meta['user_blogpart_select'][0]) ? $meta['user_blogpart_select'][0] : null;
		$user_title_replace = isset($meta['user_title_replace'][0]) ? $meta['user_title_replace'][0] : null;
		$user_avatar_display = isset($meta['user_avatar_display'][0]) ? $meta['user_avatar_display'][0] : null;

		//global $post;
		//$author_id = $post->post_author ?? '';
		$author_meta_ttl = '「'.get_the_author_meta('display_name', $author_id).'」の記事';
		$user_ttl = $user_title_replace ? $user_title_replace : $author_meta_ttl;

		echo '<'.$h_tag.' class="archive-title ttl-author h2">';
		if((is_null($user_avatar_display))){
			echo '<span class="author-icon">' . get_avatar($author_id , 150) . '</span>';
		}
		echo $user_ttl;
		echo '</'.$h_tag.'>';

	} elseif (is_day()) {
		echo '<'.$h_tag.' class="archive-title ttl-day h2">'.get_the_time('Y年n月j日').'</'.$h_tag.'>';
	} elseif (is_month()) {
		echo '<'.$h_tag.' class="archive-title ttl-month h2">' . get_the_time('Y年n月') . '</'.$h_tag.'>';
	} elseif (is_year()) {
		echo '<'.$h_tag.' class="archive-title ttl-year h2">' . get_the_time('Y年') . '</'.$h_tag.'>';
	}
	

	if($blogparts_id) 
	{
		$cat_blogpart_nextpage_display = isset($meta['cat_blogpart_nextpage_display'][0]) ? $meta['cat_blogpart_nextpage_display'][0] : null;
		$user_blogpart_nextpage_display = isset($meta['user_blogpart_nextpage_display'][0]) ? $meta['user_blogpart_nextpage_display'][0] : null;
		
		if(
			!(is_null($cat_blogpart_nextpage_display) && is_paged()) 
			|| !(is_null($user_blogpart_nextpage_display) && is_paged())
		)
		{
			echo '<div class="entry-content stk-mb_ss">';
			echo do_shortcode('[blogparts id="'.$blogparts_id.'"]');
			echo '</div>';
		}
		
	} else {
		if (category_description() && !is_paged())
		{
			echo '<div class="taxonomy-description entry-content">';
			echo category_description();
			echo '</div>';
		}
	}
?>



<?php
	if(!$cat_base_archives)
	{
		$layout = get_option('stk_archivelayout', 'toplayout-simple');
		$layoutsp = get_option('stk_archivelayout_sp', 'toplayout-card');

		if (is_mobile()) {
			if ( $layoutsp == "toplayout-text" ){
				get_template_part( 'parts/archive_text' );
			} elseif ( $layoutsp == "toplayout-big" ){
				get_template_part( 'parts/archive_big' );
			} elseif ( $layoutsp == 'toplayout-card' || $layoutsp == 'toplayout-card2' || $layoutsp == 'toplayout-overlay' ) {
				get_template_part( 'parts/archive_card' );
			} else {
				get_template_part( 'parts/archive_simple' );
			}
		} else {
			if ( $layout == "toplayout-text" ) {
				get_template_part( 'parts/archive_text' );
			} elseif ( $layout == "toplayout-big" ) {
				get_template_part( 'parts/archive_big' );
			} elseif ( $layout == 'toplayout-card' || $layout == 'toplayout-overlay' ) {
				get_template_part( 'parts/archive_card' );
			} else {
				get_template_part( 'parts/archive_simple' );
			}
		}
		pagination(); 
	}
?>

</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
