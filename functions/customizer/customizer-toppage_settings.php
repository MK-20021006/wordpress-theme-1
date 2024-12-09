<?php

if (!defined('ABSPATH')) {
    exit;
}

// toppage settings
function opencage_toppage_customizer($wp_customize)
{
    $wp_customize->add_panel(
        'toppage_settings',
        array(
            'title' => 'トップページ設定',
            'priority' => 10,
        )
    );

    // ---------------------------------------------
    // パネル

    $wp_customize->add_section('toppage_settings__headereyecatch', array(
        'title'       => 'ヘッダーアイキャッチ',
        'panel' => 'toppage_settings',
        'description' => '<p>トップページにインパクトを与えるカバーコンテンツを表示できます。</p><p>設定方法：<a href="https://www.stork19.com/toppage-eyecatch-setting/" target="_blank">ヘッダーアイキャッチの設定</a></p>',
    ));

    $wp_customize->add_section('toppage_settings__slider', array(
        'title'       => '記事スライダー',
        'panel' => 'toppage_settings',
        'description' => '<p>動きのあるカルーセルスライダーで注目記事を魅力的に見せましょう。</p><p>設定方法：<a href="https://www.stork19.com/pickup-slider/" target="_blank">記事スライダーの設定</a></p>',
    ));

    $wp_customize->add_section('toppage_settings__pickupcontent', array(
        'title'       => 'ピックアップコンテンツ',
        'panel' => 'toppage_settings',
        'description' => '<p>トップページまたは全ページのヘッダー下に最大4つのバナーを設置できます。</p><p>設定方法：<a href="https://www.stork19.com/pickup-content/" target="_blank">ピックアップコンテンツの設定</a></p>',
    ));

    // ---------------------------------------------
    // セレクターショートカット

    $wp_customize->selective_refresh->add_partial(
        'opencage_toppage_header_display',
        array(
            'selector' => '.stk_custom_header__text',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'stk_toppageslider_display',
        array(
            'selector' => '#top_carousel',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'stk_pickupcontent_display',
        array(
            'selector' => '#main-pickup_content',
        )
    );

    // ---------------------------------------------
    // ヘッダーアイキャッチ

    $wp_customize->add_setting('opencage_toppage_header_display', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('opencage_toppage_header_display', array(
        'settings' => 'opencage_toppage_header_display',
        'label' => 'ヘッダーアイキャッチの表示',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting(
        'opencage_toppage_headerbg'
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'opencage_toppage_headerbg',
            array(
                'settings'   => 'opencage_toppage_headerbg',
                'label'        => 'PC:画像',
                'section'    => 'toppage_settings__headereyecatch',
            )
        )
    );

    $wp_customize->add_setting(
        'opencage_toppage_headerbg_movie'
    );
    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'opencage_toppage_headerbg_movie',
            array(
                'settings' => 'opencage_toppage_headerbg_movie',
                'label'    => 'PC:動画背景',
                'description' => '動画ファイルのみ利用可能',
                'section'  => 'toppage_settings__headereyecatch',
            )
        )
    );

    $wp_customize->add_setting(
        'opencage_toppage_headerbgsp'
    );
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'opencage_toppage_headerbgsp',
        array(
            'settings'   => 'opencage_toppage_headerbgsp',
            'label'        => 'SP:画像',
            //'description' => '※設定しなかった場合は上の項目で設定した画像or動画が表示されます。',
            'section'    => 'toppage_settings__headereyecatch',
        )
    ));

    $wp_customize->add_setting(
        'opencage_toppage_headerbg_movie_sp'
    );
    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'opencage_toppage_headerbg_movie_sp',
            array(
                'settings' => 'opencage_toppage_headerbg_movie_sp',
                'label'    => 'SP:動画背景',
                'description' => '動画ファイルのみ利用可能',
                'section'  => 'toppage_settings__headereyecatch',
            )
        )
    );

    $wp_customize->add_setting('stk_toppage_headerbg_movie__loop');
    $wp_customize->add_control('stk_toppage_headerbg_movie__loop', array(
        'settings' => 'stk_toppage_headerbg_movie__loop',
        'label' => '動画を繰り返し再生しない',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('opencage_toppage_headeregtext', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('opencage_toppage_headeregtext', array(
        'settings' => 'opencage_toppage_headeregtext',
        'label' => 'メインテキスト：大',
        //'description' => 'ローマ字にはGoogleフォント(欧文)が適用されます。',
        'section' => 'toppage_settings__headereyecatch',
    ));

    $wp_customize->add_setting('opencage_toppage_header_gf', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('opencage_toppage_header_gf', array(
        'settings' => 'opencage_toppage_header_gf',
        'label' => 'メインテキストにGoogleフォント(欧文)を適用しない',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('opencage_toppage_headerjptext', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('opencage_toppage_headerjptext', array(
        'settings' => 'opencage_toppage_headerjptext',
        'label' => 'サブテキスト：小',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('opencage_toppage_textcolor', array(
        'default' => '#0ea3c9',
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'opencage_toppage_textcolor',
            array(
                'settings' => 'opencage_toppage_textcolor',
                'label' => 'テキスト色',
                'section' => 'toppage_settings__headereyecatch',
            )
        )
    );

    $wp_customize->add_setting('opencage_toppage_textlayout', array(
        'type'  => 'option',
        'default' => 'textcenter',
    ));
    $wp_customize->add_control('opencage_toppage_textlayout', array(
        'settings' => 'opencage_toppage_textlayout',
        'label' => 'テキストの配置',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'select',
        'choices' => array(
            'textcenter' => '中央揃え',
            'textleft' => '左寄せ',
            'textright' => '右寄せ',
        ),
    ));

    $wp_customize->add_setting('opencage_toppage_headerlink', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('opencage_toppage_headerlink', array(
        'settings' => 'opencage_toppage_headerlink',
        'label' => 'リンクURL',
        'input_attrs' => array(
            'placeholder' => '「https://」で始まるURLを入力'
        ),
        'section' => 'toppage_settings__headereyecatch',
    ));

    $wp_customize->add_setting('opencage_toppage_headerlinktext', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('opencage_toppage_headerlinktext', array(
        'settings' => 'opencage_toppage_headerlinktext',
        'label' => 'ボタンテキスト',
        'input_attrs' => array(
            'placeholder' => '詳しくはこちら'
        ),
        'section' => 'toppage_settings__headereyecatch',
    ));

    $wp_customize->add_setting('opencage_toppage_btnstyle', array(
        'type'  => 'option',
        'default' => 'is-style-fill',
    ));
    $wp_customize->add_control('opencage_toppage_btnstyle', array(
        'settings' => 'opencage_toppage_btnstyle',
        'label' => 'ボタンスタイル',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'select',
        'choices' => array(
            'is-style-fill' => '塗りつぶし',
            'is-style-outline' => '輪郭',
            'is-style-stripe' => 'ストライプ',
        ),
    ));

    $wp_customize->add_setting('opencage_toppage_btncolor', array(
        'default' => '#ffffff',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_toppage_btncolor', array(
        'settings' => 'opencage_toppage_btncolor',
        'label' => 'ボタンテキスト色',
        'section' => 'toppage_settings__headereyecatch',
    )));

    // 輪郭の場合は表示しない
    function callback_btnstyle_notoutline($control)
    {
        if ($control->manager->get_setting('opencage_toppage_btnstyle')->value()!=='is-style-outline') {
            return true;
        } else {
            return false;
        }
    }
    $wp_customize->add_setting('opencage_toppage_btnbgcolor', array(
        'default' => '#ed7171',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_toppage_btnbgcolor', array(
        'settings' => 'opencage_toppage_btnbgcolor',
        'label' => 'ボタン背景色',
        'section' => 'toppage_settings__headereyecatch',
        'active_callback' => 'callback_btnstyle_notoutline',
    )));

    // 塗りつぶし（デフォルト）のみ表示する
    function callback_btnstyle_onlyfill($control)
    {
        if ($control->manager->get_setting('opencage_toppage_btnstyle')->value()!=='is-style-fill') {
            return false;
        } else {
            return true;
        }
    }
    $wp_customize->add_setting('opencage_toppage_btnbgcolor2', array(
        'default' => '',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'opencage_toppage_btnbgcolor2', array(
        'settings' => 'opencage_toppage_btnbgcolor2',
        'label' => '背景色の追加',
        'description' => '<span style="font-size:11px;">ボタン背景色をグラデーション化できます。</span>',
        'section' => 'toppage_settings__headereyecatch',
        'active_callback' => 'callback_btnstyle_onlyfill',
    )));

    $wp_customize->add_setting('opencage_toppage_btnshiny', array(
        'type'  => 'option',
        'default' => 'normal',
    ));
    $wp_customize->add_control('opencage_toppage_btnshiny', array(
        'settings' => 'opencage_toppage_btnshiny',
        'label' => 'ボタンアニメーション',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'select',
        'choices' => array(
            'normal' => 'ノーマル',
            'stk-shiny-button' => '光るボタン',
            'stk-bound-button' => 'バウンドボタン',
        ),
    ));

    $wp_customize->add_setting('opencage_toppage_headder_overlay_design', array(
        'default' => 'color',
    ));
    $wp_customize->add_control('opencage_toppage_headder_overlay_design', array(
        'settings' => 'opencage_toppage_headder_overlay_design',
        'label' => 'オーバーレイ設定',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'select',
        'choices' => array(
            'color' => 'ベタ塗り',
            'stripe' => 'ストライプ',
            'dot' => 'ドット',
            'none' => 'オーバーレイなし',
        ),
    ));

    // active_callback
    function callback_headder_overlay($control)
    {
        if ($control->manager->get_setting('opencage_toppage_headder_overlay_design')->value()!=='none') {
            return true;
        } else {
            return false;
        }
    }

    $wp_customize->add_setting('opencage_toppage_headder_overlay', array(
        'default' => '#000000',
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'opencage_toppage_headder_overlay',
            array(
                'settings' => 'opencage_toppage_headder_overlay',
                'label' => 'オーバーレイカラー',
                'section' => 'toppage_settings__headereyecatch',
                'active_callback' => 'callback_headder_overlay',
            )
        )
    );

    $wp_customize->add_setting('opencage_toppage_headder_overlay_opacity', array(
        'default' => '5',
    ));
    $wp_customize->add_control('opencage_toppage_headder_overlay_opacity', array(
        'settings' => 'opencage_toppage_headder_overlay_opacity',
        'label' => 'オーバーレイの不透明度',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'range',
        'active_callback' => 'callback_headder_overlay',
    ));

    $wp_customize->add_setting('opencage_toppage_header_minheight', array(
        'default' => '50',
        'type'  => 'option',
    ));
    $wp_customize->add_control('opencage_toppage_header_minheight', array(
        'settings' => 'opencage_toppage_header_minheight',
        'label' => '最小の高さ（PC用）',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'number',
    ));

    $wp_customize->add_setting('opencage_toppage_header_minheight_sp', array(
        'default' => '60',
        'type'  => 'option',
    ));
    $wp_customize->add_control('opencage_toppage_header_minheight_sp', array(
        'settings' => 'opencage_toppage_header_minheight_sp',
        'label' => '最小の高さ（スマホ用）',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'number',
    ));

    $wp_customize->add_setting('stk_homeheader-headeroverlay', array(
        'type'  => 'option',
        'default' => 'off',
    ));
    $wp_customize->add_control('stk_homeheader-headeroverlay', array(
        'settings' => 'stk_homeheader-headeroverlay',
        'label' => 'ヘッダー背景を透過する',
        'description' => 'トップページのヘッダーを透過させてヘッダーアイキャッチに重ねて表示できます。',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'select',
        'choices' => array(
            'off' => '透過しない',
            'on' => '透過する',
            'on_wide' => '透過する（全幅）',
        ),
    ));

    $wp_customize->add_setting(
        'stk_homeheader-headeroverlay__textcolor',
        array(
            'default' => "",
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'stk_homeheader-headeroverlay__textcolor',
            array(
                'settings' => 'stk_homeheader-headeroverlay__textcolor',
                'label' => '透過ヘッダーの文字色',
                'description' => '未設定の場合はヘッダーアイキャッチのテキスト色が反映されます。',
                'section' => 'toppage_settings__headereyecatch',
            )
        )
    );

    $wp_customize->add_setting(
        'stk_homeheader-headeroverlay__logoimg'
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'stk_homeheader-headeroverlay__logoimg',
            array(
                'settings'   => 'stk_homeheader-headeroverlay__logoimg',
                'label'        => '透過ヘッダーのロゴ画像',
                'description' => '通常のロゴ画像が設定されている場合のみ有効です。',
                'section'    => 'toppage_settings__headereyecatch',
            )
        )
    );

    $wp_customize->add_setting('stk_homeheader-headeroverlay__infoposition', array(
        'type'  => 'option',
        'default' => 'off',
    ));
    $wp_customize->add_control('stk_homeheader-headeroverlay__infoposition', array(
        'settings' => 'stk_homeheader-headeroverlay__infoposition',
        'label' => 'お知らせテキストの表示位置',
        'description' => 'ヘッダー背景を透過している場合の「ヘッダー下お知らせ」の表示について。',
        'section' => 'toppage_settings__headereyecatch',
        'type' => 'radio',
        'choices' => array(
            'off' => '表示しない',
            'on_under' => '表示する（ヘッダーアイキャッチ下）',
        ),
    ));

    // ---------------------------------------------
    // 記事スライダー

    $wp_customize->add_setting('stk_toppageslider_display', array(
        'type'  => 'option',
        'default' => 'off',
    ));
    $wp_customize->add_control('stk_toppageslider_display', array(
        'settings' => 'stk_toppageslider_display',
        'label' => 'スライダーの表示',
        'section' => 'toppage_settings__slider',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('stk_toppageslider_size', array(
        'type'  => 'option',
        'default' => 'default',
    ));
    $wp_customize->add_control('stk_toppageslider_size', array(
        'settings' => 'stk_toppageslider_size',
        'label' => 'スライダーの横幅（PC用）',
        'section' => 'toppage_settings__slider',
        'type' => 'select',
        'choices' => array(
            'default' => 'コンテンツ幅',
            'large' => '全幅（ワイド）',
        ),
    ));

    $wp_customize->add_setting('stk_toppageslider_style', array(
        'type'  => 'option',
        'default' => 'default',
    ));
    $wp_customize->add_control('stk_toppageslider_style', array(
        'settings' => 'stk_toppageslider_style',
        'label' => 'スライダーのタイプ',
        'section' => 'toppage_settings__slider',
        'type' => 'select',
        'choices' => array(
            'default' => 'ノーマル',
            'overlay' => 'オーバーレイ',
        ),
    ));

    $wp_customize->add_setting('stk_toppageslider_padding', array(
        'type'  => 'option',
        'default' => 'default',
    ));
    $wp_customize->add_control('stk_toppageslider_padding', array(
        'settings' => 'stk_toppageslider_padding',
        'label' => 'スライダーのサイズ',
        'section' => 'toppage_settings__slider',
        'type' => 'select',
        'choices' => array(
            'default' => 'S（デフォルト）',
            'medium' => 'M',
            'large' => 'L',
        ),
        'active_callback'    => 'callback_stk_sliderStyle',
    ));

    $wp_customize->add_setting('opencage_color_slidertext', array(
        'default' => '#444444',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'opencage_color_slidertext',
        array(
            'label' => 'テキスト色',
            'settings' => 'opencage_color_slidertext',
            'section' => 'toppage_settings__slider',
            'active_callback'    => 'callback_stk_sliderStyle',
        )
    ));

    // スライダースタイルの active_callback関数
    function callback_stk_sliderStyle($control)
    {
        if ($control->manager->get_setting('stk_toppageslider_style')->value() !== 'overlay') {
            return true;
        } else {
            return false;
        }
    }

    $wp_customize->add_setting('stk_toppageslider_postsnumber', array(
        'type'  => 'option',
        'default' => '10',
    ));
    $wp_customize->add_control('stk_toppageslider_postsnumber', array(
        'label' => 'スライド表示する最大記事数',
        'description' => 'スライドさせるには4件以上の表示が必要です。',
        'settings' => 'stk_toppageslider_postsnumber',
        'section' => 'toppage_settings__slider',
        'type' => 'number',
    ));

    $wp_customize->add_setting('stk_slide_autoplay', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('stk_slide_autoplay', array(
        'settings' => 'stk_slide_autoplay',
        'label' => '自動再生',
        'section' => 'toppage_settings__slider',
        'type' => 'select',
        'choices' => array(
            'on' => '自動再生する',
            'off' => '自動再生しない',
        ),
    ));

    $wp_customize->add_setting('stk_slide_autoplayspeed', array(
        'default' => '3000',
        'type'  => 'option',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_slide_autoplayspeed', array(
        'settings' => 'stk_slide_autoplayspeed',
        'label' => '自動再生の切り替え時間',
        'section' => 'toppage_settings__slider',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '100',
            'min'      => '100',
            'max'      => '10000',
        ),
        'active_callback'    => 'callback_stk_sliderAutoplay',
    ));

    // 自動再生の active_callback関数
    function callback_stk_sliderAutoplay($control)
    {
        if ($control->manager->get_setting('stk_slide_autoplay')->value() == 'on') {
            return true;
        } else {
            return false;
        }
    }

    $wp_customize->add_setting('stk_toppageslider_dots', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('stk_toppageslider_dots', array(
        'settings' => 'stk_toppageslider_dots',
        'label' => 'インジケーターの表示',
        'section' => 'toppage_settings__slider',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('stk_toppageslider_arrows', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_toppageslider_arrows', array(
        'settings' => 'stk_toppageslider_arrows',
        'label' => 'スライド送りの矢印を表示しない',
        'section' => 'toppage_settings__slider',
        'type' => 'checkbox',
    ));

    // ---------------------------------------------
    // ピックアップコンテンツ

    $wp_customize->add_setting('stk_pickupcontent_display', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('stk_pickupcontent_display', array(
        'settings' => 'stk_pickupcontent_display',
        'label' => 'ピックアップコンテンツの表示',
        'section' => 'toppage_settings__pickupcontent',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する（全ページ）',
            'on_top' => '表示する（トップページのみ）',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('stk_pickupcontent_size_ratio', array(
		'type'  => 'option',
		'default' => 'none',
    ));
    $wp_customize->add_control('stk_pickupcontent_size_ratio', array(
		'settings' => 'stk_pickupcontent_size_ratio',
		'label' => 'バナー画像のサイズ比率',
		'section' => 'toppage_settings__pickupcontent',
		'type' => 'select',
		'choices' => array(
            'none' => '比率指定なし',
            '--sizeratio-square' => '1:1（正方形）',
            '--sizeratio-standard' => '4:3',
            '--sizeratio-classic' => '3:2',
            '--sizeratio-wide' => '16:9',
		),
	));

    $wp_customize->add_setting('stk_pickupcontent_1_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'stk_pickupcontent_1_img', array(
        'settings'   => 'stk_pickupcontent_1_img',
        'label'        => 'バナー01：画像',
        'section'    => 'toppage_settings__pickupcontent',
    )));

    $wp_customize->add_setting('stk_pickupcontent_1_link', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_1_link', array(
        'label' => 'バナー01：リンク',
        'settings' => 'stk_pickupcontent_1_link',
        'section' => 'toppage_settings__pickupcontent',
        'input_attrs' => array(
            'placeholder' => '「https://」で始まるURLを入力'
        ),
    ));

    $wp_customize->add_setting('stk_pickupcontent_1_text', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_1_text', array(
        'settings' => 'stk_pickupcontent_1_text',
        'label' => 'バナー01：テキスト',
        'section' => 'toppage_settings__pickupcontent',
    ));

    $wp_customize->add_setting('stk_pickupcontent_1_linktarget', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_1_linktarget', array(
        'settings' => 'stk_pickupcontent_1_linktarget',
        'label' => 'リンクを別タブで開く（_target設定）',
        'section' => 'toppage_settings__pickupcontent',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_pickupcontent_2_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'stk_pickupcontent_2_img', array(
        'settings'   => 'stk_pickupcontent_2_img',
        'label'        => 'バナー02：画像',
        'section'    => 'toppage_settings__pickupcontent',
    )));

    $wp_customize->add_setting('stk_pickupcontent_2_link', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_2_link', array(
        'label' => 'バナー02：リンク',
        'settings' => 'stk_pickupcontent_2_link',
        'section' => 'toppage_settings__pickupcontent',
        'input_attrs' => array(
            'placeholder' => '「https://」で始まるURLを入力'
        ),
    ));

    $wp_customize->add_setting('stk_pickupcontent_2_text', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_2_text', array(
        'settings' => 'stk_pickupcontent_2_text',
        'label' => 'バナー02：テキスト',
        'section' => 'toppage_settings__pickupcontent',
    ));

    $wp_customize->add_setting('stk_pickupcontent_2_linktarget', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_2_linktarget', array(
        'settings' => 'stk_pickupcontent_2_linktarget',
        'label' => 'リンクを別タブで開く（_target設定）',
        'section' => 'toppage_settings__pickupcontent',
        'type' => 'checkbox',
    ));


    $wp_customize->add_setting('stk_pickupcontent_3_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'stk_pickupcontent_3_img', array(
        'settings'   => 'stk_pickupcontent_3_img',
        'label'        => 'バナー03：画像',
        'section'    => 'toppage_settings__pickupcontent',
    )));

    $wp_customize->add_setting('stk_pickupcontent_3_link', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_3_link', array(
        'label' => 'バナー03：リンク',
        'settings' => 'stk_pickupcontent_3_link',
        'section' => 'toppage_settings__pickupcontent',
        'input_attrs' => array(
            'placeholder' => '「https://」で始まるURLを入力'
        ),
    ));

    $wp_customize->add_setting('stk_pickupcontent_3_text', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_3_text', array(
        'settings' => 'stk_pickupcontent_3_text',
        'label' => 'バナー03：テキスト',
        'section' => 'toppage_settings__pickupcontent',
    ));

    $wp_customize->add_setting('stk_pickupcontent_3_linktarget', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_3_linktarget', array(
        'settings' => 'stk_pickupcontent_3_linktarget',
        'label' => 'リンクを別タブで開く（_target設定）',
        'section' => 'toppage_settings__pickupcontent',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_pickupcontent_4_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'stk_pickupcontent_4_img', array(
        'settings'   => 'stk_pickupcontent_4_img',
        'label'        => 'バナー04：画像',
        'section'    => 'toppage_settings__pickupcontent',
    )));

    $wp_customize->add_setting('stk_pickupcontent_4_link', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_4_link', array(
        'label' => 'バナー04：リンク',
        'settings' => 'stk_pickupcontent_4_link',
        'section' => 'toppage_settings__pickupcontent',
        'input_attrs' => array(
            'placeholder' => '「https://」で始まるURLを入力'
        ),
    ));

    $wp_customize->add_setting('stk_pickupcontent_4_text', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_4_text', array(
        'settings' => 'stk_pickupcontent_4_text',
        'label' => 'バナー04：テキスト',
        'section' => 'toppage_settings__pickupcontent',
    ));
    
    $wp_customize->add_setting('stk_pickupcontent_4_linktarget', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pickupcontent_4_linktarget', array(
        'settings' => 'stk_pickupcontent_4_linktarget',
        'label' => 'リンクを別タブで開く（_target設定）',
        'section' => 'toppage_settings__pickupcontent',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'opencage_toppage_customizer');
