<?php

if (!defined('ABSPATH')) {
    exit;
}

// global settings
function opencage_global_customizer($wp_customize)
{
    $wp_customize->add_panel(
        'global_settings',
        array(
            'title' => 'サイト全体の設定',
            'priority' => 1,
            'description' => 'サイト全体のレイアウトやフォント、ウィジェット関連の設定ができます。',
        )
    );

    // ---------------------------------------------
    // パネル
    
    $wp_customize->add_section('global_settings__header', array(
        'title' => 'ヘッダーエリア',
        'panel' => 'global_settings',
    ));

    $wp_customize->add_section('global_settings__headerunder', array(
        'title' => 'ヘッダー下お知らせテキスト',
        'panel' => 'global_settings',
    ));

    $wp_customize->add_section('global_settings__sitelayout', array(
        'title' => 'コンテンツエリア',
        'panel' => 'global_settings',
    ));

    $wp_customize->add_section('global_settings__breadcrumb', array(
        'title' => 'パンくずナビゲーション',
        'panel' => 'global_settings',
    ));

    $wp_customize->add_section('global_settings__pagetop_btn', array(
        'title' => 'スクロール追従ボタン',
        'panel' => 'global_settings',
    ));

    $wp_customize->add_section('global_settings__widget', array(
        'title' => 'ウィジェット関連設定',
        'panel' => 'global_settings',
    ));

    $wp_customize->add_section('global_settings__font', array(
        'title' => 'フォント設定',
        'panel' => 'global_settings',
    ));

    $wp_customize->add_section('global_settings__richresults', array(
        'title' => '構造化データ設定',
        'panel' => 'global_settings',
        'description' => 'JSON-LD形式の構造化データをページに追加できます。',
    ));
    
    // ---------------------------------------------
    // セレクターショートカット

    $wp_customize->selective_refresh->add_partial(
        'side_options_twitterlink_url',
        array(
            'selector' => '.stk_sns_links',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'other_options_headerundertext',
        array(
            'selector' => '.header-info__link',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'pannavi_position',
        array(
            'selector' => '#breadcrumb .wrap',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'side_options_cataccordion',
        array(
            'selector' => '.widget.widget_categories',
        )
    );

    // ---------------------------------------------
    //　ヘッダー

    $wp_customize->add_setting('stk_header_layout_pc', array(
        'type'  => 'option',
        'default' => stk_header_layout_option_patch(),
    ));
    $wp_customize->add_control('stk_header_layout_pc', array(
        'settings' => 'stk_header_layout_pc',
        'label' => 'ヘッダーレイアウト（PC用）',
        'section' => 'global_settings__header',
        'type' => 'radio',
        'choices' => array(
            'left_full' => 'ロゴ左：全幅(フル)',
            'left_wide' => 'ロゴ左：全幅(ワイド)',
            'left_normal' => 'ロゴ左：コンテンツ幅',
            'center_full' => 'ロゴ中央：全幅(フル)',
            'center_wide' => 'ロゴ中央：全幅(ワイド)',
            'center_normal' => 'ロゴ中央：コンテンツ幅',
        ),
    ));

    $wp_customize->add_setting('stk_header_layout_sp', array(
        'type'  => 'option',
        'default' => 'center',
    ));
    $wp_customize->add_control('stk_header_layout_sp', array(
        'settings' => 'stk_header_layout_sp',
        'label' => 'ヘッダーレイアウト（スマホ用）',
        'section' => 'global_settings__header',
        'type' => 'radio',
        'choices' => array(
            'center' => 'ロゴ中央',
            'left' => 'ロゴ左',
        ),
    ));

    $wp_customize->add_setting('side_options_headerfix', array(
        'type'  => 'option',
        'default' => 'headernormal',
    ));
    $wp_customize->add_control('side_options_headerfix', array(
        'settings' => 'side_options_headerfix',
        'label' => 'ヘッダーの固定（スクロール追従）',
        'section' => 'global_settings__header',
        'type' => 'select',
        'choices' => array(
            'headernormal' => '固定しない（デフォルト）',
            'headerfix' => 'すべての端末で固定する',
            'headerfixpc' => 'PCでのみ固定する',
            'headerfixmobile' => 'スマートフォンでのみ固定する',
        ),
    ));

    // サイトヘッダー固定のactive_callback関数
    function callback_oc_headerfix($control)
    {
        if ($control->manager->get_setting('side_options_headerfix')->value() !== 'headernormal') {
            return true;
        } else {
            return false;
        }
    }
    $wp_customize->add_setting('option_scrollup_headerfix', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('option_scrollup_headerfix', array(
        'settings' => 'option_scrollup_headerfix',
        'label' => 'スクロールに応じて表示する',
        'description' => '<span style="font-size:11px;">下にスクロールで非表示 / 上にスクロールで表示',
        'section' => 'global_settings__header',
        'type' => 'checkbox',
        'active_callback' => 'callback_oc_headerfix',
    ));


    $wp_customize->add_setting('side_options_header_search2', array(
        'type'  => 'option',
        'default' => 'search_on',
    ));
    $wp_customize->add_control('side_options_header_search2', array(
        'settings' => 'side_options_header_search2',
        'label' => '検索 or お問い合わせアイコンの表示設定',
        'section' => 'global_settings__header',
        'type' => 'select',
        'choices' => array(
            'search_off' => '表示しない',
            'search_on' => '検索アイコンを表示',
            'contact_on' => 'お問い合わせアイコンを表示',
        ),
    ));

    // お問い合わせボタンの active_callback関数
    function callback_oc_contactlink($control)
    {
        if ($control->manager->get_setting('side_options_header_search2')->value() == 'contact_on') {
            return true;
        } else {
            return false;
        }
    }
    $wp_customize->add_setting('stk_contactpage_url');
    $wp_customize->add_control('stk_contactpage_url', array(
        'settings' => 'stk_contactpage_url',
        'label' => 'お問い合わせアイコンのリンク',
        'description' => 'リンクさせたいお問い合わせページなどのURLを入力してください。<span style="color:red;">※アイコンを表示する場合は必須</span>',
        'section' => 'global_settings__header',
        'active_callback' => 'callback_oc_contactlink',
    ));
    $wp_customize->add_setting('stk_contactpage_text', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_contactpage_text', array(
        'settings' => 'stk_contactpage_text',
        'label' => 'お問い合わせアイコン下のテキスト',
        'description' => 'デフォルト(CONTACT)を別の文字に置き換えます。',
        'section' => 'global_settings__header',
        'active_callback' => 'callback_oc_contactlink',
    ));

    $wp_customize->add_setting('side_options_header_btn_text_hide', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('side_options_header_btn_text_hide', array(
        'settings' => 'side_options_header_btn_text_hide',
        'label' => 'アイコン下の文字を非表示にする',
        'section' => 'global_settings__header',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_navbtn_menu_mode', array(
        'default' => '--modenormal',
    ));
    $wp_customize->add_control('stk_navbtn_menu_mode', array(
        'settings' => 'stk_navbtn_menu_mode',
        'label' => 'ハンバーガーメニューの表示方法',
        'section' => 'global_settings__header',
        'type' => 'radio',
        'choices' => array(
            '--modenormal' => '中央に表示',
            '--modeleft' => '左から表示',
            // '--moderight' => '右から表示',
        ),
    ));

    $wp_customize->add_setting('stk_gnav_size', array(
        'type'  => 'option',
        'default' => 'gnav_m',
    ));
    $wp_customize->add_control('stk_gnav_size', array(
        'settings' => 'stk_gnav_size',
        'label' => 'グローバルナビのサイズ（PC用）',
        'description' => 'グローバルナビのフォントサイズを変更できます。',
        'section' => 'global_settings__header',
        'type' => 'select',
        'choices' => array(
            'gnav_s' => 'S',
            'gnav_m' => 'M（デフォルト）',
            'gnav_l' => 'L',
            'gnav_custom' => 'カスタムサイズ',
        ),
    ));

    $wp_customize->add_setting('stk_gnav_size_custom', array(
        'type'  => 'option',
        'default' => '14',
        'sanitize_callback' => 'theme_slug_sanitize_number_range',
    ));
    $wp_customize->add_control('stk_gnav_size_custom', array(
        'settings' => 'stk_gnav_size_custom',
        'label' => 'カスタムサイズ',
        'description' => 'グローバルナビのサイズをpx単位で指定できます。',
        'section' => 'global_settings__header',
        'type' => 'number',
        'input_attrs' => array(
            'step'     => '1',
            'min'      => '2',
            'max'      => '50',
        ),
        'active_callback'    => 'callback_stk_customgnavsize',
    ));

    // カスタムフォントサイズの active_callback関数
    function callback_stk_customgnavsize($control)
    {
        if ($control->manager->get_setting('stk_gnav_size')->value() == 'gnav_custom') {
            return true;
        } else {
            return false;
        }
    }

    // SNSリンクの表示
    $wp_customize->add_setting('stk_facebooklink_url');
    $wp_customize->add_control('stk_facebooklink_url', array(
        'settings' => 'stk_facebooklink_url',
        'label' => 'Facebook',
        'section' => 'global_settings__header',
        'input_attrs' => array(
            'placeholder' => 'FacebookページのURLを入力'
        ),
    ));
    $wp_customize->add_setting('stk_twitterlink_url');
    $wp_customize->add_control('stk_twitterlink_url', array(
        'settings' => 'stk_twitterlink_url',
        'label' => 'X(Twitter)',
        'section' => 'global_settings__header',
        'input_attrs' => array(
            'placeholder' => 'X(Twitter)のURLを入力'
        ),
    ));
    $wp_customize->add_setting('stk_youtubelink_url');
    $wp_customize->add_control('stk_youtubelink_url', array(
        'settings' => 'stk_youtubelink_url',
        'label' => 'YouTube',
        'section' => 'global_settings__header',
        'input_attrs' => array(
            'placeholder' => 'YouTubeチャンネルのURLを入力'
        ),
    ));
    $wp_customize->add_setting('stk_instagramlink_url');
    $wp_customize->add_control('stk_instagramlink_url', array(
        'settings' => 'stk_instagramlink_url',
        'label' => 'Instagram',
        'section' => 'global_settings__header',
        'input_attrs' => array(
            'placeholder' => 'InstagramのURLを入力'
        ),
    ));
    $wp_customize->add_setting('stk_linelink_url');
    $wp_customize->add_control('stk_linelink_url', array(
        'settings' => 'stk_linelink_url',
        'label' => 'LINE',
        'section' => 'global_settings__header',
        'input_attrs' => array(
            'placeholder' => 'LINE公式アカウントのURLを入力'
        ),
    ));
    $wp_customize->add_setting('stk_tiktoklink_url');
    $wp_customize->add_control('stk_tiktoklink_url', array(
        'settings' => 'stk_tiktoklink_url',
        'label' => 'TikTok',
        'section' => 'global_settings__header',
        'input_attrs' => array(
            'placeholder' => 'TikTokのURLを入力'
        ),
    ));

    $wp_customize->add_setting('stk_snslinks_pc_hide');
    $wp_customize->add_control('stk_snslinks_pc_hide', array(
        'settings' => 'stk_snslinks_pc_hide',
        'label' => 'PCで非表示にする',
        'section' => 'global_settings__header',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_snslinks_sp_hide');
    $wp_customize->add_control('stk_snslinks_sp_hide', array(
        'settings' => 'stk_snslinks_sp_hide',
        'label' => 'スマホで非表示にする',
        'section' => 'global_settings__header',
        'type' => 'checkbox',
    ));

    // ---------------------------------------------
    // ヘッダー下お知らせテキスト

    $wp_customize->add_setting('other_options_headerundertext', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('other_options_headerundertext', array(
        'settings' => 'other_options_headerundertext',
        'label' => 'お知らせテキスト',
        'section' => 'global_settings__headerunder',
    ));

    $wp_customize->add_setting('other_options_headerunderlink', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('other_options_headerunderlink', array(
        'settings' => 'other_options_headerunderlink',
        'label' => 'リンクURL',
        'section' => 'global_settings__headerunder',
    ));

    $wp_customize->add_setting('other_options_headerunderlink_target', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('other_options_headerunderlink_target', array(
        'settings' => 'other_options_headerunderlink_target',
        'label' => 'リンクを別タブで開く（_target設定）',
        'section' => 'global_settings__headerunder',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('other_options_headerundertext_color', array(
        'default' => '#ffffff',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'other_options_headerundertext_color', array(
        'settings' => 'other_options_headerundertext_color',
        'label' => 'お知らせテキスト色',
        'section' => 'global_settings__headerunder',
    )));

    $wp_customize->add_setting('other_options_headerunderlink_bgcolor', array(
        'default' => '#f55e5e',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'other_options_headerunderlink_bgcolor', array(
        'settings' => 'other_options_headerunderlink_bgcolor',
        'label' => 'お知らせ背景色',
        'section' => 'global_settings__headerunder',
    )));
    
    $wp_customize->add_setting('other_options_headerunderlink_bgcolor2', array(
        'default' => '',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'other_options_headerunderlink_bgcolor2', array(
        'settings' => 'other_options_headerunderlink_bgcolor2',
        'label' => '背景色の追加',
        'description' => '<span style="font-size:11px;">お知らせ背景色をグラデーション化できます。</span>',
        'section' => 'global_settings__headerunder',
    )));

    // ---------------------------------------------
    //　コンテンツエリア

    $wp_customize->add_setting('inner_content_layout', array(
        'type'  => 'option',
        'default' => 'content_layer',
    ));
    $wp_customize->add_control('inner_content_layout', array(
        'settings' => 'inner_content_layout',
        'label' => 'コンテンツエリアの表示スタイル（PC用）',
        'section' => 'global_settings__sitelayout',
        'type' => 'radio',
        'choices' => array(
            'content_layer' => 'レイヤー',
            'content_flat' => 'フラット',
        ),
    ));

    $wp_customize->add_setting('stk_mainwidth_option', array(
        'type'  => 'option',
        'default' => '728px',
    ));
    $wp_customize->add_control('stk_mainwidth_option', array(
        'settings' => 'stk_mainwidth_option',
        'label' => 'メインカラムの横幅（PC用）',
        'description' => '【※1】「やや幅広」では、サイドバーの横幅が縮小される場合があります。',
        'section' => 'global_settings__sitelayout',
        'type' => 'select',
        'choices' => array(
            '692px' => 'やや幅狭',
            '728px' => '基本サイズ（デフォルト）',
            '764px' => 'やや幅広（※1）',
        ),
    ));

    $wp_customize->add_setting('side_options_sidebarlayout', array(
        'type'  => 'option',
        'default' => 'sidebarright',
    ));
    $wp_customize->add_control('side_options_sidebarlayout', array(
        'settings' => 'side_options_sidebarlayout',
        'label' => 'メインカラム表示位置（PC用）',
        'section' => 'global_settings__sitelayout',
        'type' => 'radio',
        'choices' => array(
            'sidebarright' => 'メインカラム左側',
            'sidebarleft' => 'メインカラム右側',
        ),
    ));

    //--------------------------------------------------
    // パンくずナビゲーション

    $wp_customize->add_setting('pannavi_position', array(
        'type'  => 'option',
        'default' => 'pannavi_on_bottom',
    ));
    $wp_customize->add_control('pannavi_position', array(
        'settings' => 'pannavi_position',
        'label' => 'パンくずナビの表示',
        'section' => 'global_settings__breadcrumb',
        'type' => 'select',
        'choices' => array(
            'pannavi_on' => '表示する（ページ上部）',
            'pannavi_on_bottom' => '表示する（ページ下部）',
            'pannavi_off' => '表示しない',
        ),
    ));

    //--------------------------------------------------
    // スクロール追従ボタン

    $wp_customize->add_setting('advanced_pagetop_btn', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('advanced_pagetop_btn', array(
        'label' => 'ページトップへ戻るボタンの表示',
        'settings' => 'advanced_pagetop_btn',
        'section' => 'global_settings__pagetop_btn',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'off' => '表示しない',
        ),
    ));

    $wp_customize->add_setting('stk_pt_fixbtntext', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_pt_fixbtntext', array(
        'settings' => 'stk_pt_fixbtntext',
        'label' => 'ページトップへ戻るボタンのテキスト',
        'section' => 'global_settings__pagetop_btn',
    ));

    // 固定フッターメニュー
    $wp_customize->add_setting('stk_fix_footer_color', array(
        'type'  => 'option',
        'default' => 'default',
    ));
    $wp_customize->add_control('stk_fix_footer_color', array(
        'settings' => 'stk_fix_footer_color',
        'label' => '固定フッターメニューの色（スマホ用）',
        'section' => 'global_settings__pagetop_btn',
        'type' => 'select',
        'choices' => array(
            'default' => 'デフォルト',
            '--style-headercolor' => 'ヘッダーの色に合わせる',
            '--style-footercolor' => 'フッターの色に合わせる',
        ),
    ));
    
    $wp_customize->add_setting('stk_fix_footer_spnavi', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_fix_footer_spnavi', array(
        'settings' => 'stk_fix_footer_spnavi',
        'label' => '[メニュー]を表示しない',
        'section' => 'global_settings__pagetop_btn',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_fix_footer_snslinks', array(
        'type'  => 'option',
        'default' => true,
    ));
    $wp_customize->add_control('stk_fix_footer_snslinks', array(
        'settings' => 'stk_fix_footer_snslinks',
        'label' => '[SNS]を表示しない',
        'section' => 'global_settings__pagetop_btn',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_fix_footer_search', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_fix_footer_search', array(
        'settings' => 'stk_fix_footer_search',
        'label' => '[検索]を表示しない',
        'section' => 'global_settings__pagetop_btn',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_fix_footer_pagetop', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_fix_footer_pagetop', array(
        'settings' => 'stk_fix_footer_pagetop',
        'label' => '[トップへ]を表示しない',
        'section' => 'global_settings__pagetop_btn',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_fix_footer_textnone', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_fix_footer_textnone', array(
        'settings' => 'stk_fix_footer_textnone',
        'label' => 'アイコン下のテキストを表示しない',
        'section' => 'global_settings__pagetop_btn',
        'type' => 'checkbox',
    ));
    
    //--------------------------------------------------
    // ウィジェット関連設定

    $wp_customize->add_setting('stk_widget_options_ttl', array(
        'type'  => 'option',
        'default' => 'w_default',
    ));
    $wp_customize->add_control('stk_widget_options_ttl', array(
        'settings' => 'stk_widget_options_ttl',
        'label' => 'メインサイドバーの見出しデザイン',
        'description' => 'メインサイドバーウィジェットの見出し装飾のデザインを選択できます。',
        'section' => 'global_settings__widget',
        'type' => 'select',
        'choices' => array(
            'w_default' => 'シンプル（デフォルト）',
            'w_border' => 'ボーダー：下',
            'w_bycolor' => 'ボーダー：下（バイカラー）',
            'w_dotted' => 'ボーダー：下（点線）',
            'w_borderleft' => 'ボーダー：左',
            'w_stitch' => 'ステッチ',
            'w_stripe' => 'ストライプ',
            'w_stylenone' => 'スタイルなし',
        ),
    ));

    $wp_customize->add_setting('stk_widget_options_ttlgf', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_widget_options_ttlgf', array(
        'settings' => 'stk_widget_options_ttlgf',
        'label' => 'ウィジェットタイトルにGoogleフォント(欧文)を適用しない',
        'section' => 'global_settings__widget',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('side_options_cataccordion', array(
        'type'  => 'option',
        'default' => 'accordion_on',
    ));
    $wp_customize->add_control('side_options_cataccordion', array(
        'settings' => 'side_options_cataccordion',
        'label' => 'サブカテゴリー（副項目）の階層化',
        'description' => 'ウィジェット（カテゴリーとナビゲーションメニュー）のサブカテゴリー（副項目）の展開表示/折りたたみ表示を切り替えられます。',
        'section' => 'global_settings__widget',
        'type' => 'select',
        'choices' => array(
            'accordion_on' => 'サブカテゴリー(副項目)を折りたたむ',
            'accordion_off' => 'サブカテゴリー(副項目)を展開する',
        ),
    ));

    $wp_customize->add_setting('stk_widget_options_footerfixed', array(
        'type'  => 'option',
        'default' => 'footerfixed',
    ));
    $wp_customize->add_control('stk_widget_options_footerfixed', array(
        'settings' => 'stk_widget_options_footerfixed',
        'label' => 'フッター上の固定（スクロール追従）',
        'description' => 'フッター上（PC表示用・スマホ表示用）のウィジェットエリアを画面下部に固定表示できます。',
        'section' => 'global_settings__widget',
        'type' => 'select',
        'choices' => array(
            'footernormal' => '固定しない',
            'footerfixed' => '固定する（デフォルト）',
            'footerfixed_pc' => 'PC用のみ固定する',
            'footerfixed_sp' => 'スマホ用のみ固定する',
        ),
    ));

    $wp_customize->add_setting('stk_widget_options_footertop', array(
        'type'  => 'option',
        'default' => '--style-col-three',
    ));
    $wp_customize->add_control('stk_widget_options_footertop', array(
        'settings' => 'stk_widget_options_footertop',
        'label' => 'フッターのレイアウト（PC用）',
        'description' => 'フッターウィジェットの列（カラム）を変更できます。',
        'section' => 'global_settings__widget',
        'type' => 'select',
        'choices' => array(
            '--style-col-two' => '2カラム',
            '--style-col-three' => '3カラム',
            '--style-flex' => 'フレックス（全て並列）',
        ),
    ));

    $wp_customize->add_setting('stk_mobilepage_sidebar_none', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_mobilepage_sidebar_none', array(
        'settings' => 'stk_mobilepage_sidebar_none',
        'label' => '1カラムページにサイドバーウィジェットを表示しない（モバイル用の設定）',
        'description' => 'サイドバーなし（1カラム）テンプレートを適用している場合は、<b>モバイルでもサイドバーウィジェットを非表示</b>にします。',
        'section' => 'global_settings__widget',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_widget_guide_none', array(
        'type'  => 'option',
    ));
    $wp_customize->add_control('stk_widget_guide_none', array(
        'settings' => 'stk_widget_guide_none',
        'label' => 'ウィジェットエリアに関する案内メッセージを非表示にする',
        'section' => 'global_settings__widget',
        'type' => 'checkbox',
    ));

    // ---------------------------------------------
    //　フォント設定

    $wp_customize->add_setting('stk_basefontfamily', array(
        'default' => 'default',
    ));
    $wp_customize->add_control('stk_basefontfamily', array(
        'settings' => 'stk_basefontfamily',
        'label' => 'ベースフォント',
        'section' => 'global_settings__font',
        'type' => 'select',
        'choices'  => array(
            'default' => '游ゴシック体ベース（デフォルト）',
            'hiragino' => 'ヒラギノ角ゴ、メイリオベース',
            'yumincyo' => '明朝体ベース',
            'notojp' => 'Noto Sans JP（Googleフォント）',
            'bizud' => 'BIZ UDPGothic（Googleフォント）',
        ),
    ));

    $wp_customize->add_setting('side_options_googlefontinclude', array(
        'type'  => 'option',
        'default' => 'gf_Concert',
    ));
    $wp_customize->add_control('side_options_googlefontinclude', array(
        'settings' => 'side_options_googlefontinclude',
        'label' => 'Googleフォント(欧文)の読み込み',
        'section' => 'global_settings__font',
        'type' => 'radio',
        'choices' => array(
            'gf_Concert' => 'Concert',
            'gf_Quicksand' => 'Quicksand',
            'gf_Roboto' => 'Roboto',
            'gf_UbuntuCon' => 'UbuntuCon',
            'gf_Lora' => 'Lora',
            'gf_Lobster' => 'Lobster Two',
            'gf_Catamaran' => 'Catamaran',
            'gf_StickNoBills' => 'Stick No Bills',
            'gf_none' => 'Googleフォント(欧文)を読み込まない',
        ),
    ));

    $wp_customize->add_setting('stk_basefontsize_pc', array(
        'default' => '103%',
    ));
    $wp_customize->add_control('stk_basefontsize_pc', array(
        'settings' => 'stk_basefontsize_pc',
        'label' => 'フォントサイズ（PC用）',
        'description' => '画面幅768px以上の場合のベースフォントサイズ',
        'section' => 'global_settings__font',
        'type' => 'select',
        'choices'  => array(
            '103%' => 'デフォルトサイズ',
            '14px' => '14px',
            '15px' => '15px',
            '16px' => '16px',
            '17px' => '17px',
            '18px' => '18px',
            '19px' => '19px',
            '20px' => '20px',
        ),
    ));

    $wp_customize->add_setting('stk_basefontsize_sp', array(
        'default' => '103%',
    ));
    $wp_customize->add_control('stk_basefontsize_sp', array(
        'settings' => 'stk_basefontsize_sp',
        'label' => 'フォントサイズ（スマホ用）',
        'description' => '画面幅767px以下の場合のベースフォントサイズ',
        'section' => 'global_settings__font',
        'type' => 'select',
        'choices'  => array(
            '103%' => 'デフォルトサイズ',
            '14px' => '14px',
            '15px' => '15px',
            '16px' => '16px',
            '17px' => '17px',
            '18px' => '18px',
        ),
    ));
    
    //--------------------------------------------------
    // 構造化データ設定

    $wp_customize->add_setting(
        'stk_jsonld_display',
        array(
            'default' => 'off',
        )
    );
    $wp_customize->add_control('stk_jsonld_display', array(
        'settings' => 'stk_jsonld_display',
        'label' => '構造化データの出力',
        'section' => 'global_settings__richresults',
        'type' => 'select',
        'choices' => array(
            'on' => '出力する',
            'off' => '出力しない',
        ),
    ));

    $wp_customize->add_setting(
        'stk_publisher_type',
        array(
            'default' => 'Organization',
        )
    );
    $wp_customize->add_control('stk_publisher_type', array(
        'settings' => 'stk_publisher_type',
        'label' => '運営者のタイプ（@type）',
        'section' => 'global_settings__richresults',
        'type' => 'select',
        'choices' => array(
            'Organization' => '組織（Organization）',
            'Person' => '個人（Personal）',
        ),
    ));

    $wp_customize->add_setting('stk_publisher_name');
    $wp_customize->add_control('stk_publisher_name', array(
        'settings' => 'stk_publisher_name',
        'label' => '運営者の名前（name）',
        //'description' => '企業名や団体名またはサイト名など',
        'section' => 'global_settings__richresults',
    ));

    $wp_customize->add_setting('stk_publisher_url');
    $wp_customize->add_control('stk_publisher_url', array(
        'settings' => 'stk_publisher_url',
        'label' => '運営者のURL（url）',
        'input_attrs' => array(
            'placeholder' => 'https://example.com'
        ),
        'section' => 'global_settings__richresults',
    ));

    $wp_customize->add_setting('stk_publisher_sameas');
    $wp_customize->add_control('stk_publisher_sameas', array(
        'label' => '運営者の関連URL（sameAs）',
        'input_attrs' => array(
            'placeholder' => 'https://example.com'
        ),
        'description' => '複数入力する場合は改行で区切ってください。',
        'settings' => 'stk_publisher_sameas',
        'section' => 'global_settings__richresults',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting(
        'stk_publisher_logo'
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'stk_publisher_logo',
            array(
                'settings'   => 'stk_publisher_logo',
                'label'        => '運営者のロゴ（logo）',
                'section'    => 'global_settings__richresults',
            )
        )
    );

    if (is_plugin_active('wordpress-seo/wp-seo.php')) {// Yoast SEOプラグインが有効な場合
        $wp_customize->add_setting('stk_remove_other_jsonld_yoast');
        $wp_customize->add_control('stk_remove_other_jsonld_yoast', array(
            'settings' => 'stk_remove_other_jsonld_yoast',
            'label' => 'YoastSEOの構造化データを取り除く',
            // 'description' => 'YoastSEOプラグインが出力するJSON-LDを取り除きます。',
            'section' => 'global_settings__richresults',
            'type' => 'checkbox',
        ));
    }

    if (is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')) { // AIO SEOプラグインが有効な場合
        $wp_customize->add_setting('stk_remove_other_jsonld_aioseo');
        $wp_customize->add_control('stk_remove_other_jsonld_aioseo', array(
            'settings' => 'stk_remove_other_jsonld_aioseo',
            'label' => 'All In One SEOの構造化データを取り除く',
            // 'description' => 'All In One SEOプラグインが出力するJSON-LDを取り除きます。',
            'section' => 'global_settings__richresults',
            'type' => 'checkbox',
        ));
    }
}
add_action('customize_register', 'opencage_global_customizer');


// ---------------------------------------------
// ver 3.10 にてヘッダーレイアウトの仕様を変更
// 過去にカスタマイザーで設定していたものとの整合性をとるための関数

function stk_header_layout_option_patch()
{
    // 既存のlayout設定をここに代入
    $h_position = get_option('side_options_headercenter', 'headerleft') !== 'headerleft' ? 'center' : 'left';
    $side_options_headerbg = get_option('side_options_headerbg', 'bgfull');
    if ($side_options_headerbg === 'bgnormal') {
        $h_size = 'normal';
    } elseif ($side_options_headerbg === 'bgfull_wide') {
        $h_size = 'wide';
    } else {
        $h_size = 'full';
    }
    return $h_position . '_' . $h_size;
}
