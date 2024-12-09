<?php
	
function stk_itemprop_position($position){
	return '<meta itemprop="position" content="'. $position .'" />';
}


// breadcrumb
if (!function_exists('breadcrumb')) {
	function breadcrumb(){
		
		if (is_home() || is_front_page() || is_admin()) {
			return;
        }
		
		$pannavi_position = get_option('pannavi_position', 'pannavi_on_bottom');
		
	    global $post;
	    $str ='';
		
        
		$i = 1;
		$bc_class= 'breadcrumb fadeIn ' . $pannavi_position;
		$str.= '<div id="breadcrumb" class="'.$bc_class.'">';
		$str.= '<div class="wrap"><ul class="breadcrumb__ul" itemscope itemtype="http://schema.org/BreadcrumbList">';
		$str.= '<li class="breadcrumb__li bc_homelink" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" itemprop="item" href="'. esc_url(home_url()) .'/"><span itemprop="name"> HOME</span></a>' . stk_itemprop_position($i) . '</li>';
		$i++;

		if(is_category()) {
			$cat = get_queried_object();
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" itemprop="item" href="'. get_category_link($ancestor) .'"><span itemprop="name">'. get_cat_name($ancestor) .'</span></a>' . stk_itemprop_position($i) . '</li>';
					$i++;
				}
			}
			$str.='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $cat -> name . '</span>' . stk_itemprop_position($i) . '</li>';
			
		} elseif ( is_post_type_archive() ) {
			$cpt = get_query_var( 'post_type' );
			$str.= '<li class="breadcrumb__li">' . get_post_type_object( $cpt )->label . '</li>';
			
		} elseif ( is_tax() ) {
			//taxonomy
			$query_obj = get_queried_object();
			$post_types = get_taxonomy( $query_obj->taxonomy )->object_type;
			$cpt = $post_types[0];
			$str.= '<li class="breadcrumb__li"><a class="breadcrumb__link" href="'. get_post_type_archive_link( $cpt ) . '"><span>'. get_post_type_object( $cpt )->label .'</span></a></li>';
			$taxonomy = get_query_var( 'taxonomy' );
			$term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
			if ( is_taxonomy_hierarchical( $taxonomy ) && $term->parent != 0 ) {
				$ancestors = array_reverse( get_ancestors( $term->term_id, $taxonomy ) );
				foreach ( $ancestors as $ancestor_id ) {
					$ancestor = get_term( $ancestor_id, $taxonomy );
					$str.='<li class="breadcrumb__li"><a class="breadcrumb__link" href="'. get_term_link( $ancestor, $term->slug ) .'"><span>'. $ancestor->name .'</span></a></li>';
				}
			}
			$str.='<li class="breadcrumb__li">'. $term->name .'</li>';
			
		} elseif(is_single()){
			$post_type = get_post_type( $post->ID );
			if ( $post_type == 'post' ) {
				// normal post
				$categories = get_the_category($post->ID);
				$cat = $categories[0];
				if($cat -> parent != 0){
					$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
					foreach($ancestors as $ancestor){
						$str.='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" itemprop="item" href="'. get_category_link($ancestor).'"><span itemprop="name">'. get_cat_name($ancestor). '</span></a>' . stk_itemprop_position($i) . '</li>';
						$i++;
					}
				}
				$str.='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" itemprop="item" href="'. get_category_link($cat -> term_id). '"><span itemprop="name">'. $cat-> cat_name . '</span></a>' . stk_itemprop_position($i) . '</li>';
				$i++;
				$str.= '<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="bc_posttitle"><span itemprop="name">'. $post -> post_title .'</span>' . stk_itemprop_position($i) . '</li>';
			} else {
				// custom post type
				$post_type_object = get_post_type_object( $post->post_type );
				if($post_type_object->has_archive !== false){
					$str.='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" itemprop="item" href="'. get_post_type_archive_link(get_post_type()) .'"><span itemprop="name">'. $post_type_object->labels->name .'</a></span>' . stk_itemprop_position($i) . '</li>';
				}
				$i++;
				$str.= '<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="bc_posttitle"><span itemprop="name">'. $post -> post_title .'</span>' . stk_itemprop_position($i) . '</li>';
			}
			
		} elseif(is_page()){
			if($post -> post_parent != 0 ){
				$ancestors = array_reverse(get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){
					$str.='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" itemprop="item" href="'. get_permalink($ancestor).'"><span itemprop="name">'. get_the_title($ancestor) .'</span></a>' . stk_itemprop_position($i) . '</li>';
					$i++;
				}
			}
			$str.= '<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="bc_posttitle"><span itemprop="name">'. $post -> post_title .'' . stk_itemprop_position($i) . '</span></li>';
			
		} elseif(is_date()){
			if( is_year() ){
				$str.= '<li class="breadcrumb__li">' . get_the_time('Y') . '年</li>';
			} else if( is_month() ){
				$str.= '<li class="breadcrumb__li"><a class="breadcrumb__link" href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
				$str.= '<li class="breadcrumb__li">' . get_the_time('n') . '月</li>';
			} else if( is_day() ){
				$str.= '<li class="breadcrumb__li"><a class="breadcrumb__link" href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
				$str.= '<li class="breadcrumb__li"><a class="breadcrumb__link" href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('n') . '月</a></li>';
				$str.= '<li class="breadcrumb__li">' . get_the_time('j') . '日</li>';
			}
			if(is_year() && is_month() && is_day() ){
				$str.= '<li class="breadcrumb__li">' . wp_title('', false) . '</li>';
			}
		} elseif(is_search()) {
			$str.='<li class="breadcrumb__li"><span>「'. get_search_query() .'」で検索した結果</span></li>';
		} elseif(is_author()){
			$str .='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span>' . stk_itemprop_position($i) . '</li>';
		} elseif(is_tag()){
			$str.='<li class="breadcrumb__li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">タグ : '. single_tag_title( '' , false ). '</span>' . stk_itemprop_position($i) . '</li>';
		} elseif(is_attachment()){
			$str.= '<li class="breadcrumb__li"><span>'. $post -> post_title .'</span></li>';
		} elseif(is_404()){
			$str.='<li class="breadcrumb__li">ページがみつかりません。</li>';
		} else{
			$str.='';
		}
		$str.='</ul></div>';
		$str.='</div>';
	
	    echo $str;
	}
}

// パンくずナビの実際の呼び出し
if (!function_exists('stk_breadcrumb_call')) {
    function stk_breadcrumb_call()
    {
		// ランディングページと表示しない設定の場合は何もしない
        $pannavi_position = get_option('pannavi_position', 'pannavi_on_bottom');
        if ($pannavi_position == 'pannavi_off' || is_page_template('page-lp.php')) {
            return;
        }

		// 上の場合
        if ($pannavi_position == 'pannavi_on') {
            add_action('stk_hook_header_after', 'breadcrumb');
        }
		
		//下の場合
        if ($pannavi_position == 'pannavi_on_bottom') {
            add_action('stk_hook_footer_before', 'breadcrumb');
        }
    }
    add_action('wp', 'stk_breadcrumb_call');
}
