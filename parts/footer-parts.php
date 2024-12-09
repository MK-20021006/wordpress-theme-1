<?php

if (!defined('ABSPATH')) {
  exit;
}

// スクロールターゲット
add_action('wp_footer', function () {
	echo '<div id="stk_observer_target"></div>';
}, 1);


// ページトップへ戻るボタン
if (!function_exists('pagetop')) {
	add_action('wp_footer', 'pagetop');
	function pagetop()
	{
		if (
			get_option('advanced_pagetop_btn', 'on') == 'off'
			|| (is_mobile() && has_nav_menu('footer-menu-sp') && !is_page_template('page-lp.php'))
		) {
			return;
		}
		$amp_class = stk_is_amp() ? ' class="pt-active pt-a-amp"' : '';
		$btntext = get_option('stk_pt_fixbtntext') ? '<span class="btn-text">' . get_option('stk_pt_fixbtntext') . '</span>' : null;
		$output = '<button id="page-top" type="button" class="pt-button' . $amp_class . '" aria-label="ページトップへ戻る">' . $btntext . '</button>';
		$output = minify_html($output);

		echo $output;
	}
}


// 固定フッターメニュー
if (!function_exists('stk_fix_footermenu')) {
	add_action('wp_footer', 'stk_fix_footermenu', 5);
	function stk_fix_footermenu()
	{
		if (is_page_template('page-lp.php') || !has_nav_menu('footer-menu-sp') || !is_mobile()) {
			return;
		}

		class Custom_Walker_Nav_Menu_Li_Only extends Walker_Nav_Menu {
			// 開始タグを無効にする
			function start_lvl( &$output, $depth = 0, $args = null ) {}
			// 終了タグを無効にする
			function end_lvl( &$output, $depth = 0, $args = null ) {}
			// `<li>` タグとリンク内容を出力
			function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
				$output .= '<li class="' . esc_attr(implode(' ', $item->classes)) . '" aria-label="' . $item->title . '">';
				// リンク内にアイコンやスパンを含める処理
				$link_output = '<a href="' . esc_url($item->url) . '">';

				if (!empty($item->description) && $depth === 0) {
					$link_output .= '<i class="' . esc_attr($item->description) . '"></i>';
				} else {
					$link_output .= '<span>' . $item->title . '</span>';
				}
				
				$link_output .= '</a>';
				$output .= $link_output;
			}
			function end_el( &$output, $item, $depth = 0, $args = null ) {
				$output .= '</li>';
			}
		}

		$fixcolor = get_option('stk_fix_footer_color','default') !== 'default' ? ' ' . get_option('stk_fix_footer_color','default') : null;
		$spnavi = !get_option('stk_fix_footer_spnavi') && is_active_sidebar('sidebar-sp') ? '<li class="menu-item" data-remodal-target="spnavi" aria-label="メニュー"><i class="fa-solid fa-bars"></i></li>' : null;
		$snslinks = !get_option('stk_fix_footer_snslinks') && (get_theme_mod('stk_facebooklink_url') || get_theme_mod('stk_twitterlink_url') || get_theme_mod('stk_youtubelink_url') || get_theme_mod('stk_instagramlink_url') || get_theme_mod('stk_linelink_url') || get_theme_mod('stk_tiktoklink_url')) ? '<li class="menu-item" data-remodal-target="snslinks_overlay" aria-label="SNS"><i class="fa-solid fa-share-nodes"></i></li>' : null;
		$search = !get_option('stk_fix_footer_search') ? '<li class="menu-item" data-remodal-target="searchbox" aria-label="検索"><i class="fa-solid fa-magnifying-glass"></i></li>' : null;
		$pagetop = !get_option('stk_fix_footer_pagetop') ? '<li class="menu-item" id="page-top" aria-label="トップへ"><i class="fa-solid fa-angle-up"></i></li>' : null;
		$textnone = get_option('stk_fix_footer_textnone') ? ' textnone' : null;

		echo '<div id="fixed-footer-menu" class="stk-hidden_pc' . $fixcolor . $textnone . '"><ul>' . $spnavi;

		wp_nav_menu(array(
			'container' => '',
			'menu' => __('フッター固定メニュー'),
			'theme_location' => 'footer-menu-sp',
			'walker' => new Custom_Walker_Nav_Menu_Li_Only(),
			'items_wrap' => '%3$s', // <ul>タグを削除
			'fallback_cb' => ''
		));

		echo $snslinks . $search . $pagetop . '</ul></div>';
	}
}


