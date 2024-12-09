<?php

if (!defined('ABSPATH')) {
  exit;
}

function stk_snsbutton($position = null)
{

	if (
		get_option('sns_button_display', 'on') == 'off'
		|| ( is_page() && get_option( 'sns_button_display', 'on' ) !== 'on_withpage')
		|| ( is_home() && is_front_page() )
		|| ( get_option('sns_button_display__tophidden')==1 && $position !== 'under' )
	) {
		return;
    }
	
	
	$url_encode = rawurlencode(get_permalink());
	$title_encode = rawurlencode(get_the_title());
	
	$tw_url = get_the_author_meta( 'twitter' );
	$tw_domain = array("http://twitter.com/"=>"","https://twitter.com/"=>"","//twitter.com/"=>"");
	$tw_user = get_the_author_meta('twitter') ? '&via=' . strtr($tw_url , $tw_domain) : null;
	
	$output = "";
	
	if($position)
	{
		$amp_class = stk_is_amp() ? ' --is-active' : '';

		$output .= get_option( 'sns_button_display__sidefix' ) ? '<div class="sharewrap sns-fix'.$amp_class.'">' : '<div class="sharewrap">';
		$sns_options_text = get_option( 'sns_options_text' ) ? '<div class="h3 sharewrap__title">' . get_option( 'sns_options_text' ) . '</div>' : null;
		$output .= $sns_options_text;
	}

	$btn_class = get_option('sns_button_style', '--style-rich');

	$output .= '<ul class="sns_btn__ul ' . $btn_class . '">';

	if( get_option( 'sns_button_hide_twitter' ) !== '1' )
	{
		$twitter_class = get_option( 'sns_button_hide_twitter' ) == 'logo_bird' ? ' --bird': null;
		$output .= '<li class="sns_btn__li twitter'.$twitter_class.'">';
		if ( stk_is_amp() )
		{
			$output .= '<amp-social-share type="twitter"></amp-social-share>';
		} else {
			$output .= '<a class="sns_btn__link" target="blank" 
				href="//twitter.com/intent/tweet?url=' . $url_encode . '&text='.$title_encode. $tw_user . '&tw_p=tweetbutton" 
				onclick="window.open(this.href, \'tweetwindow\', \'width=550, height=450,personalbar=0,toolbar=0,scrollbars=1,resizable=1\'); return false;
				">
				<svg class="stk_sns__svgicon"><use xlink:href="#stk-twitter-svg" /></svg>
				<span class="sns_btn__text">ポスト</span>';
				
			$output .= stk_sns_count('twitter');

			$output .= '</a>';
		}
		$output .= '</li>';
	}

	if( !get_option( 'sns_button_hide_facebook' ) == 1 ) 
	{
		$output .= '<li class="sns_btn__li facebook">';
        if (stk_is_amp()) 
		{
			$fb_app_id = get_option('sns_button_facebook_app_id');
			$output .= '<amp-social-share type="facebook" data-param-app_id="' . $fb_app_id . '"></amp-social-share>';
        } else {
			$output .= '<a class="sns_btn__link" 
				href="//www.facebook.com/sharer.php?src=bm&u=' .$url_encode. '&t=' . $title_encode . '" 
				onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;
				">
				<svg class="stk_sns__svgicon"><use xlink:href="#stk-facebook-svg" /></svg>
				<span class="sns_btn__text">シェア</span>';
			$output .= stk_sns_count('facebook');
			$output .= '</a>';
		}
		$output .= '</li>';
	}
		
	if( !get_option( 'sns_button_hide_hatebu' ) == 1 ) 
	{
		$share_url = add_query_arg(
			array(
			  'mode'  => 'confirm',
			  'url'   => $url_encode,
			  'title' => $title_encode,
			),
			'https://b.hatena.ne.jp/add'
		);

		$output .= '<li class="sns_btn__li hatebu">';
        if (stk_is_amp()) 
		{
			$output .= '<amp-social-share type="hatebu" data-share-endpoint="' . esc_url( $share_url ) . '">
			<svg class="stk_sns__svgicon"><use xlink:href="#stk-hatebu-svg" /></svg>
			</amp-social-share>';
        } else {
			$output .= '<a class="sns_btn__link" target="_blank"
				href="//b.hatena.ne.jp/add?mode=confirm&url=' . get_permalink() . '
				&title=' . $title_encode . '" 
				onclick="window.open(this.href, \'HBwindow\', \'width=600, height=400, menubar=no, toolbar=no, scrollbars=yes\'); return false;
				">
				<svg class="stk_sns__svgicon"><use xlink:href="#stk-hatebu-svg" /></svg>
				<span class="sns_btn__text">はてブ</span>';
			$output .= stk_sns_count('hatebu');
			$output .= '</a>';	
		}
		$output .= '</li>';
	}
	
	if( !get_option( 'sns_button_hide_line' ) == 1 ) 
	{
		$output .= '<li class="sns_btn__li line">';
		if ( stk_is_amp() )
		{
			$output .= '<amp-social-share type="line"></amp-social-share>';
		} else {
			$output .= '<a class="sns_btn__link" target="_blank"
				href="//line.me/R/msg/text/?' . $title_encode . '%0A' . $url_encode . '
				">
				<svg class="stk_sns__svgicon"><use xlink:href="#stk-line-svg" /></svg>
				<span class="sns_btn__text">送る</span>';
			$output .= '</a>';
		}
		$output .= '</li>';
	}

	if( !get_option( 'sns_button_hide_pocket' ) == 1 )
	{
		$output .= '<li class="sns_btn__li pocket">';
		$share_url = add_query_arg(
			array(
			  'url'   => $url_encode,
			  'title' => $title_encode,
			),
			'https://getpocket.com/edit'
		);

		if ( stk_is_amp() ) 
		{
			$output .= '<amp-social-share type="pocket" data-share-endpoint="' . esc_url( $share_url ) . '">
			<svg class="stk_sns__svgicon"><use xlink:href="#stk-pokect-svg" /></svg>
			</amp-social-share>';
		} else {
			$output .= '<a class="sns_btn__link" 
				href="//getpocket.com/edit?url=' . get_permalink() . '&title=' . $title_encode . '" 
				onclick="window.open(this.href, \'Pocketwindow\', \'width=550, height=350, menubar=no, toolbar=no, scrollbars=yes\'); return false;
				">
				<svg class="stk_sns__svgicon"><use xlink:href="#stk-pokect-svg" /></svg>
				<span class="sns_btn__text">Pocket</span>';
			$output .= stk_sns_count('pocket');
			$output .= '</a>';
		}
		$output .= '</li>';
	}

	if( !get_option( 'sns_button_hide_pinterest', 1) == 1)
	{
		$pin_media = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : null;
		$pin_media_url = $pin_media ? "&media=" . $pin_media : null;
		
		$output .= '<li class="sns_btn__li pinterest">';

		if ( stk_is_amp() ) 
		{
			$output .= '<amp-social-share type="pinterest"></amp-social-share>';
		} else {
			$output .= '<a class="sns_btn__link" target="_blank" 
				href="//pinterest.com/pin/create/button/?url=' . $url_encode . '&media=' . $pin_media . '&description=' . $title_encode . '
				">
				<svg class="stk_sns__svgicon"><use xlink:href="#stk-pinterest-svg" /></svg>
				<span class="sns_btn__text">Pin it</span>';
			$output .= '</a>';
		}
		$output .= '</li>';
	}

	// コピーボタン
	if( !get_option( 'sns_button_hide_copyurl', 1) == 1 && !stk_is_amp())
	{
		$output .= '<li class="sns_btn__li copyurl">
		<div class="copy_success_text">コピーしました</div>
		<a class="sns_btn__link" id="stk-copyurl" data-url="' . get_permalink() . '" onclick="copyUrl(this)">
		<svg class="stk_sns__svgicon"><use xlink:href="#stk-link-svg" /></svg>
		<span class="sns_btn__text">リンク<span>をコピー</span></span>
		</a>
		</li>';
	}

	$output .= '</ul>';

    if ($position) {
		$output .= '</div>';
    }
	echo $output;
}


