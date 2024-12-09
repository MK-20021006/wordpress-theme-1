<?php

if (!defined('ABSPATH')) {
    exit;
}

// archive page settings
function opencage_archivepage_customizer($wp_customize)
{
    $wp_customize->add_section('archivepage_settings', array(
        'title'          => '記事一覧ページ設定',
        'priority'       => 15,
        //'description' => 'アーカイブページ（トップページ・カテゴリー・タグのページ等）のレイアウトなどを変更可能です。',
    ));

    $wp_customize->selective_refresh->add_partial(
        'stk_archivelayout_home',
        array(
            'selector' => '.archives-list',
        )
    );
    $wp_customize->add_setting('stk_archivelayout_home', array(
        'type'  => 'option',
        'default' => 'toplayout-card',
    ));
    $wp_customize->add_control('stk_archivelayout_home', array(
        'settings' => 'stk_archivelayout_home',
        'label' => 'PC:トップページ',
        'description' => 'フロントページ（最新の投稿）の記事一覧',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-overlay' => 'オーバーレイ',
            'toplayout-big' => 'ビッグ',
            'toplayout-text' => 'テキスト',
        ),
    ));

    $wp_customize->add_setting('stk_archivelayout', array(
        'type'  => 'option',
        'default' => 'toplayout-simple',
    ));
    $wp_customize->add_control('stk_archivelayout', array(
        'settings' => 'stk_archivelayout',
        'label' => 'PC:その他記事一覧ページ',
        'description' => 'カテゴリーページやタグページの記事一覧',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-overlay' => 'オーバーレイ',
            'toplayout-big' => 'ビッグ',
            'toplayout-text' => 'テキスト',
        ),
    ));

    $wp_customize->add_setting('stk_archivelayout_home_sp', array(
        'type'  => 'option',
        'default' => 'toplayout-simple',
    ));
    $wp_customize->add_control('stk_archivelayout_home_sp', array(
        'settings' => 'stk_archivelayout_home_sp',
        'label' => 'SP:トップページ',
        'description' => 'PC画面では確認できません。実機でご確認ください。',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-card2' => 'カード型（2カラム）',
            'toplayout-overlay' => 'オーバーレイ',
            'toplayout-big' => 'ビッグ',
            'toplayout-text' => 'テキスト',
        ),
    ));

    $wp_customize->add_setting('stk_archivelayout_sp', array(
        'type'  => 'option',
        'default' => 'toplayout-card',
    ));
    $wp_customize->add_control('stk_archivelayout_sp', array(
        'settings' => 'stk_archivelayout_sp',
        'label' => 'SP:その他記事一覧ページ',
        'description' => 'PC画面では確認できません。実機でご確認ください。',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-card2' => 'カード型（2カラム）',
            'toplayout-overlay' => 'オーバーレイ',
            'toplayout-big' => 'ビッグ',
            'toplayout-text' => 'テキスト',
        ),
    ));

    $wp_customize->add_setting('stk_archives_posthtag', array(
        'type'  => 'option',
        'default' => 'h1',
    ));
    $wp_customize->add_control('stk_archives_posthtag', array(
        'settings' => 'stk_archives_posthtag',
        'label' => '記事タイトルの見出しタグ',
        'description' => '記事一覧のタイトルに使用するタグを変更できます。',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'h1' => 'h1（デフォルト）',
            'h2' => 'h2',
            // 'h3' => 'h3',
            'div' => 'div',
        ),
    ));

    $wp_customize->add_setting('stk_thumbnail_size_ratio', array(
		'type'  => 'option',
		'default' => '62.5',
    ));
    $wp_customize->add_control('stk_thumbnail_size_ratio', array(
		'settings' => 'stk_thumbnail_size_ratio',
		'label' => 'サムネイル画像のサイズ比率',
		'section' => 'archivepage_settings',
		'type' => 'select',
		'choices' => array(
            '100'      => '1:1（正方形）',
            '62.5'     => '16:10（デフォルト）',
            '56.2'      => '16:9',
            '74.8'      => '4:3',
            '66.7'      => '3:2',
		),
	));

    $wp_customize->add_setting('eyecatch_border_radius', array(
        'type'  => 'option',
        'default' => false,
    ));
    $wp_customize->add_control('eyecatch_border_radius', array(
        'settings' => 'eyecatch_border_radius',
        'label' => 'サムネイル画像を角丸で表示する',
        'section' => 'archivepage_settings',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('stk_archive_description', array(
        'type'  => 'option',
        'default' => 'on',
    ));
    $wp_customize->add_control('stk_archive_description', array(
        'settings' => 'stk_archive_description',
        'label' => '抜粋文の表示',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'on' => '表示する',
            'on_home' => 'トップページで表示する',
            'on_archive' => 'その他記事一覧ページで表示する',
            'off' => '表示しない',
        ),
    ));
    // active_callback
    function callback_stk_excerpt_lines($control)
    {
        if ($control->manager->get_setting('stk_archive_description')->value() !== 'off') {
            return true;
        } else {
            return false;
        }
    }

    $wp_customize->add_setting('stk_excerpt_lines', array(
        'type'  => 'option',
        'default' => 'default',
    ));
    $wp_customize->add_control('stk_excerpt_lines', array(
        'settings' => 'stk_excerpt_lines',
        'label' => '抜粋文の行数',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'one-line' => '1行に制限する',
            'two-lines' => '2行に制限する',
            'three-lines' => '3行に制限する',
            'default' => '行数を制限しない',
        ),
        'active_callback' => 'callback_stk_excerpt_lines',
    ));

    $wp_customize->add_setting('stk_archives_noimg', array(
        'default' => get_theme_file_uri('/images/noimg.png'),
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'stk_archives_noimg', array(
        'settings'   => 'stk_archives_noimg',
        'label'        => 'NO IMAGE画像',
        'description' => 'アイキャッチ画像未設定の記事に表示します。',
        'section'    => 'archivepage_settings',
    )));

    $wp_customize->add_setting('post_new_mark', array(
        'type'  => 'option',
        'default' => '3',
    ));
    $wp_customize->add_control('post_new_mark', array(
        'settings' => 'post_new_mark',
        'label' => 'NEWマークの表示期間',
        'description' => '※NEWマークを表示しない場合は「0」を指定',
        'section' => 'archivepage_settings',
        'type' => 'number',
    ));

    $wp_customize->add_setting('post_new_mark_bgcolor', array(
        'default' => '#ff6347',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_new_mark_bgcolor', array(
        'settings' => 'post_new_mark_bgcolor',
        'label' => 'NEWマークラベル背景色',
        'section' => 'archivepage_settings',
    )));

    $wp_customize->add_setting('stk_archivelayout_onecolumn', array(
        'type'  => 'option',
        'default' => 'sidebar_on',
    ));
    $wp_customize->add_control('stk_archivelayout_onecolumn', array(
        'settings' => 'stk_archivelayout_onecolumn',
        'label' => '記事一覧ページの1カラム化（PC用）',
        'description' => '記事一覧ページをサイドバーなしの1カラムレイアウトに変更できます。',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'sidebar_on' => '2カラム',
            'sidebar_none' => '1カラム（サイドバーなし）',
        ),
    ));

    $wp_customize->add_setting('stk_home_exclusion_cat', array(
        'default' => '',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        // 'transport'   => 'postMessage',
    ));
    $wp_customize->add_control('stk_home_exclusion_cat', array(
        'settings' => 'stk_home_exclusion_cat',
        'label' => 'トップページの記事一覧から特定のカテゴリーを除外',
        'description' => '指定したカテゴリーIDの記事がトップページから除外されます。複数の場合は 1,3 のように ,（コンマ）または半角スペース区切りで指定。<a target="_blank" href="'. admin_url('edit-tags.php?taxonomy=category') . '">→カテゴリーIDを確認する</a>',
        'input_attrs' => array(
            'placeholder' => '例）1,125',
        ),
        'section' => 'archivepage_settings',
        'type' => 'text',
    ));

    $wp_customize->add_setting('stk_search_filter', array(
        'type'  => 'option',
        'default' => 'post',
    ));
    $wp_customize->add_control('stk_search_filter', array(
        'settings' => 'stk_search_filter',
        'label' => '検索結果に表示する投稿タイプ',
        'description' => 'サイト内検索の対象とする投稿タイプを設定できます。',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'post' => '投稿ページのみ',
            'post_page' => '投稿・固定ページ',
            'any' => 'すべての投稿タイプ',
        ),
    ));

    $wp_customize->add_setting('archivepage_prsetting', array(
        'type'  => 'option',
        'default' => 'write_off'
    ));
    $wp_customize->add_control('archivepage_prsetting', array(
        'settings' => 'archivepage_prsetting',
        'label' => '広告に関する表記',
        'description' => '記事一覧ページにアフィリエイトや広告を掲載していることを表記できます。',
        'section' => 'archivepage_settings',
        'type' => 'select',
        'choices' => array(
            'write_off' => '表記しない',
            'write_category' => '表記する（カテゴリーページ）',
            'write_tag' => '表記する（カテゴリー＆タグページ）'
        ),
    ));
}
add_action('customize_register', 'opencage_archivepage_customizer');
