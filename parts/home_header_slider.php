<?php

add_action('wp_enqueue_scripts', 'stk_home_slider_script');
function stk_home_slider_script() {
    // add_defer_to_enqueue_script が有効な場合はjsの読み込み位置をheadに移動
    $defer_boolean = get_option('advanced_js_defer', 'off') == 'on' ? false : true;

    // slick js
    if( (is_home() || is_front_page())
    && (get_option('stk_toppageslider_display','off') == 'on' )
    ){
        if( !stk_is_amp() ) 
        {
            wp_enqueue_script( 'slick-js', get_theme_file_uri('/js/slick.min.js'), array('jquery'), '1.5.9', $defer_boolean );

            // autoplay
            $autoplay = get_option('stk_slide_autoplay', 'on') !== 'off' ? 'autoplay: true,' : null;
            //　autoplaySpeed
            $autplay_speed = get_option('stk_slide_autoplayspeed', 3000);
            // centerPadding
            if (get_option('stk_toppageslider_padding', 'default') == 'medium') {
                $center_padding_pc = '100px';
                $center_padding_tb = '50px';
                $center_padding_sp = '10%';
            } elseif (get_option('stk_toppageslider_padding', 'default') == 'large') {
                $center_padding_pc = '0';
                $center_padding_tb = '0';
                $center_padding_sp = '2%';
            } else {
                $center_padding_pc = '20%';
                $center_padding_tb = '50px';
                $center_padding_sp = '20%';
            }
            // arrows
            $arrows = get_option('stk_toppageslider_arrows') ? 'arrows: false,' : null;
            //　dots
            $dots = get_option('stk_toppageslider_dots', 'on') !== 'off' ? 'dots: true,' : null;
            // variableWidth（オーバーレイでのみ出力）
            $variable_width = get_option('stk_toppageslider_style', 'default') == 'overlay' ? 'variableWidth: true,' : null;

            $slicktag = "
            jQuery(document).ready(function($) {
                $('.slickcar').slick({
                    " . $autoplay . "
                    autoplaySpeed: " . $autplay_speed . ",
                    pauseOnDotsHover: true,
                    speed: 360,
                    slidesToShow: 3,
                    centerPadding: '" . $center_padding_pc . "',
                    " . $arrows . "
                    " . $dots . "
                    " . $variable_width . "
                    
                    centerMode: true,

                    responsive: [
                        {
                            breakpoint: 1166,
                            settings: {
                                arrows: false,
                                centerPadding: '" . $center_padding_tb . "'
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                arrows: false,
                                slidesToShow: 1,
                                centerPadding: '" . $center_padding_sp . "'
                            }
                        }
                    ]
                });
            });";
            wp_add_inline_script('slick-js', minify_js($slicktag));
        }

        // slick css
        wp_enqueue_style('slick', get_theme_file_uri('/css/slick.min.css'));

    }
}

function home_header_slider() {
    if(get_option('stk_toppageslider_display', 'off') =='on'  && ( is_front_page() || is_home() )) {

        $args = array(
            'posts_per_page' => get_option('stk_toppageslider_postsnumber', '10'),
            'offset' => 0,
            'tag' => 'pickup',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => array('post','page'),
            'post_status' => 'publish',
            'suppress_filters' => true,
            'ignore_sticky_posts' => true,
            'no_found_rows' => true
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
        
            $s_size = get_option('stk_toppageslider_size', 'default');
            $s_style = get_option('stk_toppageslider_style', 'default');
            $slide_class = ($s_size == 'default') ? 'wrap' : 'slide_size-' . $s_size;
            if($s_style !== 'default') {
                $slide_class .= ' slide_style-' . $s_style;
            }
            if( stk_is_amp() ) {
                $slide_class .= ' amp_slide';
            }

            $output = '<div id="top_carousel" class="' . $slide_class . '">
                    <ul class="slickcar">';

            while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $output .= '<li class="top_carousel__li"><a href="' .get_permalink(). '" class="top_carousel__link">
                    <figure class="eyecatch of-cover">';
            $output .= skt_oc_post_thum();
            $output .= ($s_style !== 'overlay') ? stk_archivecatname(). '</figure>' : '</figure>';
            $output .= ($s_style == 'overlay') ? '<div class="slider_caption">' .stk_archivecatname() : '';
            $output .= '<h2 class="entry-title">' .get_the_title(). '</h2>';
            $output .= ($s_style == 'overlay') ? '</div>' : '';
            $output .= '</a></li>';
            }

            $output .= '</ul>
                </div>';
            
            echo $output;
        }
        wp_reset_postdata();
    }
}