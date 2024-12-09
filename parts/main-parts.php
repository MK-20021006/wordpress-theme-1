<?php

if (!defined('ABSPATH')) exit;

// CategoryLabel（post）
if (!function_exists('stk_postcatname')) {
	function stk_postcatname()
	{
		if ( get_option('stk_archive_catname', 'on') !== 'both_off') {
			if (is_singular('post')) {

				$primaryTerm = get_post_meta(get_the_ID(), '_yoast_wpseo_primary_category', true);
				$activewpseo = is_plugin_active('wordpress-seo/wp-seo.php') || is_plugin_active('wordpress-seo-premium/wp-seo-premium.php');

				if (!$primaryTerm || !$activewpseo) {
					$primaryTerm = get_the_category();
					$primaryTerm = $primaryTerm[0]->term_id;
				}
				$catid = $primaryTerm;
				$catname = get_cat_name($catid);
				$catlink = get_category_link($catid);

				$position = get_option('side_options_sidebarlayout') == 'sidebarleft' || get_option('inner_content_layout') == 'content_flat' || is_page_template('single-viral.php') || get_option('stk_catname_position') ? ' noposition': null;

				return '<span class="cat-name'.$position.' cat-id-' . $catid . '"><a href="' . esc_url($catlink) . '">' . $catname . '</a></span>';
			}
		}
	}
}

// CategoryLabel（archive）
if (!function_exists('stk_archivecatname')) {
	function stk_archivecatname()
	{
		if ( get_option('stk_archive_catname', 'on') !== 'on') {
			return;
		}
		if (get_post_type() == 'post') {

			$primaryTerm = get_post_meta(get_the_ID(), '_yoast_wpseo_primary_category', true);
			$activewpseo = is_plugin_active('wordpress-seo/wp-seo.php') || is_plugin_active('wordpress-seo-premium/wp-seo-premium.php');

			if (!$primaryTerm || !$activewpseo) {
				$primaryTerm = get_the_category();
				$primaryTerm = $primaryTerm[0]->term_id;
			}
			$catid = $primaryTerm;
			$catname = get_cat_name($catid);

			return '<span class="osusume-label cat-name cat-id-' . $catid . '">' . $catname . '</span>';
		} else {
			return '<span class="osusume-label cat-name cat-id-page"></span>';
		}
	}
}

// new mark
function stk_post_newmark()
{
	if (get_option('post_new_mark', '3') == '0') {
		$days = null;
	} elseif (get_option('post_new_mark')) {
		$days = esc_attr(get_option('post_new_mark', '3'));
	} else {
		$days = '3';
	}
	$daysInt = ((int) $days - 1) * 86400;
	$today = time();
	$entry = get_the_time('U');
	$dayago = $today - $entry;
	if (($dayago < $daysInt) && $days) {
		return ' newmark';
	}
}

// post date
if (!function_exists('stk_postdate')) {
	function stk_postdate()
	{
		$display_post_date = get_option('post_options_date', 'undo_on');

		if ($display_post_date == "date_undo_off") return;
		$output = "";
		// 投稿日
		if (
			$display_post_date == "date_undo_on"
			|| $display_post_date == "date_on"
			|| (get_the_date('Ymd') >= get_the_modified_date('Ymd') && $display_post_date == "undo_on")
		) {
			if (get_the_date('Ymd') >= get_the_modified_date('Ymd')) {
				$datetime = ' datetime="' . get_the_date('Y-m-d') . '"';
			} else {
				$datetime = null;
			}
			$output .= '<time class="time__date gf entry-date updated"' . $datetime . '>';
			$output .= !get_option('stk_date_format') ? get_the_date('Y.m.d') : get_the_date(get_option('date_format'));
			$output .= '</time>';
		}
		// 更新日
		if (
			get_the_date('Ymd') < get_the_modified_date('Ymd')
			&& ($display_post_date == "undo_on" || $display_post_date == "date_undo_on")
		) {

			$datetime = ' datetime="' . get_the_modified_date('Y-m-d') . '"';

			$output .= '<time class="time__date gf entry-date undo updated"' . $datetime . '>';
			$output .= !get_option('stk_date_format') ? get_the_modified_date('Y.m.d') : get_the_modified_date(get_option('date_format'));
			$output .= '</time>';
		}
		return $output;
	}
}

// archives post date
if (!function_exists('stk_archivesdate')) {
	function stk_archivesdate()
	{
		$display_post_date = get_option('post_options_date', 'undo_on');

		if ($display_post_date == "date_undo_off") return;
		$output = "";
		// date on
		if (
			$display_post_date == "date_on"
			|| ($display_post_date == "undo_on" && get_the_date('Ymd') >= get_the_modified_date('Ymd'))
			|| ($display_post_date == "date_undo_on" && get_the_date('Ymd') >= get_the_modified_date('Ymd'))
		) {
			$output .= '<time class="time__date gf">';
			$output .= !get_option('stk_date_format') ? get_the_date('Y.m.d') : get_the_date(get_option('date_format'));
			$output .= '</time>';
		}
		// undo on
		if (
			($display_post_date == "date_undo_on" || $display_post_date == "undo_on")
			&& get_the_date('Ymd') < get_the_modified_date('Ymd')
		) {
			$output .= '<time class="time__date gf undo">';
			$output .= !get_option('stk_date_format') ? get_the_modified_date('Y.m.d') : get_the_modified_date(get_option('date_format'));
			$output .= '</time>';
		}
		return $output;
	}
}

