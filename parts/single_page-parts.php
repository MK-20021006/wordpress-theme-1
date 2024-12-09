<?php

if (!defined('ABSPATH')) exit;

if (!function_exists('stk_article_footer')) {
	function stk_article_footer()
	{
		if (
			get_option('article_footer_options', 'on') == 'off'
			// 「タグのみ表示する」が選択されていてタグが設定されていない場合は出力しない
			|| has_tag() !== true && get_option('article_footer_options', 'on') == 'on_tag'
		) {
			return;
		}

		if (is_singular('post')) {
			echo '<footer class="article-footer">';
			echo get_option('article_footer_options', 'on') !== 'on_tag' ? get_the_category_list() : null;
			get_option('article_footer_options', 'on') !== 'on_cat' ? the_tags('<ul class="post-categories tags"><li>', '</li><li>', '</li></ul>') : null;
			echo '</footer>';
		}
	}
}

if (!function_exists('stk_post_title')) {
	function stk_post_title()
	{
		$postType = get_post_type();
		echo '<h1 class="entry-title ' . $postType . '-title" itemprop="headline" rel="bookmark">' . get_the_title() . '</h1>';
	}
}

// 記事下の関連記事などの記事要素
if (!function_exists('skt_singlefoot_post_li')) {
	function skt_singlefoot_post_li()
	{

		return
			'<li class="related_newpost__li">
			<a href="' . get_the_permalink() . '">
				<figure class="eyecatch of-cover">'
			. skt_oc_post_thum() . stk_archivecatname() .
			'</figure>'
			. stk_archivesdate() .
			'<div class="ttl' . stk_post_newmark() . '">' . get_the_title() . '</div>
			</a>
		</li>';
	}
}

if (!function_exists('stk_next_prev_post')) {
	function stk_next_prev_post()
	{
		if (
			get_option('np_hide_options', 'on') == 'off'
			|| !is_single()
		) {
			return;
		}

		$excluded_terms = get_option('np_excluded_terms', 'all') === 'same_cat' ? true : false;

		$nextpost = get_adjacent_post($excluded_terms, '', false);
		$prevpost = get_adjacent_post($excluded_terms, '', true);

		$np_reverse = get_option('np_display_reverse','prev_next') == 'next_prev' ? ' class="np-reverse"': null;

		$output = '<div id="np-post"' . $np_reverse . '>';
		if ($nextpost) {
			$output .= '<div class="prev np-post-list">';
			$output .= '<a href="' . get_permalink($nextpost->ID) . '" data-text="PREV PAGE">';
			$output .= !get_option('np_display_thumbnail') === true ? '<figure class="eyecatch">' . get_the_post_thumbnail($nextpost->ID, 'thumbnail') . '</figure>': false;
			$output .= '<span class="ttl">' . esc_attr($nextpost->post_title) . '</span>';
			$output .= '</a>';
			$output .= '</div>';
		}
		if ($prevpost) {
			$output .= '<div class="next np-post-list">';
			$output .= '<a href="' . get_permalink($prevpost->ID) . '" data-text="NEXT PAGE">';
			$output .= '<span class="ttl">' . esc_attr($prevpost->post_title) . '</span>';
			$output .= !get_option('np_display_thumbnail') === true ? '<figure class="eyecatch">' . get_the_post_thumbnail($prevpost->ID, 'thumbnail') . '</figure>': false;
			$output .= '</a>';
			$output .= '</div>';
		}
		$output .= '</div>';

		echo $output;
	}
}

// 関連記事用
if (!function_exists('stk_recommend')) {
	function stk_recommend()
	{
		if (
			get_option('recommend_hide_options', 'on') == 'off'
			|| !is_single()
		) {
			return;
		}

		if (function_exists('yarpp_related')) {

			yarpp_related(
				array(
					'template' => 'yarpp-template-relative.php'
				)
			);
		} else { // defaultの関連記事

			if (get_option('ga_recommend_options') && !stk_is_amp()) {
				echo '<div id="related-box" class="original-related ga_recommend">';
				//関連コンテンツユニット（GoogleAdSense）の表示
				echo get_option('ga_recommend_options');
				echo '</div>';
			} elseif (get_option('stk_amp_ga_recommend_options') && stk_is_amp()) {
				echo '<div id="related-box" class="original-related ga_recommend_amp">';
				//関連コンテンツユニット（AMP / GoogleAdSense）の表示
				echo get_option('stk_amp_ga_recommend_options');
				echo '</div>';
			} else {

				//カテゴリ情報から関連記事を8個ランダムに呼び出す
				$categories = get_the_category(get_the_ID());
				$category_ID = array();
				foreach ($categories as $category) :
					array_push($category_ID, $category->cat_ID);
				endforeach;
				$args = array(
					'post__not_in' => array(get_the_ID()),
					'posts_per_page' => 8,
					'category__in' => $category_ID,
					'orderby' => 'rand',
				);
				$query = new WP_Query($args);

				echo '<div id="related-box" class="original-related">';
				echo '<div class="related-h h_ttl h2"><span class="gf">RECOMMEND</span></div>';
				if ($query->have_posts()) {

					echo '<ul>';

					while ($query->have_posts()) : $query->the_post();
						echo skt_singlefoot_post_li();
					endwhile;

					echo '</ul>';
				} else {
					echo '<p>関連記事は見つかりませんでした。</p>';
				}
				echo '</div>';

				wp_reset_postdata();
			}
		}
	}
}

if (!function_exists('oc_yarpp_template')) {
	function oc_yarpp_template()
	{
		$output = '';
		$output .= '<div id="related-box" class="tmp-yarpp">';
		$output .= '<div class="related-h h_ttl h2"><span class="gf">RECOMMEND</span></div>';
		if(have_posts()){
			$output .= '<ul>';
			while(have_posts()) : the_post();
				$output .= skt_singlefoot_post_li();
			endwhile;
			$output .= '</ul>';
		} else {
			$output .= '<p>関連記事は見つかりませんでした。</p>';
		}
		$output .= '</div>';
		echo $output;
	}
}

// 補足テキスト
function stk_singlefoot_css() {
	if ( !is_single() ) {
        return;
    }

	$tag = get_option('followbox_jptext','この記事が気に入ったらフォローしよう！') ? '.fb-likebtn .like_text::after{content:"'.get_option('followbox_jptext','この記事が気に入ったらフォローしよう！').'";}': null;
	$tag .= get_option('related_jptext','こちらの記事も人気です') ? '#related-box .h_ttl::after{content:"'.get_option('related_jptext','こちらの記事も人気です').'";}': null;
	$tag .= get_option('authorbox_jptext','この記事を書いた人') ? '.stk_authorbox > .h_ttl:not(.subtext__none)::after{content:"'.get_option('authorbox_jptext','この記事を書いた人').'";}': null;
	$tag .= get_option('authorpost_jptext','このライターの最新記事') ? '#author-newpost .h_ttl::after{content:"'.get_option('authorpost_jptext','このライターの最新記事').'";}': null;
	
	wp_add_inline_style('stk_style', minify_css($tag));
}
add_action( 'wp_enqueue_scripts', 'stk_singlefoot_css');