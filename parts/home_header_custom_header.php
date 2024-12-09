<?php

// headerunderlinkの表示
add_action( 'wp', function() {
    if( stk_is_headeroverlay() ) {
        if(is_page_template('page-wide-headeroverlay.php')){
            return;
        }
        // 透過headerの場合はヘッダーアイキャッチの下に表示する
        if(get_option('stk_homeheader-headeroverlay__infoposition', 'off') === 'on_under'){
            add_action( 'stk_hook_header_after', 'stk_headerunderlink', 6);	
        }
    } else {
        add_action( 'stk_hook_header_after', 'stk_headerunderlink', 4);
    }
} );

// カスタムヘッダー周りの呼び出し用hook
add_action( 'stk_hook_header_after', 'home_header_custom_header', 5 );
add_action( 'stk_hook_header_after', 'home_header_slider', 10 );
add_action( 'stk_hook_header_after', 'pickUpContent', 15 );


if(!function_exists('home_header_custom_header')) {
    function home_header_custom_header(){
        if ( !is_front_page() || is_paged() || get_option('opencage_toppage_header_display', 'on') =='off' ) {
            return;
        }
            
        // 画像URLを代入
        if ( get_theme_mod('opencage_toppage_headerbgsp') && is_mobile()){
            $imgurl = esc_url(get_theme_mod('opencage_toppage_headerbgsp'));
        } elseif(get_theme_mod('opencage_toppage_headerbg')) {
            $imgurl = esc_url(get_theme_mod('opencage_toppage_headerbg'));
        } else {
            $imgurl = null;
        }
        

        // 動画URLを代入
        if( get_theme_mod('opencage_toppage_headerbg_movie_sp') && is_mobile() ) {
            $movieurl = get_theme_mod('opencage_toppage_headerbg_movie_sp');
        } elseif(get_theme_mod('opencage_toppage_headerbg_movie')) {
            $movieurl = get_theme_mod('opencage_toppage_headerbg_movie');
        } else {
            $movieurl = null;
        }

        // スマホ用に動画か画像をセットしているかどうか
        $sp_movie_set = !get_theme_mod('opencage_toppage_headerbg_movie_sp') && get_theme_mod('opencage_toppage_headerbgsp') && is_mobile() ? true : false;

        // テキスト
        $en_text = get_option( 'opencage_toppage_headeregtext' ) ? get_option( 'opencage_toppage_headeregtext' ) : null;
        $jp_text = get_option( 'opencage_toppage_headerjptext' ) ? get_option( 'opencage_toppage_headerjptext' ) : null;
        $gf_font = !get_option('opencage_toppage_header_gf') ? ' gf' : null;

        // リンク
        $btn_link = get_option( 'opencage_toppage_headerlink' ) ? esc_url(get_option( 'opencage_toppage_headerlink' )) : null;

        $loop = get_theme_mod('stk_toppage_headerbg_movie__loop') ? null : 'loop=""';

        if ( $en_text || $jp_text ) {

            $movieposter = $imgurl ? ' poster="' . $imgurl . '"' : null;

            
            //動画背景
            $tag_bg_movie = $movieurl && !$sp_movie_set ? '<video class="wp-block-cover__video-background" autoplay="" muted="" '.$loop.' playsinline="" src="' . $movieurl . '"' . $movieposter . '></video>' : null;

            // background-image
            if(!$tag_bg_movie && $imgurl) {
                $image_id = attachment_url_to_postid($imgurl);
                $tag_bg_image = wp_get_attachment_image(
                    $image_id, 
                    'full', 
                    false,
                    array(
                        'class' => 'wp-block-cover__image-background',
                        'loading' => false,
                    )
                );
            } else {
                $tag_bg_image = null;
            }
                        
            // レイアウト・オーバーレイ
            $class_textlayout = ' ' . get_option('opencage_toppage_textlayout', 'textcenter');
            $class_overlaystyle = ' overlay-' . get_theme_mod('opencage_toppage_headder_overlay_design', 'color');

            echo '<div id="custom_header" class="stk_custom_header wp-block-cover has-background-dim fadeIn' . $class_textlayout . $class_overlaystyle . '">' 
            .$tag_bg_movie
            .$tag_bg_image. 
            '
            <div class="wp-block-cover__inner-container">
            <div class="stk_custom_header__text header-text">';

            if ( $en_text ) {
                echo '<h2 class="en'.$gf_font.' fadeInDown delay-0_1s">' . $en_text . '</h2>';
            }
            if ( $jp_text ) {
                echo '<div class="ja fadeInUp delay-0_2s">' . $jp_text . '</div>';
            }

            if ( $btn_link ) {

                $btn_text = get_option('opencage_toppage_headerlinktext') ? get_option('opencage_toppage_headerlinktext') : '詳しくはこちら';
                $btn_style = get_option('opencage_toppage_btnstyle', 'is-style-fill') ? : 'is-style-fill';
                
                $btn_class = 'wp-block-button '.$btn_style.' fadeInUp delay-0_3s';
                if(get_option('opencage_toppage_btnshiny', 'normal') !== 'normal') {
                    $btn_class .= ' '.get_option('opencage_toppage_btnshiny');
                }
                
                echo '<div class="'.$btn_class.'"><a class="wp-block-button__link" href="' . $btn_link . '">' . $btn_text . '</a></div>';
            }
            echo '</div>
            </div>
            </div>';

        } elseif( $imgurl || $movieurl ) {

            echo '<div id="custom_header_img" class="stk_custom_header">';
            if ( $btn_link ) {
                echo '<a href="' . $btn_link . '">';
            }

            $poster_tag = $imgurl ? 'poster="' . $imgurl . '"' : null;

            if( $movieurl ) {
                echo '<figrue class="wp-block-video"><video autoplay="" '.$loop.' muted="" ' . $poster_tag . ' src="' . $movieurl . '" playsinline=""></video></figrue>';
            } else {
                $tag_image = wp_get_attachment_image(attachment_url_to_postid($imgurl), 'full');
                echo $tag_image;
            }

            if ( $btn_link ) {
                echo '</a>';
            }
            echo '</div>';
        }
    
    }
}


