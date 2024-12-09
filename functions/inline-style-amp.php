<?php

if(!function_exists('stk_amp_inline_style')) {
	function stk_amp_inline_style() {
        if (stk_is_amp()) {
            $tag = '
			@media only screen and (min-width: 768px) {
				[class*="h_layout_pc_left_"] .site__logo amp-img img {
					object-position: left;
				}
			}
			@media only screen and (max-width: 767px) {
				.h_layout_sp_left .site__logo amp-img img{
					object-position: left;
				}
			}
			.site__logo .custom-logo *,
			.voice.l .icon * {
				width: auto;
			}
			.site__logo.fs_ss .custom-logo * {
				max-height: 18px;
			}
			.site__logo.fs_s .custom-logo * {
				max-height: 25px;
			}
			.site__logo.fs_m .custom-logo * {
				max-height: 35px;
			}
			.site__logo.fs_l .custom-logo * {
				max-height: 60px;
			}
			.site__logo.fs_ll .custom-logo * {
				max-height: inherit;
			}

			.amp_slide .slickcar{
				opacity: 1;
			}
			.amp_slide .slickcar {
				display: flex;
				overflow-x: auto;
				-webkit-overflow-scrolling: touch;
			}
			.amp_slide .top_carousel__li {
				width: 60%;
				max-width: 250px;
				flex: none;
			}
			
			.remodal-bg-close {
				width: 100vw;
				height: 100vh;
				position: absolute;
				top: 0;
				left: 0;
				background: none;
				opacity: 0;
				border: none;
			}
			.of-cover amp-img.amp-wp-enforced-sizes[layout="intrinsic"] > img {
				object-fit: cover;
			}
			#custom_header amp-img img,
			#custom_header_img amp-img img,
			#custom_header amp-video video,
			#custom_header_img amp-video video {
				object-fit: cover;
			}
			#custom_header_img a[fallback] {
				display:none;
			}
			amp-lightbox .remodal {
				display: block;
			}
			
			amp-lightbox#ampspnavibox,
			amp-lightbox#ampsearchbox {
				z-index: 100000;
			}
			
			.ampspnavibox-wrapper,
			.ampsearchbox-wrapper {
				background: rgba(43, 46, 56, 0.9);
			}
			
			.ampspnavibox-wrapper {
			height: 100%;
				overflow-y: scroll;
			}
			
			.ampspnavibox-wrapper .remodal {
			margin: 1em auto;
				width: calc(100% - 2em);
			}
			
			.ampsearchbox-wrapper {
				width: 100%;
				height: 100%;
				position: absolute;
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-webkit-box-align: center;
					-ms-flex-align: center;
						align-items: center;
				-webkit-box-pack: center;
					-ms-flex-pack: center;
						justify-content: center;
			}
			';
			if( !get_option('sns_button_facebook_app_id') ) {
				$tag .= '
					.sns_btn__li.facebook {
						display: none;
					}
				';
			}
            wp_add_inline_style('stk_style', $tag);
        }
	}
	add_action('wp_enqueue_scripts', 'stk_amp_inline_style');
}