<?php

if (!defined('ABSPATH')) {
	exit;
}

// editor settings
function opencage_blockeditor_customizer($wp_customize)
{
	$wp_customize->add_panel(
		'blockeditor_settings',
		array(
			'title' => 'ブロックエディタ設定',
			'priority' => 30,
		)
	);

	// ---------------------------------------------
    // パネル

	$wp_customize->add_section('blockeditor_settings__colorpalette', array(
        'title' => 'カラーパレット',
        'panel' => 'blockeditor_settings',
        'description' => 'エディタで使用できるカラーパレットの色を変更できます。',
    ));
	$wp_customize->add_section('blockeditor_settings__other', array(
        'title' => 'その他の設定',
        'panel' => 'blockeditor_settings',
    ));

	// ---------------------------------------------
	// カラーパレット

	$wp_customize->add_setting('stk_palette_color1', array('default' => '#abb8c3'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color1', array(
		'label' => 'カラー1',
		'settings' => 'stk_palette_color1',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color2', array('default' => '#f78da7'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color2', array(
		'label' => 'カラー2',
		'settings' => 'stk_palette_color2',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color3', array('default' => '#cf2e2e'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color3', array(
		'label' => 'カラー3',
		'settings' => 'stk_palette_color3',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color4', array('default' => '#ff6900'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color4', array(
		'label' => 'カラー4',
		'settings' => 'stk_palette_color4',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color5', array('default' => '#fcb900'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color5', array(
		'label' => 'カラー5',
		'settings' => 'stk_palette_color5',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color6', array('default' => '#7bdcb5'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color6', array(
		'label' => 'カラー6',
		'settings' => 'stk_palette_color6',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color7', array('default' => '#00d084'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color7', array(
		'label' => 'カラー7',
		'settings' => 'stk_palette_color7',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color8', array('default' => '#8ed1fc'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color8', array(
		'label' => 'カラー8',
		'settings' => 'stk_palette_color8',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color9', array('default' => '#0693e3'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color9', array(
		'label' => 'カラー9',
		'settings' => 'stk_palette_color9',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_palette_color10', array('default' => '#9b51e0'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_palette_color10', array(
		'label' => 'カラー10',
		'settings' => 'stk_palette_color10',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	// ユーザーカラー
	$wp_customize->add_setting('stk_editor_color1', array('default' => '#1bb4d3'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_editor_color1', array(
		'label' => 'ユーザーカラー1',
		'settings' => 'stk_editor_color1',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_editor_color2', array('default' => '#f55e5e'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_editor_color2', array(
		'label' => 'ユーザーカラー2',
		'settings' => 'stk_editor_color2',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	$wp_customize->add_setting('stk_editor_color3', array('default' => '#eeee22'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'stk_editor_color3', array(
		'label' => 'ユーザーカラー3',
		'settings' => 'stk_editor_color3',
		'section' => 'blockeditor_settings__colorpalette',
	)));

	// ---------------------------------------------
	// その他の設定

	$wp_customize->add_setting('side_options_stork_block_pattern', array(
		'type'  => 'option',
		'default' => 'on',
	));
	$wp_customize->add_control('side_options_stork_block_pattern', array(
		'settings' => 'side_options_stork_block_pattern',
		'label' => 'STORK19専用パターンの読み込み',
		//'description' => 'STORK19専用パターンの読み込み設定',
		'section' => 'blockeditor_settings__other',
		'type' => 'select',
		'choices' => array(
			'on' => '読み込む（推奨）',
			'off' => '読み込まない',
		),
	));

	$wp_customize->add_setting('side_options_unregister_block_pattern', array(
		'type'  => 'option',
		'default' => 'off',
	));
	$wp_customize->add_control('side_options_unregister_block_pattern', array(
		'settings' => 'side_options_unregister_block_pattern',
		'label' => 'WPデフォルトパターンの読み込み',
		//'description' => 'WordPressデフォルトパターンの読み込み設定',
		'section' => 'blockeditor_settings__other',
		'type' => 'select',
		'choices' => array(
			'on' => '読み込む',
			'off' => '読み込まない（推奨）',
		),
	));

	// マイセット登録パネルの無効化
	$wp_customize->add_setting('block_options_mysetinvalid', array(
		'type'  => 'option',
		'default' => 'myset_invalid',
	));
	$wp_customize->add_control('block_options_mysetinvalid', array(
		'settings' => 'block_options_mysetinvalid',
		'label' => '吹き出しマイセット登録パネル',
		'description' => '吹き出しブロックのマイセット登録(β版)パネルを非表示にします。※吹き出しブロックでエラーが生じる場合は非表示にしてください。',
		'section' => 'blockeditor_settings__other',
		'type' => 'select',
		'choices' => array(
			'myset_display' => '表示',
			'myset_invalid' => '非表示',
		),
	));
}
add_action('customize_register', 'opencage_blockeditor_customizer');
