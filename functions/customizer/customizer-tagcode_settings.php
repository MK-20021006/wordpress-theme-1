<?php

if (!defined('ABSPATH')) {
    exit;
}

// tag code setteings
function opencage_tagcode_customizer($wp_customize)
{
    $wp_customize->add_panel(
        'tagcode_settings',
        array(
            'title' => '各種タグ・コード設定',
            'priority' => 25,
            
        )
    );

    $wp_customize->add_section('tagcode_settings__analytics', array(
        'title'          => 'Googleアナリティクス',
        'panel' => 'tagcode_settings',
    ));
    $wp_customize->add_section('tagcode_settings__adsense', array(
        'title'          => 'Googleアドセンス',
        'panel' => 'tagcode_settings',
    ));
    $wp_customize->add_section('tagcode_settings__headfoot', array(
        'title'          => 'head / bodyタグ',
        'panel' => 'tagcode_settings',
    ));
    $wp_customize->add_section('amp_tagcode_settings__headfoot', array(
        'title'          => 'head / bodyタグ（AMP用）',
        'panel' => 'tagcode_settings',
        'description' => 'AMP時のみにheadなどに表示されるタグを設定できます。ただし、AMPにて許可された仕様のコードではない場合は自動的に削除される可能性もあります。',
    ));
    $wp_customize->add_section('tagcode_settings__adshortcode', array(
        'title'          => '広告用ショートコードの登録',
        'panel' => 'tagcode_settings',
    ));

    // ---------------------------------------------
    // Google Analytics

    $wp_customize->add_setting('other_options_ga', array(
        'type'  => 'option',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('other_options_ga', array(
        'label' => 'GoogleタグID',
        'description' => 'GoogleタグID（例: G-12345...）を入力してください。<br><a href="https://support.google.com/analytics/answer/9539598" target="_blank">→[GA4]GoogleタグIDを確認する</a><br>※プラグインの機能などで設定する場合は重複しますのでご注意ください。',
        'settings' => 'other_options_ga',
        'section' => 'tagcode_settings__analytics',
        'input_attrs' => array(
            'placeholder' => 'G-xxxxxxxxx'
        ),
    ));

    // AMP用の設定
    if (is_plugin_active_amp()) {
        $wp_customize->add_setting('other_options_ga_amp', array(
            'type'  => 'option',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control('other_options_ga_amp', array(
            'label' => '[AMP用]GoogleAnalytics解析コード',
            'description' => 'AMPプラグインを利用していて、通常のアクセス解析コードと別のものを使いたい場合に入力してください。',
            'settings' => 'other_options_ga_amp',
            'section' => 'tagcode_settings__analytics',
        ));
    }

    // ---------------------------------------------
    // Google AdSense
    
    $wp_customize->add_setting('other_options_adsense', array(
        'type'  => 'option',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
        $wp_customize,
        'other_options_adsense',
        array(
            'label' => 'AdSenseとのリンク',
            'description' => 'ここにAdSenseコードを貼り付けることで、ソースコードの＜head＞＜/head＞内に挿入できます。<br>※広告ユニットコードには対応しておりません。',
            'settings' => 'other_options_adsense',
            'section' => 'tagcode_settings__adsense',
        )
    ));

    // AMP自動広告の設定
    if (is_plugin_active_amp()) {
        $wp_customize->add_setting('stk_amp_autoads_head', array(
            'type'  => 'option',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
            $wp_customize,
            'stk_amp_autoads_head',
            array(
                'label' => '【AMP自動広告】スクリプトコード',
                'description' => '＜head＞タグ内用のスクリプトコードを貼り付けてください。',
                'settings' => 'stk_amp_autoads_head',
                'section' => 'tagcode_settings__adsense',
            )
        ));

        $wp_customize->add_setting('stk_amp_autoads_body', array(
            'type'  => 'option',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
            $wp_customize,
            'stk_amp_autoads_body',
            array(
                'label' => '【AMP自動広告】自動広告コード',
                'description' => '＜body＞タグ直後用の自動広告コードを貼り付けてください。',
                'settings' => 'stk_amp_autoads_body',
                'section' => 'tagcode_settings__adsense',
            )
        ));
    }

    // ---------------------------------------------
    // head・bodyタグ
    
    $wp_customize->add_setting('other_options_headcode', array(
        'type'  => 'option',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
        $wp_customize,
        'other_options_headcode',
        array(
            'label' => '＜head＞タグ内',
            'description' => 'ソースコードの＜head＞＜/head＞内に挿入できます。',
            'settings' => 'other_options_headcode',
            'section' => 'tagcode_settings__headfoot',
        )
    ));

    $wp_customize->add_setting('other_options_bodycode', array(
        'type'  => 'option',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
        $wp_customize,
        'other_options_bodycode',
        array(
            'label' => '＜body＞タグ直後',
            'description' => 'ソースコードの＜body＞直後に挿入できます。',
            'settings' => 'other_options_bodycode',
            'section' => 'tagcode_settings__headfoot',
        )
    ));

    $wp_customize->add_setting('other_options_footercode', array(
        'type'  => 'option',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
        $wp_customize,
        'other_options_footercode',
        array(
            'label' => '＜/body＞タグ直前',
            'description' => 'ソースコードの＜/body＞直前に挿入できます。',
            'settings' => 'other_options_footercode',
            'section' => 'tagcode_settings__headfoot',
        )
    ));

    // AMP用の設定
    if (is_plugin_active_amp()) {
        $wp_customize->add_setting('stk_amp_headcode', array(
            'type'  => 'option',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
            $wp_customize,
            'stk_amp_headcode',
            array(
                'label' => '【AMP用】＜head＞タグ内',
                'description' => '【AMP用】ソースコードの＜head＞＜/head＞内に挿入できます。',
                'settings' => 'stk_amp_headcode',
                'section' => 'amp_tagcode_settings__headfoot',
            )
        ));

        $wp_customize->add_setting('stk_amp_bodycode', array(
            'type'  => 'option',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
            $wp_customize,
            'stk_amp_bodycode',
            array(
                'label' => '【AMP用】＜body＞タグ直後',
                'description' => '【AMP用】ソースコードの＜body＞直後に挿入できます。',
                'settings' => 'stk_amp_bodycode',
                'section' => 'amp_tagcode_settings__headfoot',
            )
        ));

        $wp_customize->add_setting('stk_amp_footercode', array(
            'type'  => 'option',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
            $wp_customize,
            'stk_amp_footercode',
            array(
                'label' => '【AMP用】＜/body＞タグ直前',
                'description' => '【AMP用】ソースコードの＜/body＞直前に挿入できます。',
                'settings' => 'stk_amp_footercode',
                'section' => 'amp_tagcode_settings__headfoot',
            )
        ));
    }

    // ---------------------------------------------
    // 広告用ショートコードの登録

    $wp_customize->add_setting('other_options_ad1');
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
        $wp_customize,
        'other_options_ad1',
        array(
            'label' => '広告用ショートコード1',
            'description' => '<code style="font-size:11px;">[ad1]</code>というショートコードを記事内に設置することで、ここに登録したコードを呼び出すことができます。',
            'settings' => 'other_options_ad1',
            'section' => 'tagcode_settings__adshortcode',
        )
    ));

    $wp_customize->add_setting('other_options_ad2');
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
        $wp_customize,
        'other_options_ad2',
        array(
            'label' => '広告用ショートコード2',
            'description' => '<code style="font-size:11px;">[ad2]</code>というショートコードを記事内に設置することで、ここに登録したコードを呼び出すことができます。',
            'settings' => 'other_options_ad2',
            'section' => 'tagcode_settings__adshortcode',
        )
    ));
}
add_action('customize_register', 'opencage_tagcode_customizer');
