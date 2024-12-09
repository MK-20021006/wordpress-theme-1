<?php

if (!defined('ABSPATH')) {
	exit;
}

// colors
function opencage_colors_customizer($wp_customize) {
    $wp_customize->add_section( 'colors', array(
    'title' => __( 'サイトカラー設定', 'opencage' ),
    'priority' => 5,
    ));

	// ヘッダー
	$wp_customize->add_setting('opencage_color_headerbg', array('default' => '#1bb4d3',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_headerbg', array(
		'label' => __('ヘッダー背景', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_headerbg',
	)));

	$wp_customize->add_setting('opencage_color_headerlogo', array('default' => '#eeee22',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_headerlogo', array(
		'label' => __('サイトタイトル', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_headerlogo',
	)));

	$wp_customize->add_setting('opencage_color_headertext', array('default' => '#edf9fc',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_headertext', array(
		'label' => __('ヘッダーテキスト', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_headertext',
	)));

	// コンテンツ
	$wp_customize->add_setting('opencage_color_contentbg', array('default' => '#ffffff',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_contentbg', array(
		'label' => __('コンテンツ背景', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_contentbg',
	)));

	$wp_customize->add_setting('opencage_color_maintext', array('default' => '#3E3E3E',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_maintext', array(
		'label' => __('メインテキスト', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_maintext',
	)));

	$wp_customize->add_setting('opencage_color_mainlink', array('default' => '#1bb4d3',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_mainlink', array(
		'label' => __('リンク', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_mainlink',
	)));

	$wp_customize->add_setting('opencage_color_mainlink_hover', array('default' => '#E69B9B',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_mainlink_hover', array(
		'label' => __('リンク（マウスオン）', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_mainlink_hover',
	)));

	$wp_customize->add_setting('opencage_color_sidetext', array('default' => '#3e3e3e',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_sidetext', array(
		'label' => __('サイドバーテキスト', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_sidetext',
	)));

	// フッター
	$wp_customize->add_setting('opencage_color_footerbg', array('default' => '#666666',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_footerbg', array(
		'label' => __('フッター背景', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_footerbg',
	)));

	$wp_customize->add_setting('opencage_color_footertext', array('default' => '#CACACA',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_footertext', array(
		'label' => __('フッターテキスト', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_footertext',
	)));

	$wp_customize->add_setting('opencage_color_footerlink', array('default' => '#f7f7f7',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_footerlink', array(
		'label' => __('フッターリンク', 'opencage'),
		'section' => 'colors',
		'settings' => 'opencage_color_footerlink',
	)));
}
add_action('customize_register', 'opencage_colors_customizer');


function stk_customize_css_admin_classiceditor($mceInit)
{
	$styles = '.mce-content-body.editor-area { color: ' . get_theme_mod('opencage_color_maintext', '#3E3E3E') . '}';
	$styles .= '.mce-content-body.editor-area,.mce-content-body.editor-area blockquote:before,.mce-content-body.editor-area blockquote:after,.editor-styles-wrapper .mce-content-body blockquote:before,.editor-styles-wrapper .mce-content-body blockquote:after { background-color: ' . get_theme_mod('opencage_color_contentbg', '#ffffff') . '}';
	$styles .= '.mce-content-body.editor-area a { color: ' . get_theme_mod('opencage_color_mainlink', '#1bb4d3') . '}';
	$styles .= '.mce-content-body.editor-area h2,.mce-content-body.editor-area ol li:before { background-color: ' . get_theme_mod('opencage_color_ttlbg', '#1bb4d3') . '}';
	$styles .= '.mce-content-body.editor-area ol li:before { border-color: ' . get_theme_mod('opencage_color_ttlbg', '#1bb4d3') . '}';
	$styles .= '.mce-content-body.editor-area h2,.mce-content-body.editor-area ol li:before { color: ' . get_theme_mod('opencage_color_ttltext', '#ffffff') . '}';
	$styles .= '.mce-content-body.editor-area h3,.mce-content-body.editor-area h4 { border-color: ' . get_theme_mod('opencage_color_ttlbg', '#1bb4d3') . '}';
	$styles .= '.mce-content-body.editor-area ul li:before { color: ' . get_theme_mod('opencage_color_ttlbg', '#1bb4d3') . '}';
	$styles .= '.mce-content-body.editor-area .btn-wrap:not(.simple):not(.rich_yellow):not(.rich_pink):not(.rich_orange):not(.rich_green):not(.rich_blue) a { background-color: ' . get_theme_mod('opencage_color_mainlink', '#1bb4d3') . '}';
	$styles .= '.mce-content-body.editor-area .btn-wrap:not(.rich_yellow):not(.rich_pink):not(.rich_orange):not(.rich_green):not(.rich_blue) a, .mce-content-body.editor-area .btn-wrap.simple { border-color: ' . get_theme_mod('opencage_color_mainlink', '#1bb4d3') . '}';
	if (isset($mceInit['content_style'])) {
		$mceInit['content_style'] .= ' ' . $styles . ' ';
	} else {
		$mceInit['content_style'] = $styles . ' ';
	}
	return $mceInit;
}
add_filter('tiny_mce_before_init', 'stk_customize_css_admin_classiceditor');
