<?php

if (!defined('ABSPATH')) {
    exit;
}


function stk_theme_css_root_set()
{
    // default color
    $maintext = get_theme_mod('opencage_color_maintext', '#3E3E3E');
    $mainlink = get_theme_mod('opencage_color_mainlink', '#1bb4d3');
    $mainlinkhover = get_theme_mod('opencage_color_mainlink_hover', '#E69B9B');
    $mainttlbg = get_theme_mod('opencage_color_ttlbg', '#1bb4d3');
    $mainttltext = get_theme_mod('opencage_color_ttltext', '#ffffff');
    $headerbg = get_theme_mod('opencage_color_headerbg', '#1bb4d3');
    $headerlogo = get_theme_mod('opencage_color_headerlogo', '#eeee22');
    $headertext = get_theme_mod('opencage_color_headertext', '#edf9fc');
    $contentbg = get_theme_mod('opencage_color_contentbg', '#ffffff');
    $labelbg = get_theme_mod('opencage_color_labelbg', '#fcee21');
    $labeltext = get_theme_mod('opencage_color_labeltext', '#3e3e3e');
    $slidertext = get_theme_mod('opencage_color_slidertext', '#444444');
    $sidetext = get_theme_mod('opencage_color_sidetext', '#3e3e3e');
    $footerbg = get_theme_mod('opencage_color_footerbg', '#666666');
    $footertext = get_theme_mod('opencage_color_footertext', '#CACACA');
    $footerlink = get_theme_mod('opencage_color_footerlink', '#f7f7f7');
    $newmarkbg = get_theme_mod('post_new_mark_bgcolor', '#ff6347');

    $palettecolor1 = get_theme_mod('stk_palette_color1', '#abb8c3');
	$palettecolor2 = get_theme_mod('stk_palette_color2', '#f78da7');
	$palettecolor3 = get_theme_mod('stk_palette_color3', '#cf2e2e');
	$palettecolor4 = get_theme_mod('stk_palette_color4', '#ff6900');
	$palettecolor5 = get_theme_mod('stk_palette_color5', '#fcb900');
	$palettecolor6 = get_theme_mod('stk_palette_color6', '#7bdcb5');
	$palettecolor7 = get_theme_mod('stk_palette_color7', '#00d084');
	$palettecolor8 = get_theme_mod('stk_palette_color8', '#8ed1fc');
	$palettecolor9 = get_theme_mod('stk_palette_color9', '#0693e3');
	$palettecolor10 = get_theme_mod('stk_palette_color10', '#9b51e0');

    $editorcolor1 = get_theme_mod('stk_editor_color1', '#1bb4d3');
    $editorcolor2 = get_theme_mod('stk_editor_color2', '#f55e5e');
    $editorcolor3 = get_theme_mod('stk_editor_color3', '#eeee22');

    $boxblue = get_theme_mod('stk_preset_color_boxblue', '#19b4ce');
    $boxblue_inner = get_theme_mod('stk_preset_color_boxblue_inner', '#d4f3ff');
    $boxred = get_theme_mod('stk_preset_color_boxred', '#ee5656');
    $boxred_inner = get_theme_mod('stk_preset_color_boxred_inner', '#feeeed');
    $boxyellow = get_theme_mod('stk_preset_color_boxyellow', '#f7cf2e');
    $boxyellow_inner = get_theme_mod('stk_preset_color_boxyellow_inner', '#fffae2');
    $boxgreen = get_theme_mod('stk_preset_color_boxgreen', '#39cd75');
    $boxgreen_inner = get_theme_mod('stk_preset_color_boxgreen_inner', '#e8fbf0');
    $boxpink = get_theme_mod('stk_preset_color_boxpink', '#f7b2b2');
    $boxpink_inner = get_theme_mod('stk_preset_color_boxpink_inner', '#ffeeee');

    $richyellow = get_theme_mod('stk_preset_color_richyellow', '#f7cf2e');
    $richpink = get_theme_mod('stk_preset_color_richpink', '#ee5656');
    $richorange = get_theme_mod('stk_preset_color_richorange', '#ef9b2f');
    $richgreen = get_theme_mod('stk_preset_color_richgreen', '#39cd75');
    $richblue = get_theme_mod('stk_preset_color_richblue', '#19b4ce');

    // 透過ヘッダーの色： 無指定の場合はヘッダーアイキャッチの文字色と同じにする
    $stk_headercolor = get_theme_mod('stk_homeheader-headeroverlay__textcolor') ? get_theme_mod('stk_homeheader-headeroverlay__textcolor') : get_theme_mod('opencage_toppage_textcolor', '#0ea3c9');

    // 見出し背景色を透過させる
    $color_hex = $mainttlbg;
    $code_red = hexdec(substr($color_hex, 1, 2));
    $code_green = hexdec(substr($color_hex, 3, 2));
    $code_blue = hexdec(substr($color_hex, 5, 2));
    $mainttlbg_rgb = 'rgba(' . $code_red . ', ' . $code_green . ', ' . $code_blue . ', 0.1)';

    // ユーザーカラーの透過
    $editor1_code = $editorcolor1;
    $editor1_code_red = hexdec(substr($editor1_code, 1, 2));
    $editor1_code_green = hexdec(substr($editor1_code, 3, 2));
    $editor1_code_blue = hexdec(substr($editor1_code, 5, 2));
    $editorcolor1_rgb = 'rgba(' . $editor1_code_red . ', ' . $editor1_code_green . ', ' . $editor1_code_blue . ', 0.1)';

    $editor2_code = $editorcolor2;
    $editor2_code_red = hexdec(substr($editor2_code, 1, 2));
    $editor2_code_green = hexdec(substr($editor2_code, 3, 2));
    $editor2_code_blue = hexdec(substr($editor2_code, 5, 2));
    $editorcolor2_rgb = 'rgba(' . $editor2_code_red . ', ' . $editor2_code_green . ', ' . $editor2_code_blue . ', 0.1)';

    $editor3_code = $editorcolor3;
    $editor3_code_red = hexdec(substr($editor3_code, 1, 2));
    $editor3_code_green = hexdec(substr($editor3_code, 3, 2));
    $editor3_code_blue = hexdec(substr($editor3_code, 5, 2));
    $editorcolor3_rgb = 'rgba(' . $editor3_code_red . ', ' . $editor3_code_green . ', ' . $editor3_code_blue . ', 0.1)';

    // リッチボタンのシャドウ
    $richyellow_code = $richyellow;
    $richyellow_r = hexdec(substr($richyellow_code, 1, 2))-25;
    $richyellow_g = hexdec(substr($richyellow_code, 3, 2))-25;
    $richyellow_b = hexdec(substr($richyellow_code, 5, 2))-25;
    $richyellow_sdw = 'rgba(' . $richyellow_r . ', ' . $richyellow_g . ', ' . $richyellow_b . ', 1)';

    $richpink_code = $richpink;
    $richpink_r = hexdec(substr($richpink_code, 1, 2))-25;
    $richpink_g = hexdec(substr($richpink_code, 3, 2))-25;
    $richpink_b = hexdec(substr($richpink_code, 5, 2))-25;
    $richpink_sdw = 'rgba(' . $richpink_r . ', ' . $richpink_g . ', ' . $richpink_b . ', 1)';

    $richorange_code = $richorange;
    $richorange_r = hexdec(substr($richorange_code, 1, 2))-25;
    $richorange_g = hexdec(substr($richorange_code, 3, 2))-25;
    $richorange_b = hexdec(substr($richorange_code, 5, 2))-25;
    $richorange_sdw = 'rgba(' . $richorange_r . ', ' . $richorange_g . ', ' . $richorange_b . ', 1)';

    $richgreen_code = $richgreen;
    $richgreen_r = hexdec(substr($richgreen_code, 1, 2))-25;
    $richgreen_g = hexdec(substr($richgreen_code, 3, 2))-25;
    $richgreen_b = hexdec(substr($richgreen_code, 5, 2))-25;
    $richgreen_sdw = 'rgba(' . $richgreen_r . ', ' . $richgreen_g . ', ' . $richgreen_b . ', 1)';

    $richblue_code = $richblue;
    $richblue_r = hexdec(substr($richblue_code, 1, 2))-25;
    $richblue_g = hexdec(substr($richblue_code, 3, 2))-25;
    $richblue_b = hexdec(substr($richblue_code, 5, 2))-25;
    $richblue_sdw = 'rgba(' . $richblue_r . ', ' . $richblue_g . ', ' . $richblue_b . ', 1)';

    $pc_fontsize = get_theme_mod('stk_basefontsize_pc', '103%');
    $sp_fontsize = get_theme_mod('stk_basefontsize_sp', '103%');

    $stk_basefontfamily = get_theme_mod('stk_basefontfamily', 'default');
    if ($stk_basefontfamily == 'notojp') {
        wp_enqueue_style('base_font', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap');
        $fontfamily = '"Noto Sans JP", "Hiragino Kaku Gothic ProN", "Meiryo", sans-serif';
    } elseif ($stk_basefontfamily == 'bizud') {
        wp_enqueue_style('base_font', 'https://fonts.googleapis.com/css2?family=BIZ+UDPGothic:wght@400;700&display=swap');
        $fontfamily = '"BIZ UDPGothic", "Hiragino Kaku Gothic ProN", "Meiryo", sans-serif';
    } elseif ($stk_basefontfamily == 'hiragino') {
        $fontfamily = '"Helvetica Neue", "Helvetica", "Hiragino Sans", "Hiragino Kaku Gothic ProN", "Meiryo", sans-serif';
    } elseif ($stk_basefontfamily == 'yumincyo') {
        $fontfamily = '"Hiragino Mincho ProN", "Yu Mincho", "MS PMincho", serif';
    } else {
        $fontfamily = '"游ゴシック", "Yu Gothic", "游ゴシック体", "YuGothic", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif';
    }
    $fontAwesomeFree = get_option('stk_fontawesome_ver', '6') === '6' ? '"Font Awesome 6 Free"' : '"Font Awesome 5 Free"';
    $fontAwesomeBrand = get_option('stk_fontawesome_ver', '6') === '6' ? '"Font Awesome 6 Brands"' : '"Font Awesome 5 Brands"';

    $fa_v = get_option('stk_fontawesome_ver', '6') === '6' ? '6' : '5';

    $thumbsizeratio = get_option('stk_thumbnail_size_ratio', '62.5');
    if ($thumbsizeratio == '100') {
        $aspect_ratio = '1 / 1';
    } elseif ($thumbsizeratio == '56.2') {
        $aspect_ratio = '16 / 9';
    } elseif ($thumbsizeratio == '74.8') {
        $aspect_ratio = '4 / 3';
    } elseif ($thumbsizeratio == '66.7') {
        $aspect_ratio = '3 / 2';
    } else {
        $aspect_ratio = '16 / 10';
    }

    $stk_line_height = get_theme_mod('stk_line_height_value', '1.8');
    $stk_heading_margin_top = get_theme_mod('stk_heading_margin_top_value', '2').'em';
    $stk_heading_margin_bottom = get_theme_mod('stk_heading_margin_bottom_value', '1').'em';
    $stk_margin = get_theme_mod('stk_margin_value', '1.6').'em';

    $stk_list_icon_size = get_theme_mod('stk_line_height_value', '1.8').'em';
    $stk_list_item_margin = get_theme_mod('stk_list_item_margin_value', '0.7').'em';
    $stk_list_margin = get_theme_mod('stk_list_margin_value', '1').'em';

    $h2_border_radius = get_theme_mod('stk_h2_border_radius', '3').'px';
    $h2_border_width = get_theme_mod('stk_h2_border_width', '4').'px';
    $h3_border_width = get_theme_mod('stk_h3_border_width', '4').'px';
    $h4_border_width = get_theme_mod('stk_h4_border_width', '4').'px';

    $wttl_border_radius = get_theme_mod('stk_widget_ttl_border_radius', '0').'px';
    $wttl_border_width = get_theme_mod('stk_widget_ttl_border_width', '2').'px';

    $sup_border_radius = get_theme_mod('stk_supplement_border_radius', '4').'px';
    $sup_border_width = get_theme_mod('stk_supplement_border_width', '2').'px';
    $sup_border_sat = get_option('stk_supplement_border_hsl')==1 ? '45%' : '82%';
    $sup_border_lig = get_option('stk_supplement_border_hsl')==1 ? '45%' : '86%';

    $box_border_radius = get_theme_mod('stk_box_border_radius', '4').'px';
    $box_border_width = get_theme_mod('stk_box_border_width', '2').'px';

    $btn_border_radius = get_theme_mod('stk_btn_border_radius', '3').'px';
    $btn_border_width = get_theme_mod('stk_btn_border_width', '2').'px';

    $post_radius = get_option('eyecatch_border_radius') ? '8px' : '0';
    $postlist_radius = get_option('eyecatch_border_radius') ? '4px' : '0';
    $cardlist_radius = get_option('eyecatch_border_radius') ? '12px' : '0';

    // メイン領域の横幅
    $mainwidth = get_option('stk_mainwidth_option', '728px');
    // サイドバーウィジェット設置なし且つデフォルトテンプレートの場合のレイアウト
    $flexstyle = !is_page_template() && !is_active_sidebar('sidebar1') && !is_active_sidebar('side-fixed') ? 'center' : 'flex-start';

$tag = <<< EOM

:root {
    --stk-base-font-family: $fontfamily;
    --stk-base-font-size-pc: $pc_fontsize;
    --stk-base-font-size-sp: $sp_fontsize;

    --stk-font-weight: 400;
    
    --stk-font-awesome-free: $fontAwesomeFree;
    --stk-font-awesome-brand: $fontAwesomeBrand;

    --wp--preset--font-size--medium: clamp(1.2em, 2.5vw, 20px);
    --wp--preset--font-size--large: clamp(1.5em, 4.5vw, 36px);
    --wp--preset--font-size--x-large: clamp(1.9em, 5.25vw, 42px);
    --wp--style--gallery-gap-default:0.5em;

    --stk-flex-style: $flexstyle;
    --stk-wrap-width: 1166px;
    --stk-wide-width: 980px;
    --stk-main-width: $mainwidth;
    --stk-side-margin: 32px;

    --stk-post-thumb-ratio: $aspect_ratio;

    --stk-post-title-font_size: clamp(1.4em,4vw,1.9em);
    --stk-h1-font_size: clamp(1.4em, 4vw, 1.9em);
    --stk-h2-font_size: clamp(1.2em, 2.6vw, 1.3em);
    --stk-h2-normal-font_size: 125%;
    --stk-h3-font_size: clamp(1.1em, 2.3vw, 1.15em);
    --stk-h4-font_size: 105%;
    --stk-h5-font_size: 100%;

    --stk-line_height: $stk_line_height;
    --stk-heading-line_height: 1.5;
    --stk-heading-margin_top: $stk_heading_margin_top;
    --stk-heading-margin_bottom: $stk_heading_margin_bottom;
    --stk-margin: $stk_margin;
    --stk-h2-margin-rl: -2vw;
    --stk-el-margin-rl: -4vw;

    --stk-list-icon-size: $stk_list_icon_size;
    --stk-list-item-margin: $stk_list_item_margin;
    --stk-list-margin: $stk_list_margin;

    --stk-h2-border_radius: $h2_border_radius;
    --stk-h2-border_width: $h2_border_width;
    --stk-h3-border_width: $h3_border_width;
    --stk-h4-border_width: $h4_border_width;

    --stk-wttl-border_radius: $wttl_border_radius;
    --stk-wttl-border_width: $wttl_border_width;

    --stk-supplement-border_radius: $sup_border_radius;
    --stk-supplement-border_width: $sup_border_width;
    --stk-supplement-sat: $sup_border_sat;
    --stk-supplement-lig: $sup_border_lig;
    
    --stk-box-border_radius: $box_border_radius;
    --stk-box-border_width: $box_border_width;

    --stk-btn-border_radius: $btn_border_radius;
    --stk-btn-border_width: $btn_border_width;

    --stk-post-radius: $post_radius;
    --stk-postlist-radius: $postlist_radius;
    --stk-cardlist-radius: $cardlist_radius;

    --stk-shadow-s: 1px 2px 10px rgba(0,0,0,0.2);
    --stk-shadow-l: 5px 10px 20px rgba(0,0,0,0.2);

    --main-text-color: $maintext;
    --main-link-color: $mainlink;
    --main-link-color-hover: $mainlinkhover;

    --main-ttl-bg: $mainttlbg;
    --main-ttl-bg-rgba: $mainttlbg_rgb;
    --main-ttl-color: $mainttltext;

    --header-bg: $headerbg;
    --header-bg-overlay: $stk_headercolor;
    --header-logo-color: $headerlogo;
    --header-text-color: $headertext;

    --inner-content-bg: $contentbg;

    --label-bg: $labelbg;
    --label-text-color: $labeltext;

    --slider-text-color: $slidertext;
    --side-text-color: $sidetext;
    --footer-bg: $footerbg;
    --footer-text-color: $footertext;
    --footer-link-color: $footerlink;

    --new-mark-bg: $newmarkbg;

    --oc-box-blue: $boxblue;
    --oc-box-blue-inner: $boxblue_inner;
    --oc-box-red: $boxred;
    --oc-box-red-inner: $boxred_inner;
    --oc-box-yellow: $boxyellow;
    --oc-box-yellow-inner: $boxyellow_inner;
    --oc-box-green: $boxgreen;
    --oc-box-green-inner: $boxgreen_inner;
    --oc-box-pink: $boxpink;
    --oc-box-pink-inner: $boxpink_inner;
    --oc-box-gray: #9c9c9c;
    --oc-box-gray-inner: #f5f5f5;
    --oc-box-black: #313131;
    --oc-box-black-inner: #404040;

    --oc-btn-rich_yellow: $richyellow;
    --oc-btn-rich_yellow-sdw: $richyellow_sdw;
    --oc-btn-rich_pink: $richpink;
    --oc-btn-rich_pink-sdw: $richpink_sdw;
    --oc-btn-rich_orange: $richorange;
    --oc-btn-rich_orange-sdw: $richorange_sdw;
    --oc-btn-rich_green: $richgreen;
    --oc-btn-rich_green-sdw: $richgreen_sdw;
    --oc-btn-rich_blue: $richblue;
    --oc-btn-rich_blue-sdw: $richblue_sdw;

    --oc-base-border-color: rgba(125, 125, 125, 0.3);

    --oc-has-background-basic-padding: 1.1em;

    --stk-maker-yellow: #ff6;
    --stk-maker-pink: #ffd5d5;
    --stk-maker-blue: #b5dfff;
    --stk-maker-green: #cff7c7;

    --stk-caption-font-size: 11px;

    --stk-palette-color1: $palettecolor1;
    --stk-palette-color2: $palettecolor2;
    --stk-palette-color3: $palettecolor3;
    --stk-palette-color4: $palettecolor4;
    --stk-palette-color5: $palettecolor5;
    --stk-palette-color6: $palettecolor6;
    --stk-palette-color7: $palettecolor7;
    --stk-palette-color8: $palettecolor8;
    --stk-palette-color9: $palettecolor9;
    --stk-palette-color10: $palettecolor10;

    --stk-editor-color1: $editorcolor1;
    --stk-editor-color2: $editorcolor2;
    --stk-editor-color3: $editorcolor3;
    --stk-editor-color1-rgba: $editorcolor1_rgb;
    --stk-editor-color2-rgba: $editorcolor2_rgb;
    --stk-editor-color3-rgba: $editorcolor3_rgb;
}

EOM;
    $tag = minify_css($tag);
    return $tag;
}

function stk_gf_wp_enqueue_style_set($editor_important = null)
{
    if ($editor_important) {
        $editor_important = '!important';
    }

    $base_font_set = '"游ゴシック", "Yu Gothic", "游ゴシック体", "YuGothic", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif';
    // ウィジェットタイトルにGoogleフォントを適用しない場合
    $notgf = get_option('stk_widget_options_ttlgf') ? ':not(.widgettitle)' : null;
    $notgf_date = get_option('stk_date_format') ? ':not(.time__date)' : null;

    if (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_UbuntuCon") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Ubuntu Condensed", ' . $base_font_set . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } elseif (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_Lora") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css?family=Lora:700&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Lora", serif' . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } elseif (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_Lobster") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css?family=Lobster+Two:ital,wght@0,400;1,700&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Lobster Two", ' . $base_font_set . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } elseif (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_Quicksand") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Quicksand", ' . $base_font_set . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } elseif (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_Roboto") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Roboto", ' . $base_font_set . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } elseif (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_Catamaran") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css2?family=Catamaran:wght@400;800&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Catamaran", ' . $base_font_set . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } elseif (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_StickNoBills") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@400;700&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Stick No Bills", ' . $base_font_set . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } elseif (get_option('side_options_googlefontinclude', 'gf_Concert') == "gf_Concert") {
        wp_enqueue_style('gf_font', 'https://fonts.googleapis.com/css?family=Concert+One&display=swap');
        $data = '.gf'.$notgf.$notgf_date.' {font-family: "Concert One", ' . $base_font_set . $editor_important . ';}';
        wp_add_inline_style('gf_font', $data);
    } else {
        null;
    }
}


// CSS Include

function stk_add_stylesheet()
{
    if (!is_admin()) {

        $theme_ver = wp_get_theme(get_template())->Version;
        $style = get_option('side_options_style_min_css', 'normal') == 'normal' ? 'style' : 'style.min';
        $template_directory = get_template_directory();

        if (get_option('side_options_style_min_css', 'normal') === 'inline') {

            //データベースキャッシュに値を取得
            $data = get_transient('stk_style_css_cache');
            
            // cacheがない場合
            if ($data === false) {

                load_template(ABSPATH . 'wp-admin/includes/file.php');
                global $wp_filesystem;
                if (WP_Filesystem()) {
                    $data = $wp_filesystem->get_contents("{$template_directory}/style.min.css");
                }

                //取得した値をデータベースキャッシュに保存
                set_transient('stk_style_css_cache', $data, 60 * 60 * 4);
            }

            // var_dump($data);

            if($data)
            {
                $handle = 'stk_style';
                $src = false;
                $deps = array();
                wp_register_style($handle, $src, $deps);
                wp_enqueue_style($handle);
                wp_add_inline_style($handle, $data);
            } else {
                wp_enqueue_style('stk_style', get_template_directory_uri() . '/' . $style . '.css', array(), $theme_ver, 'all');
            }
        } else {
            wp_enqueue_style('stk_style', get_template_directory_uri() . '/' . $style . '.css', array(), $theme_ver, 'all');
        }


        // rootセットの読み込み
        wp_add_inline_style('stk_style', stk_theme_css_root_set());

        // グーグルフォントの読み込み
        stk_gf_wp_enqueue_style_set();

        // FontAwesomeの読み込み
        $fa_v = get_option('stk_fontawesome_ver', '6') === '6' ? '6' : '5';
        $fa_v_cdn = get_option('stk_fontawesome_ver', '6') === '6' ? 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' : 'https://use.fontawesome.com/releases/v5.15.4/css/all.css';

        if (get_option('side_options_fontawesomeinclude', 'fonta_cdn') == 'fonta_cdn') {
            wp_enqueue_style('fontawesome', $fa_v_cdn);
        } elseif (get_option('side_options_fontawesomeinclude') == 'fonta_download') {
            wp_enqueue_style('fontawesome', get_theme_file_uri('/css/fa' . $fa_v . '_all.min.css'));
        } else {
            null;
        }
    }
}
add_action('wp_enqueue_scripts', 'stk_add_stylesheet');


add_action('save_post', 'stk_cache_delete_transient'); // post保存時
add_action('customize_register', 'stk_cache_delete_transient'); // カスタマイザーの保存時
add_action('upgrader_process_complete', 'stk_cache_delete_transient', 10, 2 ); // アップデート時
function stk_cache_delete_transient()
{
    if (get_option('side_options_style_min_css', 'normal') !== 'inline') {
        return;
    }
    delete_transient('stk_style_css_cache');
}



if (isset($_GET['sktcachedelete'])) {
    stk_cache_delete_transient();
}
// キャッシュクリアボタン（adminバー）
if (get_option('side_options_style_min_css', 'normal') === 'inline') 
{
    function add_stk_cache_admin_bar($wp_admin_bar)
    {
        // 1st menu
        $wp_admin_bar->add_menu(array(
            'id'    => 'stk-cache',
            'title' => '<span class="ab-icon" aria-hidden="true"></span> STORK19キャッシュ',
        ));
        //　2nd　sab menu
        $wp_admin_bar->add_menu(array(
            'parent' => 'stk-cache',
            'id'     => 'stk-cache-delete',
            'title'  => 'CSSキャッシュを削除',
            'href'    => 'index.php?sktcachedelete=true'
        ));
    }
    add_action('admin_bar_menu', 'add_stk_cache_admin_bar', 999);
}

//inline cssを読み込み
require_once('inline-style-onecolumn.php');
require_once('inline-style-plugin.php');
require_once('inline-style-amp.php');
require_once('inline-style-flat.php');

// jquery_migrateを読み込まないようにする
add_filter('wp_default_scripts', 'dequeue_jquery_migrate');
function dequeue_jquery_migrate($scripts)
{
    if (is_admin() || get_option('side_options_jquery_migrate', 'on') == 'on') {
        return $scripts;
    }

    $scripts->remove('jquery');
    $scripts->add('jquery', false, array('jquery-core'));
}

// SCRIPTS Include
add_action('wp_enqueue_scripts', 'stk_add_script');
function stk_add_script()
{
    if (is_admin()) {
        return;
    }

    $side_options_cdn_jquery_include = get_option('side_options_cdn_jquery_include', 'off');
    if ($side_options_cdn_jquery_include !== 'off' && !stk_is_amp()) {

        $jquery_ver = $side_options_cdn_jquery_include === 'on_3' ? "3.6.1" : "1.12.4";

        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/' . $jquery_ver . '/jquery.min.js', array(), $jquery_ver, false);
    }


    if (!stk_is_amp()) {
        wp_enqueue_script('remodal-js', get_theme_file_uri('/js/remodal.min.js'), array('jquery'), '1.1.1', true);
        wp_enqueue_script('main-js', get_theme_file_uri('/js/scripts.js'), array('jquery'), '', true);
    }
}

// Child Category Accordion
function stk_cat_accordion()
{
    if (stk_is_amp()) {
        return;
    }
    if ((get_option('side_options_cataccordion', 'accordion_on') == "accordion_on")) {
        $data = '
	jQuery(function($) {
		$(".widget_categories li, .widget_nav_menu li").has("ul").toggleClass("accordionMenu");
		$(".widget ul.children , .widget ul.sub-menu").after("<span class=\'accordionBtn\'></span>");
		$(".widget ul.children , .widget ul.sub-menu").hide();
		$("ul .accordionBtn").on("click", function() {
			$(this).prev("ul").slideToggle();
			$(this).toggleClass("active");
		});
	});';

        // echo minify_js($data);
        wp_add_inline_script('jquery', minify_js($data));
    }
}
add_action('wp_enqueue_scripts', 'stk_cat_accordion');


// Custom Properties polyfil
add_action('wp_head', 'stk_ie11_Custom_Properties', 99);
function stk_ie11_Custom_Properties()
{
    global $is_IE;
    if (!$is_IE) {
        return;
    }
    $output = <<<EOT
	<script>window.MSInputMethodContext && document.documentMode && document.write('<script src="https://cdn.jsdelivr.net/gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.min.js"><\/script>');</script>
EOT;
    echo $output;
}


// Add AMP implementation of what is in scripts.js.
add_filter(
    'amp_content_sanitizers',
    function ($sanitizers) {
        require_once __DIR__ . '/class-amp-link-img-no-icon-class-sanitizer.php';
        $sanitizers['AMP_Link_Img_No_Icon_Class_Sanitizer'] = [];
        return $sanitizers;
    }
);

// JavaScript add defer
if (get_option('advanced_js_defer', 'off') == 'on') {
    add_filter('script_loader_tag', 'add_defer_to_enqueue_script', 10, 2);
    function add_defer_to_enqueue_script($tag, $handle)
    {
        if (is_admin() || is_customize_preview() || stk_is_amp()) {
            return $tag;
        }
        if (false === strpos($tag, '.js') || false !== strpos($tag, 'polyfill')) {
            return $tag;
        }
        if ($handle == 'jquery-core' || $handle == 'jquery') {
            return $tag;
        }
        return str_replace(' src=', ' defer charset=\'UTF-8\' src=', $tag);
    }
}

// searchフォーカス
function search_focus_add_scripts()
{
    if (get_option('side_options_header_search2', 'search_on') !== 'search_on' || is_page_template('page-lp.php')) {
        return;
    }
    $data = <<<EOT
	(function () {
	  if(document.getElementById('navbtn_search_content') != null) {

		var btn = document.querySelectorAll('.search_btn');
		const input = document.getElementById('navbtn_search_content').getElementsByClassName('searchform_input');
        
        btn.forEach(function(target) {

            target.addEventListener("click", function () {
            setTimeout(function () {
                input[0].focus();
            }, 10);
            }, false);
        });
	  }
	})();
EOT;
    wp_add_inline_script('remodal-js', minify_js($data));
}
add_action('wp_enqueue_scripts', 'search_focus_add_scripts');


function stk_wow_fadein_scripts()
{
    $wow_fadein_scripts = <<<EOT
    <script id="stk-script-wow_fadein">
	(function () {
        // フェードインアニメーションのために要素を監視する
        const fadeinTarget1 = document.querySelectorAll('.stk-wow-fadeIn');
        const fadeinTarget2 = document.querySelectorAll('.stk-wow-fadeInUp');
        const fadeinTarget3 = document.querySelectorAll('.stk-wow-fadeInDown');
        const fadeinTarget4 = document.querySelectorAll('.stk-wow-fadeInRight');
        const fadeinTarget5 = document.querySelectorAll('.stk-wow-fadeInLeft');
        
        const options = {
            root: null,
            rootMargin: '-50px 0px -130px',
            threshold: 0
        };
        const fadeinObserver = new IntersectionObserver(addFadeInSelectorFunc, options);
        // それぞれのtargetを監視
        fadeinTarget1.forEach(box => {
            fadeinObserver.observe(box);
        });
        fadeinTarget2.forEach(box => {
            fadeinObserver.observe(box);
        });
        fadeinTarget3.forEach(box => {
            fadeinObserver.observe(box);
        });
        fadeinTarget4.forEach(box => {
            fadeinObserver.observe(box);
        });
        fadeinTarget5.forEach(box => {
            fadeinObserver.observe(box);
        });
        
        // 発火した時に動かす関数
        function addFadeInSelectorFunc(entries) {
            // isIntersectingがtrueの場合にDOM操作
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                // entry.target.classList.add('animated')
                    entry.target.dataset.animated = 'animated'
                // } else {
                // 	entry.target.dataset.animated = 'false'
                }
            });
        }
    })();
    </script>
EOT;
    $wow_fadein_scripts = minify_js( $wow_fadein_scripts );
    echo minify_js($wow_fadein_scripts);
}
add_action('wp_footer', 'stk_wow_fadein_scripts');
