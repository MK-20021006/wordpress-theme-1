<?php

// 目次の表示
add_action( 'admin_menu', 'add_postpage_toc' );
add_action( 'save_post', 'save_custom_field_postpage_toc' );

function add_postpage_toc() {
	add_meta_box(
        'toc_insertion',
        '[STORK19] 目次の表示',
        'html_toc_insertion_custom_box',
        array('post','page'),
        'side',
        'high'
    );
}
//setting panel
function html_toc_insertion_custom_box() {
	$post = isset($_GET['post']) ? $_GET['post'] :null;
	$toc_insertion = get_post_meta( $post, 'toc_insertion' );
	
	$stktoc = $toc_insertion ? $toc_insertion[0] : null;

    wp_nonce_field( 'wp-nonce-key', '_wp_nonce_toc_insertion' );
    ?>
    <div style="display:flex; flex-wrap:wrap; flex-direction:column; gap:10px;">
    <div><input name="toc_insertion" type="radio" value="none" <?php if( $stktoc=="" || $stktoc=="none" ): ?>checked="checked"<?php endif; ?>/>カスタマイザーの設定に従う</div>
    <div><input name="toc_insertion" type="radio" value="toc__display" <?php if( $stktoc=="toc__display" ): ?>checked="checked"<?php endif; ?>/>表示する</div>
    <div><input name="toc_insertion" type="radio" value="toc__hidden" <?php if( $stktoc=="toc__hidden" ): ?>checked="checked"<?php endif; ?>/>表示しない</div>
    </div>
    <?php
}
//save
function save_custom_field_postpage_toc( $post_id ) {

    // セキュリティのため追加
    if ( ! isset( $_POST['_wp_nonce_toc_insertion'] ) || ! $_POST['_wp_nonce_toc_insertion'] ) return;
    if ( ! check_admin_referer( 'wp-nonce-key', '_wp_nonce_toc_insertion' ) ) return;

	$tocdata = isset($_POST['toc_insertion']) ? $_POST['toc_insertion'] : null;

    if( "" == get_post_meta( $post_id, 'toc_insertion' )) {
		//toc_insertionというキーでデータが保存されていなかった場合、新しく保存
		add_post_meta( $post_id, 'toc_insertion', $tocdata, true ) ;
	} elseif( $tocdata != get_post_meta( $post_id, 'toc_insertion' )) {
		//toc_insertionというキーのデータと、現在のデータが不一致の場合、更新
		update_post_meta( $post_id, 'toc_insertion', $tocdata ) ;
	} elseif( "" == $tocdata ) {
		//現在のデータが無い場合、toc_insertionというキーの値を削除
		delete_post_meta( $post_id, 'toc_insertion' ) ;
	}
}
