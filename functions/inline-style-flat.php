<?php

if(!function_exists('stk_add_stylesheet_content_layout_flat')) {
	function stk_add_stylesheet_content_layout_flat() {
        if (get_option('inner_content_layout', 'content_layer') !== 'content_flat') {
			return;
        }
	$tag = '
    .content_flat .stk_header,
    .content_flat #inner-content,
    .content_flat #footer,
    .content_flat #breadcrumb,
    .content_flat #viral-header {
        box-shadow: none !important;
    }
    @media only screen and (min-width: 981px) {
        .content_flat #container {
            background-color: var(--inner-content-bg);
        }
        .content_flat #inner-content.wrap,
        .content_flat #inner-footer.wrap {
            max-width: calc(70px + var(--stk-wrap-width));
            margin-top: 0;
            margin-bottom: 0;
        }
    }
    @media only screen and (min-width: 1167px){
        #sidebar1 {
            min-width: 336px;
        }
    }
    ';
		wp_add_inline_style('stk_style', minify_css($tag));
	}
	add_action('wp_enqueue_scripts', 'stk_add_stylesheet_content_layout_flat');
}
