<?php

if (!defined('ABSPATH')) {
    exit;
}

// sanitize
function sanitize_stk_line_height_range( $number, $setting ) {
    $number = floatval( $number );
    $number = max( 1.5, min( 2.0, $number ) );
    return $number;
}

function sanitize_stk_heading_margin_top_range( $number, $setting ) {
    $number = floatval( $number );
    $number = max( 1, min( 4, $number ) );
    return $number;
}

function sanitize_stk_heading_margin_bottom_range( $number, $setting ) {
    $number = floatval( $number );
    $number = max( 1, min( 2, $number ) );
    return $number;
}

function sanitize_stk_margin_range( $number, $setting ) {
    // 浮動小数点数に変換
    $number = floatval( $number );
    $number = max( 1, min( 3, $number ) );
    return $number;
}

function sanitize_stk_list_item_margin_range( $number, $setting ) {
    $number = floatval( $number );
    $number = max( 0, min( 3, $number ) );
    return $number;
}

// detail settings
function opencage_detail_customizer($wp_customize)
{
    $wp_customize->add_panel(
        'detail_settings',
        array(
            'title' => '詳細なカスタマイズ',
            'priority' => 35,
        )
    );

    // ---------------------------------------------
    // パネル
    
    $wp_customize->add_section('detail_settings__margin', array(
        'title' => '行間とマージンの調節',
        'panel' => 'detail_settings',
        'description' => 'テキスト要素の行間と間隔（マージン）を調節できます。',
    ));
    $wp_customize->add_section('detail_settings__heading', array(
        'title' => '見出しデザインの調節',
        'panel' => 'detail_settings',
        'description' => '見出しの角丸や線幅を調節できます。',
    ));
    $wp_customize->add_section('detail_settings__other', array(
        'title' => 'その他デザインの調節',
        'panel' => 'detail_settings',
        'description' => 'ブロックやショートコードで表示する装飾パーツの角丸や線幅を調節できます。',
    ));
    $wp_customize->add_section('detail_settings__defaultcolor', array(
        'title' => '色のデフォルト設定',
        'panel' => 'detail_settings',
        'description' => 'ボックスやボタンのデフォルトカラーを変更できます。',
    ));

    // ---------------------------------------------
    // 行間とマージンの調節

    $wp_customize->add_setting('stk_line_height_value', array(
        'default' => '1.8',
        'sanitize_callback' => 'sanitize_stk_line_height_range',
    ));
    $wp_customize->add_control('stk_line_height_value', array(
        'settings' => 'stk_line_height_value',
        'label' => '文章の行間',
        'description' => '段落などの文章の行間を調節できます。 ※設定可能範囲:1.5〜2.0（<b>デフォルト値:1.8</b>）',
        'section' => 'detail_settings__margin',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '0.1',
            'min'      => '1.5',
            'max'      => '2.0',
        ),
    ));

    $wp_customize->add_setting('stk_margin_value', array(
        'default' => '1.6',
        'sanitize_callback' => 'sanitize_stk_margin_range',
    ));
    $wp_customize->add_control('stk_margin_value', array(
        'settings' => 'stk_margin_value',
        'label' => '段落下のマージン',
        'description' => '段落下のマージン（余白）を調節できます。ここで設定した値はブロックエディタの「上下の余白設定」にも反映されます。 ※設定可能範囲:1.0〜3.0em（<b>デフォルト値:1.6em</b>）',
        'section' => 'detail_settings__margin',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '0.1',
            'min'      => '1',
            'max'      => '3',
        ),
    ));

    $wp_customize->add_setting('stk_heading_margin_top_value', array(
        'default' => '2',
        'sanitize_callback' => 'sanitize_stk_heading_margin_top_range',
    ));
    $wp_customize->add_control('stk_heading_margin_top_value', array(
        'settings' => 'stk_heading_margin_top_value',
        'label' => '見出し上のマージン',
        'description' => '見出し上のマージンを調節できます。 ※設定可能範囲:1.0〜4.0em（<b>デフォルト値:2em</b>）',
        'section' => 'detail_settings__margin',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '0.1',
            'min'      => '1',
            'max'      => '4',
        ),
    ));

    $wp_customize->add_setting('stk_heading_margin_bottom_value', array(
        'default' => '1',
        'sanitize_callback' => 'sanitize_stk_heading_margin_bottom_range',
    ));
    $wp_customize->add_control('stk_heading_margin_bottom_value', array(
        'settings' => 'stk_heading_margin_bottom_value',
        'label' => '見出し下のマージン',
        'description' => '見出し下のマージンを調節できます。 ※設定可能範囲:1.0〜2.0em（<b>デフォルト値:1em</b>）',
        'section' => 'detail_settings__margin',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '0.1',
            'min'      => '1',
            'max'      => '2',
        ),
    ));

    $wp_customize->add_setting('stk_list_item_margin_value', array(
        'default' => '0.7',
        'sanitize_callback' => 'sanitize_stk_list_item_margin_range',
    ));
    $wp_customize->add_control('stk_list_item_margin_value', array(
        'settings' => 'stk_list_item_margin_value',
        'label' => 'リスト項目の間隔（マージン）',
        'description' => '箇条書き/番号付きリスト項目のマージンを調節できます。 ※設定可能範囲:0〜3.0em（<b>デフォルト値:0.7em</b>）',
        'section' => 'detail_settings__margin',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '0.1',
            'min'      => '0',
            'max'      => '3',
        ),
    ));

    $wp_customize->add_setting('stk_list_margin_value', array(
        'default' => '1',
        'sanitize_callback' => 'sanitize_stk_margin_range',
    ));
    $wp_customize->add_control('stk_list_margin_value', array(
        'settings' => 'stk_list_margin_value',
        'label' => 'リスト下のマージン',
        'description' => '箇条書き/番号付きリスト下のマージンを調節できます。 ※設定可能範囲:1.0〜3.0em（<b>デフォルト値:1em</b>）',
        'section' => 'detail_settings__margin',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '0.1',
            'min'      => '1',
            'max'      => '3',
        ),
    ));

    // ---------------------------------------------
    // 見出しデザインの調節

    $wp_customize->add_setting('stk_h2_border_radius', array(
        'default' => '3',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_h2_border_radius', array(
        'settings' => 'stk_h2_border_radius',
        'label' => '見出し2(H2)の角丸',
        'description' => '背景色付きの見出しに適用されます。1〜10pxに設定できます。（デフォルト値:3px）',
        'section' => 'detail_settings__heading',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '10',
        ),
    ));

    $wp_customize->add_setting('stk_h2_border_width', array(
        'default' => '4',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_h2_border_width', array(
        'settings' => 'stk_h2_border_width',
        'label' => '見出し2(H2)の線幅',
        'description' => 'ボーダー系の見出しに適用されます。1〜5pxに設定できます。（デフォルト値:4px）',
        'section' => 'detail_settings__heading',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '1',
            'max'      => '5',
        ),
    ));

    $wp_customize->add_setting('stk_h3_border_width', array(
        'default' => '4',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_h3_border_width', array(
        'settings' => 'stk_h3_border_width',
        'label' => '見出し3(H3)の線幅',
        'description' => '1〜5pxに設定できます。（デフォルト値:4px）',
        'section' => 'detail_settings__heading',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '1',
            'max'      => '5',
        ),
    ));

    $wp_customize->add_setting('stk_h4_border_width', array(
        'default' => '4',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_h4_border_width', array(
        'settings' => 'stk_h4_border_width',
        'label' => '見出し4(H4)の線幅',
        'description' => '1〜5pxに設定できます。（デフォルト値:4px）',
        'section' => 'detail_settings__heading',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '1',
            'max'      => '5',
        ),
    ));

    $wp_customize->add_setting('stk_widget_ttl_border_radius', array(
        'default' => '0',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_widget_ttl_border_radius', array(
        'settings' => 'stk_widget_ttl_border_radius',
        'label' => 'メインサイドバーの見出しの角丸',
        'description' => '背景色付きの見出しに適用されます。1〜10pxに設定できます。（デフォルト値:0）',
        'section' => 'detail_settings__heading',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '10',
        ),
    ));

    $wp_customize->add_setting('stk_widget_ttl_border_width', array(
        'default' => '2',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_widget_ttl_border_width', array(
        'settings' => 'stk_widget_ttl_border_width',
        'label' => 'メインサイドバーの見出しの線幅',
        'description' => 'ボーダー系の見出しに適用されます。1〜5pxに設定できます。（デフォルト値:2px）',
        'section' => 'detail_settings__heading',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '1',
            'max'      => '5',
        ),
    ));

    // ---------------------------------------------
    // その他パーツ

    $wp_customize->add_setting('stk_supplement_border_radius', array(
        'default' => '4',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_supplement_border_radius', array(
        'settings' => 'stk_supplement_border_radius',
        'label' => '補足説明・段落スタイルの角丸',
        'description' => '0〜20pxに設定できます。（デフォルト値:4px）',
        'section' => 'detail_settings__other',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '20',
        ),
    ));

    $wp_customize->add_setting('stk_supplement_border_width', array(
        'default' => '2',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_supplement_border_width', array(
        'settings' => 'stk_supplement_border_width',
        'label' => '補足説明・段落スタイルの線幅',
        'description' => '0〜5pxに設定できます。（デフォルト値:2px）',
        'section' => 'detail_settings__other',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '5',
        ),
    ));
    
    $wp_customize->add_setting('stk_supplement_border_hsl', array(
        'type'  => 'option',
        'default' => false,
    ));
    $wp_customize->add_control('stk_supplement_border_hsl', array(
        'settings' => 'stk_supplement_border_hsl',
        'label' => '補足説明の枠線を目立たせる',
        'section' => 'detail_settings__other',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_box_border_radius', array(
        'default' => '4',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_box_border_radius', array(
        'settings' => 'stk_box_border_radius',
        'label' => 'ボックスの角丸',
        'description' => '0〜20pxに設定できます。（デフォルト値:4px）',
        'section' => 'detail_settings__other',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '20',
        ),
    ));

    $wp_customize->add_setting('stk_box_border_width', array(
        'default' => '2',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_box_border_width', array(
        'settings' => 'stk_box_border_width',
        'label' => 'ボックスの線幅',
        'description' => '1〜5pxに設定できます。（デフォルト値:2px）',
        'section' => 'detail_settings__other',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '1',
            'max'      => '5',
        ),
    ));
    
    $wp_customize->add_setting('stk_btn_border_radius', array(
        'default' => '3',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_btn_border_radius', array(
        'settings' => 'stk_btn_border_radius',
        'label' => 'ボタンの角丸',
        'description' => '0〜50pxに設定できます。（デフォルト値:3px）',
        'section' => 'detail_settings__other',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '50',
        ),
    ));

    $wp_customize->add_setting('stk_btn_border_width', array(
        'default' => '2',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_btn_border_width', array(
        'settings' => 'stk_btn_border_width',
        'label' => 'ボタンの線幅',
        'description' => '1〜5pxに設定できます。（デフォルト値:2px）',
        'section' => 'detail_settings__other',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '5',
        ),
    ));

    // ---------------------------------------------
    // 色のデフォルト設定

    // リッチボタン
    $wp_customize->add_setting('stk_preset_color_richyellow', array('default' => '#f7cf2e',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_richyellow', array(
		'label' => 'リッチイエロー',
        'settings' => 'stk_preset_color_richyellow',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_richpink', array('default' => '#ee5656',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_richpink', array(
		'label' => 'リッチピンク',
        'settings' => 'stk_preset_color_richpink',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_richorange', array('default' => '#ef9b2f',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_richorange', array(
		'label' => 'リッチオレンジ',
        'settings' => 'stk_preset_color_richorange',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_richgreen', array('default' => '#39cd75',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_richgreen', array(
		'label' => 'リッチグリーン',
        'settings' => 'stk_preset_color_richgreen',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_richblue', array('default' => '#19b4ce',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_richblue', array(
		'label' => 'リッチブルー',
        'settings' => 'stk_preset_color_richblue',
		'section' => 'detail_settings__defaultcolor',
	)));

    // ボックス
    $wp_customize->add_setting('stk_preset_color_boxblue', array('default' => '#19b4ce',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxblue', array(
		'label' => 'ブルー：ボーダー',
        'settings' => 'stk_preset_color_boxblue',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxblue_inner', array('default' => '#d4f3ff',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxblue_inner', array(
		'label' => 'ブルー：背景',
        'settings' => 'stk_preset_color_boxblue_inner',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxred', array('default' => '#ee5656',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxred', array(
		'label' => 'レッド：ボーダー',
        'settings' => 'stk_preset_color_boxred',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxred_inner', array('default' => '#feeeed',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxred_inner', array(
		'label' => 'レッド：背景',
        'settings' => 'stk_preset_color_boxred_inner',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxyellow', array('default' => '#f7cf2e',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxyellow', array(
		'label' => 'イエロー：ボーダー',
        'settings' => 'stk_preset_color_boxyellow',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxyellow_inner', array('default' => '#fffae2',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxyellow_inner', array(
		'label' => 'イエロー：背景',
        'settings' => 'stk_preset_color_boxyellow_inner',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxgreen', array('default' => '#39cd75',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxgreen', array(
		'label' => 'グリーン：ボーダー',
        'settings' => 'stk_preset_color_boxgreen',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxgreen_inner', array('default' => '#e8fbf0',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxgreen_inner', array(
		'label' => 'グリーン：背景',
        'settings' => 'stk_preset_color_boxgreen_inner',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxpink', array('default' => '#f7b2b2',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxpink', array(
		'label' => 'ピンク：ボーダー',
        'settings' => 'stk_preset_color_boxpink',
		'section' => 'detail_settings__defaultcolor',
	)));

    $wp_customize->add_setting('stk_preset_color_boxpink_inner', array('default' => '#ffeeee',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stk_preset_color_boxpink_inner', array(
		'label' => 'ピンク：背景',
        'settings' => 'stk_preset_color_boxpink_inner',
		'section' => 'detail_settings__defaultcolor',
	)));
}
add_action('customize_register', 'opencage_detail_customizer');
