<?php

if ( !defined( 'ABSPATH' ) ) exit;


// include function file
require_once( 'functions/ini.php' );
require_once( 'functions/include-css_js.php' );
require_once( 'functions/head.php' );
require_once( 'functions/admin.php' );
require_once( 'functions/editor.php' );
require_once( 'parts/main-parts.php' );
require_once( 'parts/header-parts.php' );
require_once( 'parts/single_page-parts.php' );
require_once( 'parts/home_header_custom_header.php' );
require_once( 'parts/home_header_slider.php' );
require_once( 'parts/breadcrumb.php' );
require_once( 'parts/footer-parts.php' );
require_once( 'parts/stk-sns-button.php' );
require_once( 'functions/widget.php' );
require_once( 'functions/shortcode.php' );
require_once( 'gutenberg/blocks-functions.php' );
require_once( 'functions/customizer/customizer.php' );
require_once( 'functions/blogparts.php' );
require_once( 'functions/jsonld.php' );
require_once( 'functions/classic-style-select.php' );
require_once( 'functions/libs/php-html-css-js-minifier.php' );

// update check
require_once( 'functions/libs/plugin-update-checker/plugin-update-checker.php' );
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$stk_update_checker = PucFactory::buildUpdateChecker(
    'https://open-cage.com/theme-update/stork19/update-info.json',
    __FILE__,
    'jstork19'
);
