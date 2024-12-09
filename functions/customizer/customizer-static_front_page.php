<?php

if (!defined('ABSPATH')) {
    exit;
}

// front page setting
function opencage_static_front_page($wp_customize)
{
    $wp_customize->add_section('static_front_page', array(
        'title' => 'ホームページ設定',
        'description' => '固定フロントページを設定できます。「<b>ホームページ</b>」で選択したページがトップページになります。また「<b>投稿ページ</b>」で選択したページには投稿記事一覧が表示されます。',
    ));

    $wp_customize->add_setting('front_page_ttl_display', array(
        'type'  => 'option',
        'default' => 'off',
    ));
    $wp_customize->add_control('front_page_ttl_display', array(
        'settings' => 'front_page_ttl_display',
        'label' =>'固定フロントページのタイトル表示',
        'section' => 'static_front_page',
        'type' => 'radio',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない（デフォルト）',
        ),
        'active_callback'	=> 'callback_stk_pagettl_display',
    ));

    // 固定ページタイトルの active_callback関数
    function callback_stk_pagettl_display( $control ) {		
		if ( $control->manager->get_setting( 'show_on_front' )->value() == 'page' )
        {
            return true;
        } else {
            return false;
        }
	}
}
add_action('customize_register', 'opencage_static_front_page');
