<?php

if (!defined('ABSPATH')) {
    exit;
}

// title tagline
function opencage_title_tagline_customizer($wp_customize)
{
    $wp_customize->add_section('title_tagline', array(
        'title'          => 'サイト基本情報・ロゴ',
        'priority'       => 0,
        'description' => '',
    ));

    // ---------------------------------------------
    // セレクターショートカット

    $wp_customize->selective_refresh->add_partial(
        'custom_logo',
        array(
            'selector' => '.site__logo__title',
        )
    );

    // ---------------------------------------------
    // サイト基本情報・ロゴ

    $wp_customize->add_setting('opencage_site_description', array(
        'type'  => 'option',
        'default' => 'sitedes_off',
    ));
    $wp_customize->add_control('opencage_site_description', array(
        'settings' => 'opencage_site_description',
        'label' => 'キャッチフレーズの表示',
        'section' => 'title_tagline',
        'type' => 'radio',
        'choices' => array(
            'sitedes_on' => '表示する',
            'sitedes_off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('opencage_logo_size', array(
        'type'  => 'option',
        'default' => 'fs_m',
    ));
    $wp_customize->add_control('opencage_logo_size', array(
        'settings' => 'opencage_logo_size',
        'label' => 'サイトタイトルのサイズ',
        'description' => 'サイトタイトル（テキストおよびロゴ画像）のサイズを変更できます。',
        'section' => 'title_tagline',
        'type' => 'select',
        'choices' => array(
            'fs_ss' => 'SS',
            'fs_s' => 'S',
            'fs_m' => 'M（デフォルト）',
            'fs_l' => 'L',
            'fs_ll' => 'LL',
            'fs_custom' => 'カスタムサイズ',
        ),
    ));

    $wp_customize->add_setting('opencage_logo_size_custom_pc', array(
        'type'  => 'option',
        'default' => '30',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('opencage_logo_size_custom_pc', array(
        'settings' => 'opencage_logo_size_custom_pc',
        'label' => 'カスタムサイズ（PC用）',
        'description' => 'サイトタイトルの大きさをpx単位で指定できます。<br>※ロゴ画像の場合は最大の高さ',
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '2',
            'max'      => '500',
        ),
        'active_callback'    => 'callback_oc_customlogosize',
    ));

    $wp_customize->add_setting('opencage_logo_size_custom_pc_margin', array(
        'type'  => 'option',
        'default' => '5',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('opencage_logo_size_custom_pc_margin', array(
        'settings' => 'opencage_logo_size_custom_pc_margin',
        'label' => 'サイトタイトル上下の余白（PC用）',
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '500',
        ),
        'active_callback'    => 'callback_oc_customlogosize',
    ));

    $wp_customize->add_setting('opencage_logo_size_custom_sp', array(
        'type'  => 'option',
        'default' => '25',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('opencage_logo_size_custom_sp', array(
        'settings' => 'opencage_logo_size_custom_sp',
        'label' => 'カスタムサイズ（モバイル用）',
        'description' => 'サイトタイトルの大きさをpx単位で指定できます。<br>※ロゴ画像の場合は最大の高さ',
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '2',
            'max'      => '500',
        ),
        'active_callback'    => 'callback_oc_customlogosize',
    ));

    $wp_customize->add_setting('opencage_logo_size_custom_sp_margin', array(
        'type'  => 'option',
        'default' => '5',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('opencage_logo_size_custom_sp_margin', array(
        'settings' => 'opencage_logo_size_custom_sp_margin',
        'label' => 'サイトタイトル上下の余白（モバイル用）',
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '0',
            'max'      => '500',
        ),
        'active_callback'    => 'callback_oc_customlogosize',
    ));

    // カスタムフォントサイズの active_callback関数
    function callback_oc_customlogosize($control)
    {
        if ($control->manager->get_setting('opencage_logo_size')->value() == 'fs_custom') {
            return true;
        } else {
            return false;
        }
    }
    $wp_customize->add_setting('opencage_logo_gf', array(
        'type'  => 'option',
        'default' => 'off',
    ));
    $wp_customize->add_control('opencage_logo_gf', array(
        'settings' => 'opencage_logo_gf',
        'label' => 'サイトタイトルのフォント',
        'section' => 'title_tagline',
        'type' => 'radio',
        'choices' => array(
            'off' => 'ベースフォント',
            'on' => 'Googleフォント(欧文)を適用する',
        ),
    ));

    $wp_customize->add_setting('stk_copyright_text', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_copyright_text', array(
        'settings' => 'stk_copyright_text',
        'label' => 'コピーライト',
        'description' => '&copy;以降の表記を書き換えることができます。',
        'section' => 'title_tagline',
    ));

    $wp_customize->add_setting('stk_currentyear_none', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_currentyear_none', array(
        'settings' => 'stk_currentyear_none',
        'label' => 'コピーライトに現在の西暦を表記しない',
        'section' => 'title_tagline',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'opencage_title_tagline_customizer');