if (!function_exists('stk_post_meta')) {
	function stk_post_meta()
	{
		echo '<p class="byline entry-meta vcard">';
		echo stk_postcatname();
		echo stk_postdate();
		echo stk_pr_notation();
		echo stk_the_author_singletop();
		echo '</p>';
	}
}
if (!function_exists('stk_archives_post_meta')) {
	function stk_archives_post_meta($layout = "")
	{
		$output = '<div class="byline entry-meta vcard">';
		if ($layout == 'big') {
			$output .= stk_archivecatname();
			$output .= stk_postdate();
		} elseif ($layout == 'text') {
			$output .= stk_archivecatname();
			$output .= stk_archivesdate();
		} else {
			$output .= stk_archivesdate();
		}
		$output .= stk_archives_author();
		$output .= '</div>';
		return $output;
	}
}

// no image
if (!function_exists('oc_noimg')) {
	function oc_noimg()
	{
		$image_id = attachment_url_to_postid(get_theme_mod('stk_archives_noimg'));

		if ($image_id !== 0) {
			$output = wp_get_attachment_image(
				$image_id,
				'full',
				false,
				array(
					'class' => 'wp-post-image wp-post-no_image archives-eyecatch-image',
				)
			);
		} else {
			$output = '<img src="' . get_theme_file_uri('/images/noimg.png') . '" width="485" height="300" class="wp-post-image wp-post-no_image archives-eyecatch-image" alt="NO IMAGE">';
		}

		return $output;
	}
}

// サムネイル用の関数
if (!function_exists('skt_oc_post_thum')) {
	function skt_oc_post_thum($stk_eyecatch_size = 'oc-post-thum')
	{

		$post_id = get_the_ID();
		$image_id = get_post_thumbnail_id($post_id);

		if ($image_id) {

			$thumb = get_the_post_thumbnail(
				$post_id,
				$stk_eyecatch_size,
				array(
					'class' => 'archives-eyecatch-image attachment-' . $stk_eyecatch_size,
				)
			);
		} else {
			$thumb = oc_noimg();
		}
		$thumb = str_replace('100vw', '45vw', $thumb);
		return $thumb;
	}
}
// 記事内のサムネイル画像
if (!function_exists('stk_post_main_thum')) {
	function stk_post_main_thum($post_id, $container_class = null)
	{
		if (!has_post_thumbnail() || get_option('post_options_eyecatch_display', 'on') == 'off') {
			return;
		}

		$figureclass = $container_class ? 'eyecatch stk_post_main_thum ' . $container_class : 'eyecatch stk_post_main_thum';

		echo '<figure class="' . $figureclass . '">';
		the_post_thumbnail(
			$post_id,
			array(
				'class' => 'stk_post_main_thum__img',
				'loading' => false,
			)
		);
		if ($pt_caption = get_post(get_post_thumbnail_id())->post_excerpt) { //caption
			echo '<figcaption class="eyecatch-caption-text">' . $pt_caption . '</figcaption>';
		}
		echo '</figure>';
	}
}

// author
if (!function_exists('stk_the_author')) {
	function stk_the_author()
	{
		return '<span class="writer name author">' . get_avatar(get_the_author_meta('ID'), 30) . '<span class="fn">' . get_the_author() . '</span></span>';
	}
}

if (!function_exists('stk_the_author_singletop')) {
	function stk_the_author_singletop()
	{
		if (get_option('post_options_authordisplay', 'author_on') !== 'author_off') {
			if (!get_option('post_options_authordisplay_top', true)) {
				return stk_the_author();
			}
		}
	}
}


// pagination
if (!function_exists('pagination')) {
	function pagination($pages = '', $range = 2)
	{
		global $wp_query, $paged;

		$big = 999999999;

		echo '<nav class="pagination">';
		echo paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'current' => max(1, get_query_var('paged')),
			'prev_text'    => __('＜'),
			'next_text'    => __('＞'),
			'type'    => 'plain',
			'total' => $wp_query->max_num_pages
		));
		echo "</nav>\n";
	}
}

// ページ分割用ページネーション
function stk_wp_link_pages()
{
	wp_link_pages(array(
		'before'      => '<nav class="page-links type_number">',
		'after'       => '</nav>',
		'separator'        => '',
		'next_or_number'   => 'number',
	));

	wp_link_pages(array(
		'before'      => '<nav class="page-links">',
		'after'       => '</nav>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'next_or_number'   => 'next',
		'nextpagelink'     => __('次のページへ ≫'),
		'previouspagelink' => __('≪ 前のページへ'),
	));
}

// search form
if (!function_exists('stk_search_form')) {
	function stk_search_form($form)
	{
		//$aria_label = !empty($args['label']) ? 'aria-label="' . esc_attr($args['label']) . '"' : '';
		$svgicon = '
		<svg version="1.1" class="stk_svgicon svgicon_searchform" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
			y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
			<path fill="#333" d="M44.35,48.52l-4.95-4.95c-1.17-1.17-1.17-3.07,0-4.24l0,0c1.17-1.17,3.07-1.17,4.24,0l4.95,4.95c1.17,1.17,1.17,3.07,0,4.24
				l0,0C47.42,49.7,45.53,49.7,44.35,48.52z"/>
			<path fill="#333" d="M22.81,7c8.35,0,15.14,6.79,15.14,15.14s-6.79,15.14-15.14,15.14S7.67,30.49,7.67,22.14S14.46,7,22.81,7 M22.81,1
			C11.13,1,1.67,10.47,1.67,22.14s9.47,21.14,21.14,21.14s21.14-9.47,21.14-21.14S34.49,1,22.81,1L22.81,1z"/>
		</svg>
		';
		$form = '<form role="search" method="get" class="searchform" action="' . esc_url(home_url('/')) . '">
				<label class="searchform_label">
					<span class="screen-reader-text">' . _x('Search for:', 'label') . '</span>
					<input type="search" class="searchform_input" placeholder="' . esc_attr_x('Search &hellip;', 'placeholder') . '" value="' . get_search_query() . '" name="s" />
				</label>
				<button type="submit" class="searchsubmit">' . $svgicon . '</button>
			</form>';
		return $form;
	}
	add_filter('get_search_form', 'stk_search_form');
}

