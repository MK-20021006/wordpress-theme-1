<?php 

if ( !defined( 'ABSPATH' ) ) exit;

// meta tag
if(!function_exists('stk_meta')) {
	function stk_meta() {
		$pingback_url = get_bloginfo('pingback_url');
echo
'<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="pingback" href="' . $pingback_url . '">
';
	}
}

// Google Analytics

function meta_analytics() {
    if ( get_option( 'other_options_ga' ) ) {

        $analyticstag = get_option( 'other_options_ga' );

        if( stk_is_amp() ) {

            $analyticstag = get_option( 'other_options_ga_amp' ) ? get_option( 'other_options_ga_amp' ) : $analyticstag;

            $headanalytics = <<<EOM
<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<amp-analytics type="gtag" data-credentials="include">
<script type="application/json">
{
    "vars" : {
    "gtag_id": "{$analyticstag}",
    "config" : {
        "{$analyticstag}": { "groups": "default" }
    }
    }
}
</script>
</amp-analytics>
EOM;

        } else {

            $headanalytics = <<<EOM
<script async src="https://www.googletagmanager.com/gtag/js?id={$analyticstag}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{$analyticstag}');
</script>
EOM;

        }
        echo $headanalytics;
    }
}
add_action( 'wp_head', 'meta_analytics', 999);

// head tags
function meta_headtags() {
    $output = get_option( 'other_options_headcode' );
    $output .= get_option( 'other_options_adsense' );
    echo $output;
}
add_action( 'wp_head', 'meta_headtags' );

// first of body
function meta_bodytags() {
    $output = get_option( 'other_options_bodycode' );
    echo $output;
}
add_action( 'wp_body_open', 'meta_bodytags', 999);

// foot tags
function meta_foottags() {
    $output = get_option( 'other_options_footercode' );
    echo $output;
}
add_action( 'wp_footer', 'meta_foottags', 999);


// AMP head tags
function meta_amp_headtags() {
    if (stk_is_amp()) {
        $output = get_option('stk_amp_headcode');
        $output .= get_option('stk_amp_autoads_head');
        echo $output;
    }
}
add_action( 'wp_head', 'meta_amp_headtags' );

// AMP first of body
function meta_amp_bodytags() {
    if (stk_is_amp()) {
        $output = get_option('stk_amp_bodycode');
        $output .= get_option('stk_amp_autoads_body');
        echo $output;
    }
}
add_action( 'wp_body_open', 'meta_amp_bodytags', 999);

// AMP foot tags
function meta_amp_foottags() {
    if (stk_is_amp()) {
        $output = get_option('stk_amp_footercode');
        echo $output;
    }
}
add_action( 'wp_footer', 'meta_amp_foottags', 999);


// β版 検索結果にアイキャッチ画像を表示
function stk_google_search_thumbnail_tags()
{
	if(get_option('google_search_thumbnail', 'on') === 'off') {
		return;
	}
    if (is_singular() && has_post_thumbnail()) {
        $output = '<meta name="thumbnail" content="' .wp_get_attachment_url(get_post_thumbnail_id()). '" />'."\n";
		echo $output;
    }
}
add_action('wp_head', 'stk_google_search_thumbnail_tags');