function stk_homeheader_css() {
    if ( !is_front_page() || is_paged() || get_option('opencage_toppage_header_display', 'on') =='off' ) {
        return;
    }
    
    $overlay_color = get_theme_mod('opencage_toppage_headder_overlay', '#000000');
    $overlay_color_style = get_theme_mod('opencage_toppage_headder_overlay_design','color') !=='none' ? '#custom_header.overlay-color::before {
        background-color: '.$overlay_color.';
    }':null;
    
    $overlay_stripe_style = get_theme_mod('opencage_toppage_headder_overlay_design','color') !=='none' ? '#custom_header.overlay-stripe::before {
        background-image: repeating-linear-gradient(-45deg, '.$overlay_color.' 0, '.$overlay_color.' 3px, transparent 3px, transparent 6px);
    }': null;

    $overlay_dot_style = get_theme_mod('opencage_toppage_headder_overlay_design','color') !=='none' ? '#custom_header.overlay-dot::before {
        background-image: radial-gradient('.$overlay_color.' 50%, transparent 50%);
        background-size: 5px 5px;
    }': null;
    
    $overlay_opacity = get_theme_mod('opencage_toppage_headder_overlay_opacity', 5) * 0.01;
    $overlay_opacity_style = get_theme_mod('opencage_toppage_headder_overlay_design','color') !=='none' ? '#custom_header::before {
        opacity: '.$overlay_opacity.';
    }': null;

    $minheight = is_mobile() ? get_option('opencage_toppage_header_minheight_sp', '60') : get_option('opencage_toppage_header_minheight', '50');

    $textcolor = get_theme_mod('opencage_toppage_textcolor','#0ea3c9');

    $btn_textcolor = get_theme_mod('opencage_toppage_btncolor', '#ffffff');
    $btn_bgcolor = get_theme_mod('opencage_toppage_btnbgcolor', '#ed7171');
    $btn_bgcolor2 = get_theme_mod('opencage_toppage_btnbgcolor2');
    // 塗りつぶしスタイル且つボタン背景色が設定されている場合のみ出力
    $btn_bgcolor2_style = get_option('opencage_toppage_btnstyle', 'is-style-fill') == 'is-style-fill' && get_theme_mod('opencage_toppage_btnbgcolor', '#ed7171') && get_theme_mod('opencage_toppage_btnbgcolor2') ? 'background: linear-gradient(135deg,'.$btn_bgcolor.','.$btn_bgcolor2.');': null;

    $bg_switch = get_theme_mod('opencage_toppage_headder_overlay_design', 'color');

    // 透過ヘッダーの色： 無指定の場合はヘッダーアイキャッチの文字色と同じにする
    $stk_headercolor = get_theme_mod('stk_homeheader-headeroverlay__textcolor') ? get_theme_mod('stk_homeheader-headeroverlay__textcolor') : get_theme_mod('opencage_toppage_textcolor','#0ea3c9');
    
    $tag = '
        #custom_header.has-background-dim {
            background-color: transparent;
            min-height: '.$minheight.'vh;
        }
        
        '.$overlay_stripe_style.'
        '.$overlay_dot_style.'
        '.$overlay_color_style.'
        '.$overlay_opacity_style.'

        #custom_header .stk_custom_header__text {
            color: '.$textcolor.';
        }
        #custom_header .wp-block-button .wp-block-button__link {
            color: '.$btn_textcolor.';
        }
        #custom_header .wp-block-button:not(.is-style-outline) .wp-block-button__link {
            background-color: '.$btn_bgcolor.';
            border-color: '.$btn_bgcolor.';
            '.$btn_bgcolor2_style.'
        }
        #custom_header .wp-block-button.is-style-outline .wp-block-button__link {
            border-color: '.$btn_textcolor.';
        }
        ';

	wp_add_inline_style('stk_style', minify_css($tag));
}
add_action( 'wp_enqueue_scripts', 'stk_homeheader_css');


