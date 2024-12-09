<?php

if(!function_exists('stk_add_stylesheet_archive_one_column')) {
	function stk_add_stylesheet_archive_one_column() {
        if (get_option('stk_archivelayout_onecolumn', 'sidebar_on') !== 'sidebar_none') {
			return;
        }
	$tag = '
@media only screen and (min-width: 980px) {
	.sidebar_none #main {
		margin: 0 auto;
		width: 100%;
		max-width: inherit;
	}
	.sidebar_none .archives-list.card-list::after,
	.sidebar_none .archives-list.card-list .post-list {
		width: calc(33.3333% - 1em);
	}
	.sidebar_none .archives-list.card-list::after {
		content: "";
	}
	.sidebar_none .archives-list:not(.card-list) {
		margin: 2em auto 0;
		max-width: 800px;
	}
}
';
		wp_add_inline_style('stk_style', minify_css($tag));
	}
	add_action('wp_enqueue_scripts', 'stk_add_stylesheet_archive_one_column');
}