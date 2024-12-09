<?php

if (!defined('ABSPATH')) {
    exit;
}

if(!function_exists('is_plugin_active')){
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if ( ! function_exists( 'is_plugin_active_amp' ) ) {
    function is_plugin_active_amp()
    {
        return is_plugin_active('amp/amp.php');
    }
}

if ( ! function_exists( 'stk_is_amp' ) ) {
	function stk_is_amp()
	{
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}
}

if ( ! function_exists( 'stk_is_fixheader' ) ) {
	function stk_is_fixheader()
	{
        return(
            get_option('side_options_headerfix', 'headernormal') == 'headerfix')
            || (get_option('side_options_headerfix', 'headernormal') == 'headerfixmobile' && is_mobile())
            || (get_option('side_options_headerfix', 'headernormal') == 'headerfixpc' && !is_mobile()
        );
	}
}
if ( ! function_exists( 'stk_is_headeroverlay' ) ) {
	function stk_is_headeroverlay()
	{
        return(
            get_option('stk_homeheader-headeroverlay', 'off') !== 'off' 
            && get_option('opencage_toppage_header_display', 'on') =='on'
            && is_front_page()
            && !is_paged()
            || is_page_template('page-wide-headeroverlay.php')
        );
	}
}

if (!function_exists('is_mobile')) {
    function is_mobile()
    {
        $useragents = array(
        'iPhone',
        'iPod',
        'Android.*Mobile',
        'Windows.*Phone',
        'dream',
        'CUPCAKE',
        'blackberry9500',
        'blackberry9530',
        'blackberry9520',
        'blackberry9550',
        'blackberry9800',
        'webOS',
        'incognito',
        'webmate'
    );
        $pattern = '/'.implode('|', $useragents).'/i';
        $useragent = '';
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $useragent = $_SERVER['HTTP_USER_AGENT'];
        }
        return preg_match($pattern, $useragent);
    }
}


// stk_do_action
function stk_hook_header_before() {
    do_action( 'stk_hook_header_before' );
}
function stk_hook_header_after() {
    do_action( 'stk_hook_header_after' );
}

function stk_hook_home_header_before() {
    do_action( 'stk_hook_home_header_before' ); // @3.0〜非推奨
}
function stk_hook_home_header_after() {
    do_action( 'stk_hook_home_header_after' ); // @3.0〜非推奨
}
function stk_hook_home_header() { // @3.0〜非推奨
    do_action( 'stk_hook_home_header' );
}

function stk_hook_footer_before() {
    do_action( 'stk_hook_footer_before' );
}
function stk_hook_sidebar() {
    do_action( 'stk_hook_sidebar' );
}

// wp_body_open
if (!function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

function double_explode($word1, $word2, $str) {
    $return = array();

    $array = explode($word1, $str);

    foreach ($array as $value) {
        $return = array_merge($return, explode($word2, $value));
    }
    return $return;
}