function stk_archives_entrytitle($type = '')
{
	$classname = 'entry-title';
	if (stk_post_newmark()) {
		$classname .= stk_post_newmark();
	}
	$h_tag = get_option('stk_archives_posthtag', 'h1');

	$output = '<' . $h_tag . ' class="' . $classname . '">';
	if ($type) {
		$output .= '<a class="entry-title__link" href="' . get_permalink() . '" rel="bookmark" title="' . the_title_attribute('echo=0') . '">';
	}
	$output .= get_the_title();
	if ($type) {
		$output .= '</a>';
	}
	$output .= '</' . $h_tag . '>';

	return $output;
}

// archives description
if (!function_exists('stk_archives_description')) {
	function stk_archives_description()
	{

		if (get_option('stk_archive_description', 'on') == 'off') {
			return;
		}
		if (is_home() && get_option('stk_archive_description', 'off') == 'on_archive') {
			return;
		} elseif (is_archive() && get_option('stk_archive_description', 'off') == 'on_home') {
			return;			
		}

		$excerpt_lines = get_option('stk_excerpt_lines', 'default') !== 'default' ?
			' class="'. get_option('stk_excerpt_lines', 'default') .'"' : null;
		
		$excerpt_content = get_the_excerpt();

		/*
		// 文字数を変更したい場合はここのコメントを外す
		if( has_excerpt() ) {
			$excerpt_content = get_the_excerpt();
		} else {
			$remove_array = ["\r\n", "\r", "\n", " ", "　"];
			$excerpt_content = wp_trim_words(strip_shortcodes(get_the_content()), 66, '...' );
			$excerpt_content = str_replace($remove_array, '', $excerpt_content);
		}
*/

		return '<div class="description"><p' . $excerpt_lines . '>' . $excerpt_content . '</p></div>';
	}
}

// archives author
if (!function_exists('stk_archives_author')) {
	function stk_archives_author()
	{
		if (get_option('post_options_authordisplay', 'author_on') == 'author_on_archives') {
			return stk_the_author();
		}
	}
}

// archives no post
if (!function_exists('stk_archives_notfound')) {
	function stk_archives_notfound()
	{

		$output = '<article id="post-not-found" class="cf">
					<header class="article-header">
						<h1>記事が見つかりませんでした。</h1>
					</header>
					<section class="entry-content">
						<p>お探しのキーワードで記事が見つかりませんでした。別のキーワードで再度お探しいただくか、カテゴリ一覧からお探し下さい。</p>';

		$output .= '<div class="search">
						<h2>キーワード検索</h2>';

		ob_start();
		get_search_form();
		$output .= ob_get_contents();
		ob_end_clean();

		$output .= '</div>
					<div class="cat-list cf">
						<h2>カテゴリーから探す</h2>
					<ul>';

		ob_start();
		$args = array('title_li' => '',);
		wp_list_categories($args);
		$output .= ob_get_contents();
		ob_end_clean();

		$output .= '</ul>
					</div>
					</section>
					</article>';

		return $output;
	}
}

// 広告テキストの表記
if (!function_exists('stk_pr_notation')) {
	function stk_pr_notation()
	{
		if ((is_single())
			&& !has_tag('adpr')
			&& get_option('ad_options_prsetting','write_off') !== 'write_post'
			&& get_option('ad_options_prsetting','write_off') !== 'write_page'
		) {
			return;
		}
		if ((is_page())
			&& !has_tag('adpr')
			&& get_option('ad_options_prsetting','write_off') !== 'write_page'
		) {
			return;
		}

		$term_id = '';

		if(is_category()) {
			$term_id = get_query_var('cat');
		} elseif(is_tag()) {
			$term_id = get_query_var('tag_id');
		}
		$meta = get_term_meta($term_id);

		$catpage_prsetting = isset($meta['catpage_prsetting'][0]) ? $meta['catpage_prsetting'][0] : null;
	
		if ((is_category())
			&& (!$catpage_prsetting)
			&& get_option('archivepage_prsetting','write_off') !== 'write_category'
			&& get_option('archivepage_prsetting','write_off') !== 'write_tag'
		) {
			return;
		}
		if ((is_tag())
			&& (!$catpage_prsetting)
			&& get_option('archivepage_prsetting','write_off') !== 'write_tag'
		) {
			return;
		}

		$prtext = get_option('ad_options_prtext') ? get_option('ad_options_prtext') : '広告';
		echo '<span data-nosnippet class="pr-notation is-style-simple">' . $prtext . '</span>';
		//var_dump($prtext);
	}
}