// 固定フッターメニューの高さを取得して位置を調整
add_action('wp_footer', 'stk_addstyle_bottom');
function stk_addstyle_bottom() {
	if (is_page_template('page-lp.php') || !has_nav_menu('footer-menu-sp') || !is_mobile()) {
		return;
	}

	$script = "
	<script id=\"stk-addstyle-bottom\">
	jQuery(function($) {
	function adjustFooterPadding() {
    var menuHeight = $('#fixed-footer-menu').outerHeight(true);
    $('#footer').css('padding-bottom', menuHeight);
	$('#fixed-footer-menu').css('bottom', - menuHeight);
	$('#before-footer').css('bottom', menuHeight);
	$('.btn-bf-close').css('bottom', menuHeight);
	}
	adjustFooterPadding();
	$(window).on('resize', adjustFooterPadding); // ウィンドウリサイズ時に再計算
    });
	</script>
	";
	$output = minify_js($script);

	echo $output;
}


// pt-activeクラスを付与するスクリプト（固定フッターウィジェット/ページトップへ戻るボタン/固定フッターメニュー）
add_action('wp_footer', 'stk_addclass_ptactive');
function stk_addclass_ptactive() {
	if (
		get_option('advanced_pagetop_btn', 'on') == 'off'
		&& get_option('stk_widget_options_footerfixed','footerfixed') == 'footernormal'
		&& (!has_nav_menu('footer-menu-sp') || !is_mobile())
	) {
		return;
	}
	if (!stk_is_amp()) {
		$script = "
		<script id=\"stk_addclass_ptactive\">
			(function () {
				const select = document.querySelector('#stk_observer_target');
				const observer = new window.IntersectionObserver((entry) => {
					if (!entry[0].isIntersecting) {
						document.querySelectorAll('#before-footer,.btn-bf-close,.pt-button,#fixed-footer-menu').forEach(element => {
							element.classList.add('pt-active');
						});
					} else {
						document.querySelectorAll('#before-footer,.btn-bf-close,.pt-button,#fixed-footer-menu').forEach(element => {
							element.classList.remove('pt-active');
						});
					}
				});
				observer.observe(select);
			}());
		</script>";
		$output = minify_js($script);
	}
	echo $output;
}


// 固定フッターウィジェットのスクリプト
add_action('wp_footer', 'stk_addclass_footerfixed');
function stk_addclass_footerfixed() {
	if (
		get_option('stk_widget_options_footerfixed', 'footerfixed') == 'footernormal'
		|| !is_active_sidebar('before-footer-sp') && is_mobile()
		|| !is_active_sidebar('before-footer-pc') && !is_mobile()
		|| get_option('stk_widget_options_footerfixed','footerfixed') == 'footerfixed_pc' && is_mobile()
		|| get_option('stk_widget_options_footerfixed','footerfixed') == 'footerfixed_sp' && !is_mobile()
		|| is_page_template('page-lp.php')
	) {
		return;
	}
		
	if (!stk_is_amp()) {
		$script = "
		<script id=\"stk-addclass-footerfixed\">
			// contentの高さがウィンドウの高さを上回る場合のみ実行
			(function () {
				const contentHeight = document.getElementById('content').scrollHeight;
				const windowHeight = window.innerHeight;

        		if (contentHeight > windowHeight) {
            		document.getElementById('before-footer').classList.add('footer-fixed');
        		}
			}());

			// 固定解除ボタンに--is-activeクラスを付与
			(function () {
		        const footer = document.querySelector('#footer');
    		    const observer = new window.IntersectionObserver((entry) => {
	    		    if (!entry[0].isIntersecting) {
                    	document.querySelector('.btn-bf-close').classList.add('--is-active');
                    } else {
                        document.querySelector('.btn-bf-close').classList.remove('--is-active');
                    }
                });
                observer.observe(footer);
            }());
		</script>";
		$output = minify_js($script);
	}
	echo $output;
}
