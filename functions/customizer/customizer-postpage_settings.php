<?php

if (!defined('ABSPATH')) {
    exit;
}

// post page settings
function opencage_postpage_customizer($wp_customize)
{
    $wp_customize->add_panel(
        'postpage_settings',
        array(
            'title' => '投稿・固定ページ設定',
            'priority' => 20,
        )
    );

    // ---------------------------------------------
    // パネル
    
    $wp_customize->add_section('postpage_settings__contents', array(
        'title' => '記事ページ設定',
        'panel' => 'postpage_settings',
    ));
    $wp_customize->add_section('postpage_settings__sharebutton', array(
        'title' => 'シェアボタン設定',
        'panel' => 'postpage_settings',
    ));
    $wp_customize->add_section('postpage_settings__toc', array(
        'title' => '目次設定',
        'panel' => 'postpage_settings',
    ));
    $wp_customize->add_section('postpage_settings__under', array(
        'title' => '記事下の設定',
        'panel' => 'postpage_settings',
    ));

    // ---------------------------------------------
    // 記事ページ設定

    $wp_customize->add_setting('post_options_ttl', array(
        'type'  => 'option',
        'default' => 'h_default',
    ));
    $wp_customize->add_control('post_options_ttl', array(
        'settings' => 'post_options_ttl',
        'label' => '見出しのデザイン',
        'description' => '記事ページ内の見出し装飾のデザインを選択できます。',
        'section' => 'postpage_settings__contents',
        'type' => 'select',
        'choices' => array(
            'h_default' => 'シンプル（デフォルト）',
            'h_rgba' => 'シンプル（薄）',
            'h_boader' => 'ボーダー',
            'h_balloon' => '吹き出し',
            'h_stitch' => 'ステッチ',
            'h_stripe' => 'ストライプ',
            'h_marker' => 'マーカー',
            'h_bl_bg' => '左線＋グレー背景',
            'h_bb_bg' => '下線＋グレー背景',
            'h_bs_bd' => '実線＋点線',
        ),
    ));

    $wp_customize->add_setting('opencage_color_ttlbg', array('default' => '#1bb4d3',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_ttlbg', array(
		'label' => '見出しの背景色 / ボーダーカラー',
		'section' => 'postpage_settings__contents',
		'settings' => 'opencage_color_ttlbg',
	)));

	$wp_customize->add_setting('opencage_color_ttltext', array('default' => '#ffffff',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_ttltext', array(
		'label' => '見出しの文字色',
		'description' => '背景付きの見出しに適用できます。',
		'section' => 'postpage_settings__contents',
		'settings' => 'opencage_color_ttltext',
	)));

    // 記事ヘッダー設定
    $wp_customize->add_setting('post_options_eyecatch_display', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('post_options_eyecatch_display', array(
        'settings' => 'post_options_eyecatch_display',
        'label' => 'アイキャッチ画像の表示',
        'section' => 'postpage_settings__contents',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('stk_archive_catname', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('stk_archive_catname', array(
        'settings' => 'stk_archive_catname',
        'label' => 'カテゴリーラベルの表示',
        'section' => 'postpage_settings__contents',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する（記事・一覧ページの両方）',
            'off' => '表示する（記事ページのみ）',
            'both_off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('stk_catname_position', array(
        'type'  => 'option',
        'default' => false,
    ));
    $wp_customize->add_control('stk_catname_position', array(
        'settings' => 'stk_catname_position',
        'label' => 'ラベルを投稿日・更新日の真横に表示する',
        'section' => 'postpage_settings__contents',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('opencage_color_labelbg', array('default' => '#fcee21',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_labelbg', array(
		'label' => 'カテゴリーラベルの背景色',
		'settings' => 'opencage_color_labelbg',
        'section' => 'postpage_settings__contents',
	)));

	$wp_customize->add_setting('opencage_color_labeltext', array('default' => '#3e3e3e',));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_color_labeltext', array(
		'label' => 'カテゴリーラベルの文字色',
		'settings' => 'opencage_color_labeltext',
        'section' => 'postpage_settings__contents',
	)));

    $wp_customize->add_setting('post_options_date', array(
        'type'  => 'option',
        'default' => 'undo_on',
    ));
    $wp_customize->add_control('post_options_date', array(
        'settings' => 'post_options_date',
        'label' => '投稿日・更新日の表示',
        'description' => '【※1】未更新の場合は投稿日が表示されます。',
        'section' => 'postpage_settings__contents',
        'type' => 'select',
        'choices' => array(
            'undo_on' => '更新日のみ表示する（※1）',
            'date_on' => '投稿日のみ表示する',
            'date_undo_on' => '投稿日・更新日を表示する',
            'date_undo_off' => '投稿日・更新日を非表示にする',
        ),
    ));

    $wp_customize->add_setting('stk_date_format', array(
        'type'  => 'option',
        'default' => false,
    ));
    $wp_customize->add_control('stk_date_format', array(
        'settings' => 'stk_date_format',
        'label' => '一般設定の日付形式に合わせる',
        'section' => 'postpage_settings__contents',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('ad_options_prsetting', array(
        'type'  => 'option',
        'default' => 'write_off',
    ));
    $wp_customize->add_control('ad_options_prsetting', array(
        'settings' => 'ad_options_prsetting',
        'label' => '広告に関する表記',
        'description' => '記事ページにアフィリエイトや広告を掲載していることを表記できます。',
        'section' => 'postpage_settings__contents',
        'type' => 'select',
        'choices' => array(
            'write_off' => '表記しない',
            'write_post' => '表記する（投稿ページ）',
            'write_page' => '表記する（投稿＆固定ページ）',
        ),
    ));

    $wp_customize->add_setting('ad_options_prtext', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('ad_options_prtext', array(
        'settings' => 'ad_options_prtext',
        'label' => '広告表記のテキスト',
        'description' => 'デフォルト（広告）を別の文字に置き換えます。',
        'section' => 'postpage_settings__contents',
    ));

    // 投稿者情報の表示
    $wp_customize->add_setting('post_options_authordisplay', array(
        'type'  => 'option',
        'default' => 'author_on',
    ));
    $wp_customize->add_control('post_options_authordisplay', array(
        'settings' => 'post_options_authordisplay',
        'label' => '投稿者情報の表示',
        'section' => 'postpage_settings__contents',
        'type' => 'select',
        'choices' => array(
            'author_on' => '表示する（記事ページのみ）',
            'author_on_archives' => '表示する（記事・一覧ページの両方）',
            'author_off' => '表示しない',
        ),
    ));

    // active_callback
    function callback_authordisplay($control)
    {
        if ($control->manager->get_setting('post_options_authordisplay')->value() !== 'author_off') {
            return true;
        } else {
            return false;
        }
    }
    
    $wp_customize->add_setting('post_options_authordisplay_top', array(
        'type'  => 'option',
        'default' => true,
    ));
    $wp_customize->add_control('post_options_authordisplay_top', array(
        'settings' => 'post_options_authordisplay_top',
        'label' => '記事タイトル上に投稿者名を表示しない',
        'section' => 'postpage_settings__contents',
        'type' => 'checkbox',
        'active_callback' => 'callback_authordisplay',
    ));

    $wp_customize->add_setting('stk_authorbox_position', array(
        'type'  => 'option',
        'default' => 'authorbox_under',
    ));
    $wp_customize->add_control('stk_authorbox_position', array(
        'settings' => 'stk_authorbox_position',
        'label' => 'プロフィール欄の表示位置',
        'section' => 'postpage_settings__contents',
        'type' => 'select',
        'choices' => array(
            'authorbox_upper' => '記事上に表示する',
            'authorbox_under' => '記事下に表示する',
        ),
        'active_callback' => 'callback_authordisplay',
    ));

    $wp_customize->add_setting('authordesc_none', array(
        'type'  => 'option',
        'default' => false,
    ));
    $wp_customize->add_control('authordesc_none', array(
        'settings' => 'authordesc_none',
        'label' => 'プロフィール情報が未入力でも表示する',
        'section' => 'postpage_settings__contents',
        'type' => 'checkbox',
        'active_callback' => 'callback_authordisplay',
    ));

    $wp_customize->add_setting('post_options_authornewpost', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('post_options_authornewpost', array(
        'settings' => 'post_options_authornewpost',
        'label' => '投稿者の記事リストを表示しない',
        'section' => 'postpage_settings__contents',
        'type' => 'checkbox',
        'active_callback' => 'callback_authordisplay',
    ));    

    // ---------------------------------------------
    // シェアボタン設定

    $wp_customize->selective_refresh->add_partial(
        'sns_button_display',
        array(
            'selector' => '.sns_btn',
        )
    );

    $wp_customize->add_setting('sns_button_display', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('sns_button_display', array(
        'settings' => 'sns_button_display',
        'label' => 'シェアボタンの表示',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            'on' => '投稿に表示する',
            'on_withpage' => '投稿・固定ページに表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('sns_button_display__tophidden', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('sns_button_display__tophidden', array(
        'settings' => 'sns_button_display__tophidden',
        'label' => '記事上のシェアボタンを非表示にする',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('sns_button_display__sidefix', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('sns_button_display__sidefix', array(
        'settings' => 'sns_button_display__sidefix',
        'label' => '記事下のシェアボタンを画面端に固定する',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('sns_button_style', array(
        'type'  => 'option',
        'default' => '--style-rich',
    ));
    $wp_customize->add_control('sns_button_style', array(
        'settings' => 'sns_button_style',
        'label' => 'シェアボタンのデザイン',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '--style-rich' => 'リッチボタン（デフォルト）',
            '--style-simple' => 'シンプル',
        ),
    ));

    $wp_customize->add_setting('sns_button_hide_twitter', array(
        'type'  => 'option',
        'default' => '',
    ));
    $wp_customize->add_control('sns_button_hide_twitter', array(
        'settings' => 'sns_button_hide_twitter',
        'label' => 'X(Twitter)',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '' => 'Xロゴで表示する',
            'logo_bird' => '旧Twitterロゴで表示する',
            '1' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('sns_button_hide_facebook', array(
        'type'  => 'option',
        'default' => '',
    ));
    $wp_customize->add_control('sns_button_hide_facebook', array(
        'settings' => 'sns_button_hide_facebook',
        'label' => 'Facebook',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '' => '表示する',
            '1' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('sns_button_hide_hatebu', array(
        'type'  => 'option',
        'default' => '',
    ));
    $wp_customize->add_control('sns_button_hide_hatebu', array(
        'settings' => 'sns_button_hide_hatebu',
        'label' => 'はてなブックマーク',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '' => '表示する',
            '1' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('sns_button_hide_line', array(
        'type'  => 'option',
        'default' => '',
    ));
    $wp_customize->add_control('sns_button_hide_line', array(
        'settings' => 'sns_button_hide_line',
        'label' => 'LINE',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '' => '表示する',
            '1' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('sns_button_hide_pocket', array(
        'type'  => 'option',
        'default' => '',
    ));
    $wp_customize->add_control('sns_button_hide_pocket', array(
        'settings' => 'sns_button_hide_pocket',
        'label' => 'Pocket',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '' => '表示する',
            '1' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('sns_button_hide_pinterest', array(
        'type'  => 'option',
        'default' => '1',
    ));
    $wp_customize->add_control('sns_button_hide_pinterest', array(
        'settings' => 'sns_button_hide_pinterest',
        'label' => 'Pinterest',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '' => '表示する',
            '1' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('sns_button_hide_copyurl', array(
        'type'  => 'option',
        'default' => '1',
    ));
    $wp_customize->add_control('sns_button_hide_copyurl', array(
        'settings' => 'sns_button_hide_copyurl',
        'label' => 'URLコピー',
        'section' => 'postpage_settings__sharebutton',
        'type' => 'select',
        'choices' => array(
            '' => '表示する',
            '1' => '表示しない',
        ),
    ));

    if (is_plugin_active_amp()) {
        $wp_customize->add_setting('sns_button_facebook_app_id', array(
            'type'  => 'option',
        ));
        $wp_customize->add_control('sns_button_facebook_app_id', array(
            'settings' => 'sns_button_facebook_app_id',
            'label' => 'Facebook APP ID',
            'description' => 'AMPのFacebookシェアボタンを表示させるために必要となります。Facebook app_idの<a href="https://open-cage.com/facebook-appid-amp" target="_blank">取得方法はこちら</a>',
            'section' => 'postpage_settings__sharebutton',
        ));
    }

    $wp_customize->add_setting('sns_options_text', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('sns_options_text', array(
        'settings' => 'sns_options_text',
        'label' => '記事下のシェアボタンにタイトルを表示',
        'description' => 'シェアボタンの上にメッセージを表示できます。<br><b>※記事下のシェアボタンを画面端に固定している場合は表示されません。</b>',
        'section' => 'postpage_settings__sharebutton',
    ));

    // ---------------------------------------------
    // 目次設定
    $wp_customize->add_setting('stk_toc_insert_post', array(
        'type'  => 'option',
        'default' => 'insert_off',
    ));
    $wp_customize->add_control('stk_toc_insert_post', array(
        'settings' => 'stk_toc_insert_post',
        'label' => '投稿の目次',
        'section' => 'postpage_settings__toc',
        'type' => 'select',
        'choices' => array(
            'insert_off' => '表示しない',
            'insert_on' => '表示する',
        ),
    ));

    $wp_customize->add_setting('stk_toc_insert_page', array(
        'type'  => 'option',
        'default' => 'insert_off',
    ));
    $wp_customize->add_control('stk_toc_insert_page', array(
        'settings' => 'stk_toc_insert_page',
        'label' => '固定ページの目次',
        'section' => 'postpage_settings__toc',
        'type' => 'select',
        'choices' => array(
            'insert_off' => '表示しない',
            'insert_on' => '表示する',
        ),
    ));

    $wp_customize->add_setting('stk_toc_style', array(
        'type'  => 'option',
        'default' => '--style-simple',
    ));
    $wp_customize->add_control('stk_toc_style', array(
        'settings' => 'stk_toc_style',
        'label' => '目次のデザイン',
        'section' => 'postpage_settings__toc',
        'type' => 'select',
        'choices' => array(
            '--style-simple' => 'シンプル（デフォルト）',
            '--style-themecolor' => 'テーマカラー',
            '--style-box' => 'ボックス',
            '--style-stripe' => 'ストライプ',
        ),
    ));

    $wp_customize->add_setting('stk_toc_headingtext', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_toc_headingtext', array(
        'settings' => 'stk_toc_headingtext',
        'label' => '目次のタイトル',
        'description' => '<span style="font-size:11px;">『目次』を別の文字に置き換えます。</span>',
        'section' => 'postpage_settings__toc',
    ));

    $wp_customize->add_setting('stk_toc_numbercolor', array(
        'type'  => 'option',
        'default' => 'default',
    ));
    $wp_customize->add_control('stk_toc_numbercolor', array(
        'settings' => 'stk_toc_numbercolor',
        'label' => '目次番号の色',
        'section' => 'postpage_settings__toc',
        'type' => 'select',
        'choices' => array(
            'default' => 'デフォルト',
            '--ttl-bg' => '見出し背景色',
        ),
    ));

    $wp_customize->add_setting('stk_toc_numberfont', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_toc_numberfont', array(
        'settings' => 'stk_toc_numberfont',
        'label' => '目次番号にGoogleフォントを適用しない',
        'section' => 'postpage_settings__toc',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_toc_headinglevel', array(
        'type'  => 'option',
        'default' => '2',
    ));
    $wp_customize->add_control('stk_toc_headinglevel', array(
        'settings' => 'stk_toc_headinglevel',
        'label' => '目次の階層',
        'description' => '<span style="font-size:11px;">目次に含める見出しレベルを設定できます。</span>',
        'section' => 'postpage_settings__toc',
        'type' => 'select',
        'choices' => array(
            '1' => '見出し2（h2）まで含める',
            '2' => '見出し3（h3）まで含める',
            '3' => '見出し4（h4）まで含める',
            '4' => '見出し5（h5）まで含める',
        ),
    ));

    $wp_customize->add_setting('stk_toc_start', array(
        'type'  => 'option',
        'default' => '2',
    ));
    $wp_customize->add_control('stk_toc_start', array(
        'settings' => 'stk_toc_start',
        'label' => '表示条件',
        'description' => '<span style="font-size:11px;">目次の表示に必要な見出しの数を設定できます。<br>※「目次の階層」で設定したレベル以上の見出しを数えるようになります。</span>',
        'section' => 'postpage_settings__toc',
        'type' => 'select',
        'choices' => array(
            '2' => '2つ以上見出しがあるとき',
            '3' => '3つ以上見出しがあるとき',
            '4' => '4つ以上見出しがあるとき',
            '5' => '5つ以上見出しがあるとき',
            '6' => '6つ以上見出しがあるとき',
            '7' => '7つ以上見出しがあるとき',
            '8' => '8つ以上見出しがあるとき',
            '9' => '9つ以上見出しがあるとき',
        ),
    ));

    $wp_customize->add_setting('stk_toc_toggle', array(
        'type'  => 'option',
        'default' => 'toggle_off',
    ));
    $wp_customize->add_control('stk_toc_toggle', array(
        'settings' => 'stk_toc_toggle',
        'label' => '目次の開閉',
        'section' => 'postpage_settings__toc',
        'type' => 'select',
        'choices' => array(
            'toggle_off' => '目次を展開する',
            'toggle_on' => '目次を折りたたむ',
        )
    ));

    // ---------------------------------------------
    // 記事下の設定
    
    // カテゴリー・タグの表示設定
    $wp_customize->add_setting('article_footer_options', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('article_footer_options', array(
        'settings' => 'article_footer_options',
        'label' => 'カテゴリー・タグの表示',
        'description' => '記事下のカテゴリーリンクとタグリンクの表示設定。',
        'section' => 'postpage_settings__under',
        'type' => 'select',
        'choices' => array(
            'on' => 'カテゴリー・タグを表示する',
            'on_cat' => 'カテゴリーのみ表示する',
            'on_tag' => 'タグのみ表示する',
            'off' => '表示しない',
        ),
    ));

    // フォローボタンの表示
    $wp_customize->selective_refresh->add_partial(
        'fbbox_options_url',
        array(
            'selector' => '.fb-likebtn',
        )
    );

    $wp_customize->add_setting('fbbox_options_url', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('fbbox_options_url', array(
        'settings' => 'fbbox_options_url',
        'label' => 'Facebook',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => 'FacebookページのURLを入力'
        ),
    ));

    $wp_customize->add_setting('twbox_options_url', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('twbox_options_url', array(
        'settings' => 'twbox_options_url',
        'label' => 'X(Twitter)',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => 'X(Twitter)のURLを入力'
        ),
    ));

    $wp_customize->add_setting('youtubebox_options_url', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('youtubebox_options_url', array(
        'settings' => 'youtubebox_options_url',
        'label' => 'YouTube',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => 'YouTubeチャンネルのURLを入力'
        ),
    ));

    $wp_customize->add_setting('instagrambox_options_url', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('instagrambox_options_url', array(
        'settings' => 'instagrambox_options_url',
        'label' => 'Instagram',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => 'InstagramのURLを入力'
        ),
    ));

    $wp_customize->add_setting('linebox_options_url', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('linebox_options_url', array(
        'settings' => 'linebox_options_url',
        'label' => 'LINE',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => 'LINE公式アカウントのURLを入力'
        ),
    ));

    $wp_customize->add_setting('feedlybox_options_url', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('feedlybox_options_url', array(
        'settings' => 'feedlybox_options_url',
        'label' => 'Feedly',
        //'description' => '例: https://feedly.com/i/subscription/feed/https://open-cage.com/feed/',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => 'FeedlyのURLを入力'
        ),
    ));

    // 前後記事リンク
    $wp_customize->add_setting('np_hide_options', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('np_hide_options', array(
        'settings' => 'np_hide_options',
        'label' => '前後記事リンクの表示',
        'section' => 'postpage_settings__under',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('np_excluded_terms', array(
        'type'  => 'option',
        'default' => 'all',
    ));
    $wp_customize->add_control('np_excluded_terms', array(
        'settings' => 'np_excluded_terms',
        'label' => '前後記事リンクの対象',
        'section' => 'postpage_settings__under',
        'type' => 'select',
        'choices' => array(
            'all' => '全ての記事',
            'same_cat' => '同じカテゴリー',
        ),
    ));

    $wp_customize->add_setting('np_display_reverse', array(
        'type'  => 'option',
        'default' => 'prev_next',
    ));
    $wp_customize->add_control('np_display_reverse', array(
        'settings' => 'np_display_reverse',
        'label' => '前後記事リンクの配置',
        'section' => 'postpage_settings__under',
        'type' => 'select',
        'choices' => array(
            'prev_next' => '左：新しい記事｜右：古い記事',
            'next_prev' => '左：古い記事｜右：新しい記事',
        ),
    ));

    $wp_customize->add_setting('np_display_thumbnail', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('np_display_thumbnail', array(
        'settings' => 'np_display_thumbnail',
        'label' => '前後記事のサムネイル画像を表示しない',
        'section' => 'postpage_settings__under',
        'type' => 'checkbox',
    ));

    // 関連記事エリア
    $wp_customize->add_setting('recommend_hide_options', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('recommend_hide_options', array(
        'settings' => 'recommend_hide_options',
        'label' => '関連記事の表示',
        'section' => 'postpage_settings__under',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('ga_recommend_options', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
        $wp_customize,
        'ga_recommend_options',
        array(
            'label' => 'Multiplex広告を表示する',
            'description' => '記事下の「関連記事」をGoogle AdSenseの「Multiplex広告」と置き換えるためのオプションです。下記の入力欄にGoogle AdSenseで取得したscriptを貼り付けることで関連記事と内容が置き換わります。',
            'settings' => 'ga_recommend_options',
            'section' => 'postpage_settings__under',
        )
    ));
    if (is_plugin_active_amp()) {
        $wp_customize->add_setting('stk_amp_ga_recommend_options', array(
            'type'  => 'option',
        ));
        $wp_customize->add_control(new WP_Customize_Code_Editor_Control(
            $wp_customize,
            'stk_amp_ga_recommend_options',
            array(
                'label' => '【AMP用】GoogleAdSense「関連コンテンツユニット」を表示する',
                'description' => 'AMPプラグインを有効化しているときにAMP用の関連コンテンツユニットを表示するためのオプションです。</b>',
                'settings' => 'stk_amp_ga_recommend_options',
                'section' => 'postpage_settings__under',
            )
        ));
    }

    // 見出し補足テキストの変更
    $wp_customize->add_setting('followbox_jptext', array(
        'type'  => 'option',
        'default' => 'この記事が気に入ったらフォローしよう！',
    ));
    $wp_customize->add_control('followbox_jptext', array(
        'settings' => 'followbox_jptext',
        'label' => 'FOLLOW：補足テキスト',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => '例：この記事が気に入ったらフォローしよう！'
        ),
    ));

    $wp_customize->add_setting('related_jptext', array(
        'type'  => 'option',
        'default' => 'こちらの記事も人気です',
    ));
    $wp_customize->add_control('related_jptext', array(
        'settings' => 'related_jptext',
        'label' => 'RECOMMEND：補足テキスト',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => '例：こちらの記事も人気です'
        ),
    ));

    $wp_customize->add_setting('authorbox_jptext', array(
        'type'  => 'option',
        'default' => 'この記事を書いた人',
    ));
    $wp_customize->add_control('authorbox_jptext', array(
        'settings' => 'authorbox_jptext',
        'label' => 'ABOUT US：補足テキスト',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => '例：この記事を書いた人'
        ),
    ));

    $wp_customize->add_setting('authorpost_jptext', array(
        'type'  => 'option',
        'default' => 'このライターの最新記事',
    ));
    $wp_customize->add_control('authorpost_jptext', array(
        'settings' => 'authorpost_jptext',
        'label' => 'NEW POST：補足テキスト',
        'section' => 'postpage_settings__under',
        'input_attrs' => array(
            'placeholder' => '例：このライターの最新記事'
        ),
    ));

    // その他のオプション
    $wp_customize->add_setting('post_options_page_widget', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('post_options_page_widget', array(
        'settings' => 'post_options_page_widget',
        'label' => '固定ページに記事ウィジェットを表示する',
        'description' => '固定ページにも記事タイトル下/記事コンテンツ下のウィジェットを表示できます。<br><b>対応テンプレート</b>：デフォルト/サイドバーなし(1カラム)',
        'section' => 'postpage_settings__under',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('post_options_page_cta', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('post_options_page_cta', array(
        'settings' => 'post_options_page_cta',
        'label' => '固定ページにCTAウィジェットを表示する',
        'description' => '固定ページ下にもCTAウィジェットを表示できます。<br><b>対応テンプレート</b>：デフォルト/サイドバーなし(1カラム)',
        'section' => 'postpage_settings__under',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'opencage_postpage_customizer');