// サイドバーの呼び出し
function stk_sidebar()
{
	if (
		(
			(is_home() || is_archive() || is_search()
			)
			&& !is_mobile()
			&& get_option('stk_archivelayout_onecolumn', 'sidebar_on') == 'sidebar_none'
		)
		||
		(
			(is_page_template('single-viral.php') || is_page_template('single-full.php') || is_page_template('page-full.php')
			)
			&& !is_mobile()
		)
		||
		(
			(is_home() || is_archive() || is_search()
			)
			&& is_mobile()
			&& get_option('stk_archivelayout_onecolumn', 'sidebar_on') == 'sidebar_none'
			&& get_option('stk_mobilepage_sidebar_none')
		)
		||
		(
			(is_page_template('single-viral.php') || is_page_template('single-full.php') || is_page_template('page-full.php')
			)
			&& is_mobile()
			&& get_option('stk_mobilepage_sidebar_none')
		)
	) {
		return;
	}


	if (is_active_sidebar('sidebar1') || is_active_sidebar('side-fixed') || is_active_sidebar('sp-contentfoot')) {
		echo '<div id="sidebar1" class="sidebar" role="complementary">';

		if (is_active_sidebar('sp-contentfoot') && is_mobile()) {
			dynamic_sidebar('sp-contentfoot');
		}

		if (is_active_sidebar('sidebar1')) {
			if (!is_mobile() || (is_mobile() && !is_active_sidebar('sp-contentfoot'))) {
				dynamic_sidebar('sidebar1');
				echo stk_widget_guide_sidebar();
			}
		}

		if (is_active_sidebar('side-fixed') && !is_mobile()) {
			echo '<div id="scrollfix" class="scrollfix">';
			dynamic_sidebar('side-fixed');
			echo '</div>';
		}

		echo '</div>';
	}
}
add_action('stk_hook_sidebar', 'stk_sidebar');


// 固定フッターウィジェット
if (!function_exists('stk_before_footerwidget')) {
	function stk_before_footerwidget()
	{
		if (is_page_template('page-lp.php')) {
			return;
		}
		
		$fixed_sp = get_option('stk_widget_options_footerfixed','footerfixed') !== 'footernormal' && get_option('stk_widget_options_footerfixed','footerfixed') !== 'footerfixed_pc';

		$fixed_pc = get_option('stk_widget_options_footerfixed','footerfixed') !== 'footernormal' && get_option('stk_widget_options_footerfixed','footerfixed') !== 'footerfixed_sp';
		
		$btn_close = '<input type="checkbox" class="bf-position-static checkbox" id="before-footer__close" name="close" /><label for="before-footer__close" class="btn-bf-close"></label>';

		if (is_active_sidebar('before-footer-sp') && is_mobile()) {
			echo $fixed_sp ? $btn_close : null;
			echo '<div id="before-footer"><div class="inner wrap">';
			dynamic_sidebar('before-footer-sp');
			echo '</div></div>';
		}
		if (is_active_sidebar('before-footer-pc') && !is_mobile()) {
			echo $fixed_pc ? $btn_close : null;
			echo '<div id="before-footer"><div class="inner wrap">';
			dynamic_sidebar('before-footer-pc');
			echo '</div></div>';
		}
	}
	add_action( 'stk_hook_footer_before', 'stk_before_footerwidget');
}


// フッターウィジェットの呼び出し
if (!function_exists('stk_footerwidget')) {
	function stk_footerwidget()
	{
		if (is_page_template('page-lp.php')) {
			return;
		}

		if (is_active_sidebar('footer-sp') && is_mobile()) {
			echo '<div id="footer-top">';
			dynamic_sidebar('footer-sp');
			echo '</div>';
		}
		if (
			(is_active_sidebar('footer1') && !is_mobile()) //スマホ以外
			|| (!is_active_sidebar('footer-sp') && is_active_sidebar('footer1') && is_mobile()) //スマホでfooter-spが設定されていないとき
		) {
			$layout_class = get_option('stk_widget_options_footertop', '--style-col-three');

			echo '<div id="footer-top" class="' . $layout_class . '">';
			dynamic_sidebar('footer1');
			echo '</div>';
		}
	}
}

// フッターコピーライト
if (!function_exists('stk_footercopyright')) {
	function stk_footercopyright()
	{

		$sitename = get_bloginfo('name');
		$siteurl = esc_url(home_url('/'));
		$date = !get_option('stk_currentyear_none') ? date('Y') : null;
		$copyright = get_option('stk_copyright_text') ? get_option('stk_copyright_text') : ' <a href="' . $siteurl . '" rel="nofollow">' . $sitename . '</a> All Rights Reserved.';

		echo '<p class="source-org copyright">&copy; ' . $date . ' ' . $copyright . '</p>';
	}
}
// フッターのリンクメニュー
if (!function_exists('stk_footerlinks')) {
	function stk_footerlinks()
	{
		if (has_nav_menu('footer-links')) {
			wp_nav_menu(array(
				'container' => 'nav',
				'container_class' => 'footer-links',
				'menu' => __('Footer Links'),
				'theme_location' => 'footer-links',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'depth' => 0,
				'fallback_cb' => ''
			));
		}
	}
}


// SNSリンク共通
function stk_sns_btn_li($link, $key, $label, $svg, $class = null)
{
	// var_dump($link);
	if ($link === '' || $link === false) {
		return;
	}

	$addclass = $class ? ' '.$class : null;

	return '<li class="sns_li__' . $key . '"><a href="' . esc_url($link) . '" aria-label="' . $label . '" title="' . $label . '" target="_blank" rel="noopener" class="stk_sns_links__link'.$addclass.'">' . $svg . '</a></li>';
}