// headerunderlink
if (!function_exists('stk_headerunderlink')) {
	function stk_headerunderlink() {
		if ( get_option('other_options_headerunderlink') && get_option('other_options_headerundertext') ) {
            
            $target = get_option('other_options_headerunderlink_target') ? ' target="_blank"': null;
            $link = ' href="' . esc_url(get_option('other_options_headerunderlink')) . '"';

			$output = '<div class="header-info fadeIn">';
			$output .= '<a class="header-info__link"' . $target . $link .'>';
			$output .= get_option('other_options_headerundertext') ;
			$output .= '</a></div>';
			echo $output;
		} else {
			return null;
		}
	}
}

function stk_headerunder_css() {
    if ( !get_option('other_options_headerunderlink') || !get_option('other_options_headerundertext') ) {
        return;
    }

    $headerundertext = get_theme_mod('other_options_headerundertext_color', '#ffffff');
    $headerunderbg = get_theme_mod('other_options_headerunderlink_bgcolor', '#f55e5e');
    $headerunderbg2 = get_theme_mod('other_options_headerunderlink_bgcolor2', '#ffbaba');
    $headerunderbg2_style = get_theme_mod('other_options_headerunderlink_bgcolor', '#f55e5e') && get_theme_mod('other_options_headerunderlink_bgcolor2', '#ffbaba') ? 'background: linear-gradient(135deg, '.$headerunderbg.', '.$headerunderbg2.');': null;

    $tag = '
    .header-info {
        color: '.$headerundertext.';
        background: '.$headerunderbg.';
        '.$headerunderbg2_style.'
    }
    ';

    wp_add_inline_style('stk_style', minify_css($tag));
}
add_action( 'wp_enqueue_scripts', 'stk_headerunder_css');
