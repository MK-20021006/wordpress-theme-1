<?php

if (!defined('ABSPATH')) {
    exit;
}

function stk_customize_register_seting($wp_customize)
{
    // CheckBox
    function theme_slug_sanitize_checkbox($checked)
    {
        return ((isset($checked) && true == $checked) ? true : false);
    }

    // 最大最小を設定
    function theme_slug_sanitize_number_range($number, $setting)
    {
        $number = absint($number);
        $atts = $setting->manager->get_control($setting->id)->input_attrs;
        $min = (isset($atts['min']) ? $atts['min'] : $number);
        $max = (isset($atts['max']) ? $atts['max'] : $number);
        $step = (isset($atts['step']) ? $atts['step'] : 1);
        return ($min <= $number && $number <= $max && is_int($number / $step) ? $number : $setting->default);
    }
}
add_action('customize_register', 'stk_customize_register_seting');

require_once('customizer-title_tagline.php');
require_once('customizer-global_settings.php');
require_once('customizer-colors.php');
require_once('customizer-toppage_settings.php');
require_once('customizer-archivepage_settings.php');
require_once('customizer-postpage_settings.php');
require_once('customizer-tagcode_settings.php');
require_once('customizer-blockeditor_settings.php');
require_once('customizer-detail_settings.php');
require_once('customizer-advanced_settings.php');
require_once('customizer-static_front_page.php');