// SVGアイコンをsymbolで定義
if (!function_exists('stk_svg_symbol')) {
	function stk_svg_symbol()
	{
		$twitter_svg = get_option( 'sns_button_hide_twitter' ) == 'logo_bird' ?
		'<path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>':
		'<path d="M299.8,219.7L471,20.7h-40.6L281.7,193.4L163,20.7H26l179.6,261.4L26,490.7h40.6l157-182.5L349,490.7h137L299.8,219.7 L299.8,219.7z M244.2,284.3l-18.2-26L81.2,51.2h62.3l116.9,167.1l18.2,26l151.9,217.2h-62.3L244.2,284.3L244.2,284.3z"/>';

		echo '<svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs>
		<symbol viewBox="0 0 512 512" id="stk-facebook-svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></symbol>
		<symbol viewBox="0 0 512 512" id="stk-twitter-svg">'.$twitter_svg.'</symbol>
		<symbol viewBox="0 0 576 512" id="stk-youtube-svg"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></symbol>
		<symbol viewBox="0 0 448 512" id="stk-instagram-svg"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></symbol>
		<symbol viewBox="0 0 32 32" id="stk-line-svg"><path d="M25.82 13.151c0.465 0 0.84 0.38 0.84 0.841 0 0.46-0.375 0.84-0.84 0.84h-2.34v1.5h2.34c0.465 0 0.84 0.377 0.84 0.84 0 0.459-0.375 0.839-0.84 0.839h-3.181c-0.46 0-0.836-0.38-0.836-0.839v-6.361c0-0.46 0.376-0.84 0.84-0.84h3.181c0.461 0 0.836 0.38 0.836 0.84 0 0.465-0.375 0.84-0.84 0.84h-2.34v1.5zM20.68 17.172c0 0.36-0.232 0.68-0.576 0.795-0.085 0.028-0.177 0.041-0.265 0.041-0.281 0-0.521-0.12-0.68-0.333l-3.257-4.423v3.92c0 0.459-0.372 0.839-0.841 0.839-0.461 0-0.835-0.38-0.835-0.839v-6.361c0-0.36 0.231-0.68 0.573-0.793 0.080-0.031 0.181-0.044 0.259-0.044 0.26 0 0.5 0.139 0.66 0.339l3.283 4.44v-3.941c0-0.46 0.376-0.84 0.84-0.84 0.46 0 0.84 0.38 0.84 0.84zM13.025 17.172c0 0.459-0.376 0.839-0.841 0.839-0.46 0-0.836-0.38-0.836-0.839v-6.361c0-0.46 0.376-0.84 0.84-0.84 0.461 0 0.837 0.38 0.837 0.84zM9.737 18.011h-3.181c-0.46 0-0.84-0.38-0.84-0.839v-6.361c0-0.46 0.38-0.84 0.84-0.84 0.464 0 0.84 0.38 0.84 0.84v5.521h2.341c0.464 0 0.839 0.377 0.839 0.84 0 0.459-0.376 0.839-0.839 0.839zM32 13.752c0-7.161-7.18-12.989-16-12.989s-16 5.828-16 12.989c0 6.415 5.693 11.789 13.38 12.811 0.521 0.109 1.231 0.344 1.411 0.787 0.16 0.401 0.105 1.021 0.051 1.44l-0.219 1.36c-0.060 0.401-0.32 1.581 1.399 0.86 1.721-0.719 9.221-5.437 12.581-9.3 2.299-2.519 3.397-5.099 3.397-7.957z"/></symbol>
		<symbol viewBox="0 0 50 50" id="stk-feedly-svg"><path d="M20.42,44.65h9.94c1.59,0,3.12-.63,4.25-1.76l12-12c2.34-2.34,2.34-6.14,0-8.48L29.64,5.43c-2.34-2.34-6.14-2.34-8.48,0L4.18,22.4c-2.34,2.34-2.34,6.14,0,8.48l12,12c1.12,1.12,2.65,1.76,4.24,1.76Zm-2.56-11.39l-.95-.95c-.39-.39-.39-1.02,0-1.41l7.07-7.07c.39-.39,1.02-.39,1.41,0l2.12,2.12c.39,.39,.39,1.02,0,1.41l-5.9,5.9c-.19,.19-.44,.29-.71,.29h-2.34c-.27,0-.52-.11-.71-.29Zm10.36,4.71l-.95,.95c-.19,.19-.44,.29-.71,.29h-2.34c-.27,0-.52-.11-.71-.29l-.95-.95c-.39-.39-.39-1.02,0-1.41l2.12-2.12c.39-.39,1.02-.39,1.41,0l2.12,2.12c.39,.39,.39,1.02,0,1.41ZM11.25,25.23l12.73-12.73c.39-.39,1.02-.39,1.41,0l2.12,2.12c.39,.39,.39,1.02,0,1.41l-11.55,11.55c-.19,.19-.45,.29-.71,.29h-2.34c-.27,0-.52-.11-.71-.29l-.95-.95c-.39-.39-.39-1.02,0-1.41Z"/></symbol>
		<symbol viewBox="0 0 448 512" id="stk-tiktok-svg"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></symbol>
		<symbol viewBox="0 0 50 50" id="stk-hatebu-svg"><path d="M5.53,7.51c5.39,0,10.71,0,16.02,0,.73,0,1.47,.06,2.19,.19,3.52,.6,6.45,3.36,6.99,6.54,.63,3.68-1.34,7.09-5.02,8.67-.32,.14-.63,.27-1.03,.45,3.69,.93,6.25,3.02,7.37,6.59,1.79,5.7-2.32,11.79-8.4,12.05-6.01,.26-12.03,.06-18.13,.06V7.51Zm8.16,28.37c.16,.03,.26,.07,.35,.07,1.82,0,3.64,.03,5.46,0,2.09-.03,3.73-1.58,3.89-3.62,.14-1.87-1.28-3.79-3.27-3.97-2.11-.19-4.25-.04-6.42-.04v7.56Zm-.02-13.77c1.46,0,2.83,0,4.2,0,.29,0,.58,0,.86-.03,1.67-.21,3.01-1.53,3.17-3.12,.16-1.62-.75-3.32-2.36-3.61-1.91-.34-3.89-.25-5.87-.35v7.1Z"/><path d="M43.93,30.53h-7.69V7.59h7.69V30.53Z"/><path d="M44,38.27c0,2.13-1.79,3.86-3.95,3.83-2.12-.03-3.86-1.77-3.85-3.85,0-2.13,1.8-3.86,3.96-3.83,2.12,.03,3.85,1.75,3.84,3.85Z"/></symbol>
		<symbol id="stk-pokect-svg" viewBox="0 0 50 50"><path d="M8.04,6.5c-2.24,.15-3.6,1.42-3.6,3.7v13.62c0,11.06,11,19.75,20.52,19.68,10.7-.08,20.58-9.11,20.58-19.68V10.2c0-2.28-1.44-3.57-3.7-3.7H8.04Zm8.67,11.08l8.25,7.84,8.26-7.84c3.7-1.55,5.31,2.67,3.79,3.9l-10.76,10.27c-.35,.33-2.23,.33-2.58,0l-10.76-10.27c-1.45-1.36,.44-5.65,3.79-3.9h0Z"/></symbol>
		<symbol id="stk-pinterest-svg" viewBox="0 0 50 50"><path d="M3.63,25c.11-6.06,2.25-11.13,6.43-15.19,4.18-4.06,9.15-6.12,14.94-6.18,6.23,.11,11.34,2.24,15.32,6.38,3.98,4.15,6,9.14,6.05,14.98-.11,6.01-2.25,11.06-6.43,15.15-4.18,4.09-9.15,6.16-14.94,6.21-2,0-4-.31-6.01-.92,.39-.61,.78-1.31,1.17-2.09,.44-.94,1-2.73,1.67-5.34,.17-.72,.42-1.7,.75-2.92,.39,.67,1.06,1.28,2,1.84,2.5,1.17,5.15,1.06,7.93-.33,2.89-1.67,4.9-4.26,6.01-7.76,1-3.67,.88-7.08-.38-10.22-1.25-3.15-3.49-5.41-6.72-6.8-4.06-1.17-8.01-1.04-11.85,.38s-6.51,3.85-8.01,7.3c-.39,1.28-.62,2.55-.71,3.8s-.04,2.47,.12,3.67,.59,2.27,1.25,3.21,1.56,1.67,2.67,2.17c.28,.11,.5,.11,.67,0,.22-.11,.44-.56,.67-1.33s.31-1.31,.25-1.59c-.06-.11-.17-.31-.33-.59-1.17-1.89-1.56-3.88-1.17-5.97,.39-2.09,1.25-3.85,2.59-5.3,2.06-1.84,4.47-2.84,7.22-3,2.75-.17,5.11,.59,7.05,2.25,1.06,1.22,1.74,2.7,2.04,4.42s.31,3.38,0,4.97c-.31,1.59-.85,3.07-1.63,4.47-1.39,2.17-3.03,3.28-4.92,3.34-1.11-.06-2.02-.49-2.71-1.29s-.91-1.74-.62-2.79c.11-.61,.44-1.81,1-3.59s.86-3.12,.92-4c-.17-2.12-1.14-3.2-2.92-3.26-1.39,.17-2.42,.79-3.09,1.88s-1.03,2.32-1.09,3.71c.17,1.62,.42,2.73,.75,3.34-.61,2.5-1.09,4.51-1.42,6.01-.11,.39-.42,1.59-.92,3.59s-.78,3.53-.83,4.59v2.34c-3.95-1.84-7.07-4.49-9.35-7.97-2.28-3.48-3.42-7.33-3.42-11.56Z"/></symbol>
		<symbol id="stk-user_url-svg" viewBox="0 0 50 50"><path d="M33.62,25c0,1.99-.11,3.92-.3,5.75H16.67c-.19-1.83-.38-3.76-.38-5.75s.19-3.92,.38-5.75h16.66c.19,1.83,.3,3.76,.3,5.75Zm13.65-5.75c.48,1.84,.73,3.76,.73,5.75s-.25,3.91-.73,5.75h-11.06c.19-1.85,.29-3.85,.29-5.75s-.1-3.9-.29-5.75h11.06Zm-.94-2.88h-10.48c-.9-5.74-2.68-10.55-4.97-13.62,7.04,1.86,12.76,6.96,15.45,13.62Zm-13.4,0h-15.87c.55-3.27,1.39-6.17,2.43-8.5,.94-2.12,1.99-3.66,3.01-4.63,1.01-.96,1.84-1.24,2.5-1.24s1.49,.29,2.5,1.24c1.02,.97,2.07,2.51,3.01,4.63,1.03,2.34,1.88,5.23,2.43,8.5h0Zm-29.26,0C6.37,9.72,12.08,4.61,19.12,2.76c-2.29,3.07-4.07,7.88-4.97,13.62H3.67Zm10.12,2.88c-.19,1.85-.37,3.77-.37,5.75s.18,3.9,.37,5.75H2.72c-.47-1.84-.72-3.76-.72-5.75s.25-3.91,.72-5.75H13.79Zm5.71,22.87c-1.03-2.34-1.88-5.23-2.43-8.5h15.87c-.55,3.27-1.39,6.16-2.43,8.5-.94,2.13-1.99,3.67-3.01,4.64-1.01,.95-1.84,1.24-2.58,1.24-.58,0-1.41-.29-2.42-1.24-1.02-.97-2.07-2.51-3.01-4.64h0Zm-.37,5.12c-7.04-1.86-12.76-6.96-15.45-13.62H14.16c.9,5.74,2.68,10.55,4.97,13.62h0Zm11.75,0c2.29-3.07,4.07-7.88,4.97-13.62h10.48c-2.7,6.66-8.41,11.76-15.45,13.62h0Z"/></symbol>
		<symbol id="stk-envelope-svg" viewBox="0 0 300 300"><path d="M300.03,81.5c0-30.25-24.75-55-55-55h-190c-30.25,0-55,24.75-55,55v140c0,30.25,24.75,55,55,55h190c30.25,0,55-24.75,55-55 V81.5z M37.4,63.87c4.75-4.75,11.01-7.37,17.63-7.37h190c6.62,0,12.88,2.62,17.63,7.37c4.75,4.75,7.37,11.01,7.37,17.63v5.56 c-0.32,0.2-0.64,0.41-0.95,0.64L160.2,169.61c-0.75,0.44-5.12,2.89-10.17,2.89c-4.99,0-9.28-2.37-10.23-2.94L30.99,87.7 c-0.31-0.23-0.63-0.44-0.95-0.64V81.5C30.03,74.88,32.65,68.62,37.4,63.87z M262.66,239.13c-4.75,4.75-11.01,7.37-17.63,7.37h-190 c-6.62,0-12.88-2.62-17.63-7.37c-4.75-4.75-7.37-11.01-7.37-17.63v-99.48l93.38,70.24c0.16,0.12,0.32,0.24,0.49,0.35 c1.17,0.81,11.88,7.88,26.13,7.88c14.25,0,24.96-7.07,26.14-7.88c0.17-0.11,0.33-0.23,0.49-0.35l93.38-70.24v99.48 C270.03,228.12,267.42,234.38,262.66,239.13z"/></symbol>
		<symbol viewBox="0 0 512 512" id="stk-amazon-svg"><path class="st0" d="M444.6,421.5L444.6,421.5C233.3,522,102.2,437.9,18.2,386.8c-5.2-3.2-14,0.8-6.4,9.6 C39.8,430.3,131.5,512,251.1,512c119.7,0,191-65.3,199.9-76.7C459.8,424,453.6,417.7,444.6,421.5z"/><path class="st0" d="M504,388.7L504,388.7c-5.7-7.4-34.5-8.8-52.7-6.5c-18.2,2.2-45.5,13.3-43.1,19.9c1.2,2.5,3.7,1.4,16.2,0.3 c12.5-1.2,47.6-5.7,54.9,3.9c7.3,9.6-11.2,55.4-14.6,62.8c-3.3,7.4,1.2,9.3,7.4,4.4c6.1-4.9,17-17.7,24.4-35.7 C503.9,419.6,508.3,394.3,504,388.7z"/><path class="st0" d="M302.6,147.3c-39.3,4.5-90.6,7.3-127.4,23.5c-42.4,18.3-72.2,55.7-72.2,110.7c0,70.4,44.4,105.6,101.4,105.6 c48.2,0,74.5-11.3,111.7-49.3c12.4,17.8,16.4,26.5,38.9,45.2c5,2.7,11.5,2.4,16-1.6l0,0h0c0,0,0,0,0,0l0.2,0.2 c13.5-12,38.1-33.4,51.9-45c5.5-4.6,4.6-11.9,0.2-18c-12.4-17.1-25.5-31.1-25.5-62.8V150.2c0-44.7,3.1-85.7-29.8-116.5 c-26-25-69.1-33.7-102-33.7c-64.4,0-136.3,24-151.5,103.7c-1.5,8.5,4.6,13,10.1,14.2l65.7,7c6.1-0.3,10.6-6.3,11.7-12.4 c5.6-27.4,28.7-40.7,54.5-40.7c13.9,0,29.7,5.1,38,17.6c9.4,13.9,8.2,33,8.2,49.1V147.3z M289.9,288.1 c-10.8,19.1-27.8,30.8-46.9,30.8c-26,0-41.2-19.8-41.2-49.1c0-57.7,51.7-68.2,100.7-68.2v14.7C302.6,242.6,303.2,264.7,289.9,288.1 z"/></symbol>
		<symbol viewBox="0 0 256 256" id="stk-link-svg"><path d="M85.56787,153.44629l67.88281-67.88184a12.0001,12.0001,0,1,1,16.97071,16.97071L102.53857,170.417a12.0001,12.0001,0,1,1-16.9707-16.9707ZM136.478,170.4248,108.19385,198.709a36,36,0,0,1-50.91211-50.91113l28.28418-28.28418A12.0001,12.0001,0,0,0,68.59521,102.543L40.311,130.82715a60.00016,60.00016,0,0,0,84.85351,84.85254l28.28418-28.28418A12.0001,12.0001,0,0,0,136.478,170.4248ZM215.6792,40.3125a60.06784,60.06784,0,0,0-84.85352,0L102.5415,68.59668a12.0001,12.0001,0,0,0,16.97071,16.9707L147.79639,57.2832a36,36,0,0,1,50.91211,50.91114l-28.28418,28.28418a12.0001,12.0001,0,0,0,16.9707,16.9707L215.6792,125.165a60.00052,60.00052,0,0,0,0-84.85254Z"/></symbol>
		<symbol viewBox="0 0 384 512" id="stk-close-svg"><path fill="currentColor" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></symbol>
		</defs></svg>';
	}
	add_action('wp_body_open', 'stk_svg_symbol');
}