// sns count cache ボタンカウント用メソッド
function stk_sns_count($name) {

	$socialname = 'scc_get_share_'.$name;

	if(function_exists($socialname)) {
		if($socialname() == 0) {
			return;
		} else {
			return '<span class="sns_btn__count">'.$socialname().'</span>';
		}
	}
}


// URLコピー
function stk_copy_url_scripts()
{
	if (
		get_option('sns_button_display', 'on') == 'off'
		|| ( is_page() && get_option( 'sns_button_display', 'on' ) !== 'on_withpage')
		|| !is_singular()
		|| get_option('sns_button_hide_copyurl', 1) == 1
		|| stk_is_amp()
	) {
		return;
    }
    $copy_url_scripts = <<<EOT
    <script id="stk-script-copy-url">
    function copyUrl(button){
        const url = document.querySelector('#stk-copyurl').dataset.url;
        let copied=navigator.clipboard.writeText(url);
        if(copied){
            jQuery(button).siblings('.copy_success_text').show().delay(1000).fadeOut(1000);
        }
    }
    </script>
EOT;
    $copy_url_scripts = minify_js($copy_url_scripts);
    echo minify_js($copy_url_scripts);
}
add_action('wp_footer', 'stk_copy_url_scripts');


// 画面端に固定表示したSNSボタンの表示切り替え
function stk_sns_fix_scripts()
{
	if (
		get_option('sns_button_display', 'on') == 'off'
		|| ( is_page() && get_option( 'sns_button_display', 'on' ) !== 'on_withpage')
		|| !is_singular()
		|| !get_option('sns_button_display__sidefix')
		|| stk_is_amp()
		|| is_mobile()
	) {
		return;
    }

	// 記事タイトル下にシェアボタンを表示している場合
	$top_display = !get_option('sns_button_display__tophidden');
	$querySelector = $top_display ? 'const eheader = document.querySelector(".entry-header");' : null;
	$observer = $top_display ? 'observer.observe(eheader);' : null;
		
    $sns_fix_scripts = <<<EOT
    <script id="stk-script-sns-fix">
    (function () {
		$querySelector
		const footer = document.querySelector("#footer");
		const observer = new window.IntersectionObserver((entry) => {
			if (!entry[0].isIntersecting) {
				document.querySelector('.sharewrap').classList.add('--is-active');
            } else {
                document.querySelector('.sharewrap').classList.remove('--is-active');
            }
        });
		$observer
        observer.observe(footer);
    }());
    </script>
EOT;
    $sns_fix_scripts = minify_js($sns_fix_scripts);
	echo minify_js($sns_fix_scripts);
}
add_action('wp_footer', 'stk_sns_fix_scripts');