// SNSリンク（ヘッダー＆フッター表示用）
function stk_snslinks($position = null)
{
	if (
		!get_theme_mod('stk_facebooklink_url')
		&& !get_theme_mod('stk_twitterlink_url')
		&& !get_theme_mod('stk_youtubelink_url')
		&& !get_theme_mod('stk_instagramlink_url')
		&& !get_theme_mod('stk_linelink_url')
		&& !get_theme_mod('stk_tiktoklink_url')
	) {
		return;
	}

	$stk_hidden_pc = get_theme_mod('stk_snslinks_pc_hide') && $position !== 'modal' ? " stk-hidden_pc" : null;
	$stk_hidden_sp = get_theme_mod('stk_snslinks_sp_hide') && $position !== 'modal' ? " stk-hidden_sp" : null;

	// どちらも非表示にする場合はコードごと出力しない
	if($stk_hidden_pc && $stk_hidden_sp && $position !== 'footer') {
		return;
	}
	$positionclass = ' --position-' . $position;
	
	$output = '';

	$output .= '<ul class="stk_sns_links' . $positionclass . $stk_hidden_pc . $stk_hidden_sp . '">';

	$output .= stk_sns_btn_li(get_theme_mod('stk_facebooklink_url'), 'facebook', 'Facebook', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-facebook-svg" /></svg>');

	$twitter_label = get_option( 'sns_button_hide_twitter' ) == 'logo_bird' ? 'Twitter': 'X.com';
	$output .= stk_sns_btn_li(get_theme_mod('stk_twitterlink_url'), 'twitter', $twitter_label, '<svg class="stk_sns__svgicon"><use xlink:href="#stk-twitter-svg" /></svg>');

	$output .= stk_sns_btn_li(get_theme_mod('stk_youtubelink_url'), 'youtube', 'YouTube', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-youtube-svg" /></svg>');

	$output .= stk_sns_btn_li(get_theme_mod('stk_instagramlink_url'), 'instagram', 'Instagram', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-instagram-svg" /></svg>');

	$output .= stk_sns_btn_li(get_theme_mod('stk_linelink_url'), 'line', 'LINE', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-line-svg" /></svg>');

	$output .= stk_sns_btn_li(get_theme_mod('stk_tiktoklink_url'), 'tiktok', 'TikTok', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-tiktok-svg" /></svg>');

	$output .= '</ul>';

	echo $output;
}


// フォローボックス
if (!function_exists('stk_followbox')) {
	function stk_followbox()
	{
		if (
			(!get_option('fbbox_options_url')
				&& !get_option('twbox_options_url')
				&& !get_option('feedlybox_options_url')
				&& !get_option('youtubebox_options_url')
				&& !get_option('linebox_options_url')
				&& !get_option('instagrambox_options_url')
			) || !is_single()
		) {
			return;
		}
		$output = '';
		$output .= '<div class="fb-likebtn" style="background-image: url(' . get_the_post_thumbnail_url() . ');">
		<div class="inner">';
		$output .= '<p class="h_ttl h2 like_text"><span class="gf">FOLLOW</span></p>';
		$output .= '<ul class="stk_sns_links --followbtns">';

		$output .= stk_sns_btn_li(get_option('fbbox_options_url'), 'facebook', 'Facebook', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-facebook-svg" /></svg>', '--followbtn');

		$twitter_class = get_option( 'sns_button_hide_twitter' ) == 'logo_bird' ? 'twitter --bird': 'twitter';
		$twitter_label = get_option( 'sns_button_hide_twitter' ) == 'logo_bird' ? 'Twitter': 'X.com';
		$output .= stk_sns_btn_li(get_option('twbox_options_url'), $twitter_class, $twitter_label, '<svg class="stk_sns__svgicon"><use xlink:href="#stk-twitter-svg" /></svg>', '--followbtn');

		$output .= stk_sns_btn_li(get_option('youtubebox_options_url'), 'youtube', 'YouTube', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-youtube-svg" /></svg>', '--followbtn');

		$output .= stk_sns_btn_li(get_option('instagrambox_options_url'), 'instagram', 'Instagram', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-instagram-svg" /></svg>', '--followbtn');

		$output .= stk_sns_btn_li(get_option('linebox_options_url'), 'line', 'LINE', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-line-svg" /></svg>', '--followbtn');

		$output .= stk_sns_btn_li(get_option('feedlybox_options_url'), 'feedly', 'Feedly', '<svg class="stk_sns__svgicon"><use xlink:href="#stk-feedly-svg" /></svg>', '--followbtn');

		$output .= '</ul>';

		$output .= '</div>
		</div>';

		echo $output;
	}
}


if (!function_exists('stk_author_sns_list')) {
	function stk_author_sns_lists($id) {
		$output = "";
		if(
			get_the_author_meta( 'user_url', $id )
			|| get_the_author_meta( 'twitter', $id )
			|| get_the_author_meta( 'facebook', $id )
			|| get_the_author_meta( 'instagram', $id )
			|| get_the_author_meta( 'youtube', $id )
			|| get_the_author_meta( 'line', $id )
			|| get_the_author_meta( 'tiktok', $id )
			|| get_the_author_meta( 'amazon', $id )
		) {

			$twitter_label = get_option( 'sns_button_hide_twitter' ) == 'logo_bird' ? 'Twitter': 'X.com';

			$lists = array(
				'user_url'   => 'WebSite',
				'twitter'    => $twitter_label,
				'facebook'   => 'Facebook',
				'instagram'  => 'Instagram',
				'youtube'    => 'YouTube',
				'line'       => 'LINE',
				'tiktok'     => 'TikTok',
				'amazon'     => 'Amazon',
			);
	
			$output .= '<ul class="stk_sns_links">';
			
			foreach($lists as $key => $value) {
				if(get_the_author_meta( $key, $id )) {
					$output .= '<li class="sns_li__'.$key.'">
						<a 
							href="' . get_the_author_meta( $key, $id ) . '" 
							title="' . $value . '" 
							aria-label="' . $value . '" 
							class="no-icon stk_sns_links__link --author_sns"
							target="_blank"
							rel="noopener"
						>
							<svg class="stk_sns__svgicon"><use xlink:href="#stk-'.$key.'-svg" /></svg>
						</a>
					</li>';
				}
			}

			$output .= '</ul>';
		}
		return $output;

	}
}