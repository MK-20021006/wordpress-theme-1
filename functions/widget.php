<?php
add_action( 'widgets_init', 'theme_register_sidebars' );
function theme_register_sidebars() {

	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'PC：メインサイドバー', 'stork19theme' ),
		//'description' => __( 'メインのサイドバーです。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'sp-contentfoot',
		'name' => __( 'SP：メインサイドバー（コンテンツ下）', 'stork19theme' ),
		'description' => __( '<b>スマホ表示用</b>：フッターエリアの上に表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'sidebar-sp',
		'name' => __( 'SP：ハンバーガーメニュー', 'stork19theme' ),
		'description' => __( 'ヘッダーのメニューボタンをタップして表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'side-fixed',
		'name' => __( 'PC：スクロール領域', 'stork19theme' ),
		'description' => __( '<b>PC表示用</b>：メインサイドバーの下に表示されます。（スクロール追従型）', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'addbanner-titletop',
		'name' => __( '共通：記事タイトル上', 'stork19theme' ),
		'description' => __( '記事タイトルの上に表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle gf"><span>',
		'after_title' => '</span></h2>',
	));

	register_sidebar(array(
		'id' => 'addbanner-sp-titleunder',
		'name' => __( 'SP：記事タイトル下', 'stork19theme' ),
		'description' => __( '<b>スマホ表示用</b>：記事タイトルの下に表示されます。Google AdSenseなどの広告の設置にも利用できます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'id' => 'addbanner-pc-titleunder',
		'name' => __( 'PC：記事タイトル下', 'stork19theme' ),
		'description' => __( '<b>PC表示用</b>：記事タイトルの下に表示されます。Google AdSenseなどの広告の設置にも利用できます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

    if (is_plugin_active_amp()) {
        register_sidebar(array(
			'id' => 'addbanner-amp-titleunder',
			'name' => __('AMP：記事タイトル下', 'stork19theme'),
			'description' => __('AMP表示のときのみ表示します。', 'stork19theme'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
    }

	register_sidebar(array(
		'id' => 'addbanner-sp-contentfoot',
		'name' => __( 'SP：記事コンテンツ下', 'stork19theme' ),
		'description' => __( '<b>スマホ表示用</b>：記事コンテンツの下に表示されます。Google AdSenseなどの広告の設置にも利用できます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'id' => 'addbanner-pc-contentfoot',
		'name' => __( 'PC：記事コンテンツ下', 'stork19theme' ),
		'description' => __( '<b>PC表示用</b>：記事コンテンツの下に表示されます。Google AdSenseなどの広告の設置にも利用できます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

    if (is_plugin_active_amp()) {
        register_sidebar(array(
			'id' => 'addbanner-amp-contentfoot',
			'name' => __('AMP：記事コンテンツ下', 'stork19theme'),
			'description' => __('AMP表示のときのみ表示します。', 'stork19theme'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
    }

	register_sidebar(array(
		'id' => 'home-top',
		'name' => __( 'PC：トップページ上部', 'stork19theme' ),
		'description' => __( '<b>PC表示用</b>：メインコンテンツの上に表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle"><span>',
		'after_title' => '</span></h2>',
	));

	register_sidebar(array(
		'id' => 'home-top_mobile',
		'name' => __( 'SP：トップページ上部', 'stork19theme' ),
		'description' => __( '<b>スマホ表示用</b>：メインコンテンツの上に表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle"><span>',
		'after_title' => '</span></h2>',
	));

	register_sidebar(array(
		'id' => 'home-bottom',
		'name' => __( 'PC：トップページ下部', 'stork19theme' ),
		'description' => __( '<b>PC表示用</b>：メインコンテンツの下に表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle"><span>',
		'after_title' => '</span></h2>',
	));

	register_sidebar(array(
		'id' => 'home-bottom_mobile',
		'name' => __( 'SP：トップページ下部', 'stork19theme' ),
		'description' => __( '<b>スマホ表示用</b>：メインコンテンツの下に表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle"><span>',
		'after_title' => '</span></h2>',
	));

	register_sidebar(array(
		'id' => 'before-footer-pc',
		'name' => __( 'PC：フッター上（画面下部固定）', 'stork19theme' ),
		'description' => __( '<b>PC表示用</b>：フッターの上（画面下部）に表示されます。カスタマイザーの【サイト全体の設定 > ウィジェット関連の設定】のオプションで、画面下部での固定を解除することもできます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget before_footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'before-footer-sp',
		'name' => __( 'SP：フッター上（画面下部固定）', 'stork19theme' ),
		'description' => __( '<b>スマホ表示用</b>：フッターの上（画面下部）に表示されます。カスタマイザーの【サイト全体の設定 > ウィジェット関連の設定】のオプションで、画面下部での固定を解除することもできます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget before_footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'footer1',
		'name' => __( 'PC：フッター', 'stork19theme' ),
		'description' => __( '<b>PC表示用</b>：フッターエリアに表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'footer-sp',
		'name' => __( 'SP：フッター', 'stork19theme' ),
		'description' => __( '<b>スマホ表示用</b>：フッターエリアに表示されます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle gf"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'cta',
		'name' => __( '共通：CTA設定', 'stork19theme' ),
		'description' => __( '記事コンテンツ下のColl To Actionとして利用できます。', 'stork19theme' ),
		'before_widget' => '<div id="%1$s" class="ctawidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));
}

//ウィジェット内でショートコードを使用可能に
add_filter('widget_text', 'do_shortcode');

// Remove category widget title
function remove_categories_widget_title( $cat_args ) {
    $cat_args['use_desc_for_title'] = 0;
    return $cat_args;
}
add_filter( 'widget_categories_args', 'remove_categories_widget_title' );

// カテゴリの投稿数をaタグの中に
add_filter( 'wp_list_categories', 'my_list_categories', 10, 2 );
function my_list_categories( $output, $args ) {
  $output = preg_replace('/<\/a>\s*\((\b\d{1,3}(,\d{3})*\b)\)/',' <span class="count">($1)</span></a>',$output);
  return $output;
}

// アーカイブの投稿数をaタグの中に
add_filter( 'get_archives_link', 'my_archives_link' );
function my_archives_link( $output ) {
  $output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' ($2)</a>',$output);
  return $output;
}

// 新着記事のフォーマットを変更
class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
	function widget($args, $instance) {
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 5;
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			echo $before_widget;
			if( $title ) echo $before_title . $title . $after_title; ?>
			<ul class="widget_recent_entries__ul">
				<?php while( $r->have_posts() ) : $r->the_post(); ?>
				<li class="widget_recent_entries__li">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="widget_recent_entries__link">
						<div class="widget_recent_entries__ttl ttl<?php echo stk_post_newmark();?>"><?php the_title(); ?></div>
						<?php if ( $show_date ) {
							echo stk_archivesdate();
						}?>
					</a>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php
			echo $after_widget;
		wp_reset_postdata();
		endif;
	}
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');


//画像付き新着記事ウィジェット追加
class NewEntryImageWidget extends WP_Widget {
    public function __construct() {
        parent::__construct(
			false,
			$name = '[STORK19] 最近の投稿',
			$widget_ops = array( 'description' => 'サムネイル画像付きの最近の投稿。' )
        );
    }
    function widget($args, $instance) {
        extract( $args );
        $title_new = "";
        $title_new = apply_filters( 'widget_title_new', empty($instance['title_new']) ? "" : $instance['title_new'] );
        $show = apply_filters( 'widget_entry_count', empty($instance['entry_count']) ? 5 : $instance['entry_count'] );
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : true;
		$date = ($show_date == true) ? 'on' : 'off';
        
		$sticky_posts = isset( $instance['sticky_posts'] ) ? $instance['sticky_posts'] : true;
		$ignore_sticky_posts = ($sticky_posts == true) ? ' ignore_sticky_posts="false"' : null;

		echo $args['before_widget'];
			
			if ($title_new) {
				echo $args['before_title'] . $title_new . $args['after_title'];
			}

			// ob_start();
				echo do_shortcode( '[postlist ttl="none" class="mode_widget" '.$ignore_sticky_posts.' show="'.$show.'" date="'.$date.'"]' );
			// return ob_get_clean();

		echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title_new'] = strip_tags($new_instance['title_new']);
		$instance['entry_count'] = strip_tags($new_instance['entry_count']);
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['sticky_posts'] = isset( $new_instance['sticky_posts'] ) ? (bool) $new_instance['sticky_posts'] : false;
        return $instance;
    }
    function form($instance) {
        $title_new = esc_attr( empty($instance['title_new']) ? "" : $instance['title_new'] );
        $entry_count = esc_attr( empty($instance['entry_count']) ? 5 : $instance['entry_count'] );
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
		$sticky_posts = isset( $instance['sticky_posts'] ) ? (bool) $instance['sticky_posts'] : true;
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title_new'); ?>">
          <?php _e( 'Title:' ); ?>
          </label>
          <input class="widefat" id="<?php echo $this->get_field_id('title_new'); ?>" name="<?php echo $this->get_field_name('title_new'); ?>" type="text" value="<?php echo $title_new; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('entry_count'); ?>">
          <?php _e( 'Number of posts to show:' ); ?>
          </label>
          <input class="tiny-text" id="<?php echo $this->get_field_id('entry_count'); ?>" name="<?php echo $this->get_field_name('entry_count'); ?>" type="number" value="<?php echo $entry_count; ?>" />
        </p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $sticky_posts ); ?> id="<?php echo $this->get_field_id( 'sticky_posts' ); ?>" name="<?php echo $this->get_field_name( 'sticky_posts' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'sticky_posts' ); ?>"><?php _e( '固定投稿を表示' ); ?></label>
		</p>


        <?php
    }
}
add_action('widgets_init', function(){ register_widget('NewEntryImageWidget'); });


// プロフィールウィジェット
class STK_ProfileWidget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			false,
			$name = '[STORK19] プロフィール',
			$widget_ops = array( 'description' => '[ユーザー > プロフィール]で設定したプロフィールを表示します。' )
		);
	}
	
	// from
	public function form($instance) {
		$profile_user = isset($instance['profile_user']) ? esc_attr($instance['profile_user']) : '';
		$media_image_id = isset($instance['media_image_id']) ? esc_attr($instance['media_image_id']) : '';

		$image = null;
		if ( is_numeric( $media_image_id ) ) {
			$image =  wp_get_attachment_image_src($instance['media_image_id'], 'full');
		}
		?>

		<p>
		<label for="<?php echo $this->get_field_id('profile_user'); ?>"><?php _e( 'ユーザーを選択:' ); ?></label>
			<select id="<?php echo $this->get_field_id('profile_user'); ?>" name="<?php echo $this->get_field_name('profile_user'); ?>">
			<option><?php _e( '— 選択 —' ); ?></option>
			<?php
			$users = get_users();
			foreach ( $users as $user ) {
			?>
			<option value="<?php echo $user->ID ?>" <?php selected($profile_user, $user->ID);?>><?php echo $user->display_name ?></option>
			<?php
			}
			?>
			</select>
		</p>
		<div class="_display" style="margin:8px 0;height:auto;">
			<?php if ( $image ) : ?>
				<img src="<?php echo esc_url( $image[0] ); ?>" style="width:100%;height:auto;" />
			<?php elseif ( !$image ) : ?>
				<label for="<?php echo $this->get_field_id('media_image_id'); ?>" style="border:1px dashed #c3c4c7;background:#f0f0f1;line-height:1.6;padding:9px 0;text-align:center;display:block;"><?php _e( '背景画像を追加' ); ?></label>
			<?php endif; ?>
		</div>
		<button class="button button-default button-block" onclick="javascript:stk_bg_image_addiditional(this);return false;" id="<?php echo $this->get_field_id('media_image_id'); ?>"><?php _e( '画像を選択' ); ?></button>
		<button class="button button-default button-block" onclick="javascript:stk_bg_image_delete(this);return false;"><?php _e( '画像を削除' ); ?></button>
		<div class="_form" style="margin-bottom:1em;line-height:2em">
			<input type="hidden" class="__id" name="<?php echo $this->get_field_name('media_image_id'); ?>" value="<?php echo esc_attr( $media_image_id ); ?>" />
		</div>

		<script type="text/javascript">
			// Register background image
			if ( stk_bg_image_addiditional == undefined ){
				var stk_bg_image_addiditional = function(e){
					// Preview area div
					var d=jQuery(e).parent().children("._display");
					// Input tag of save image id.
					var w=jQuery(e).parent().children("._form").children('.__id')[0];
					var u=wp.media({library:{type:'image'},multiple:false}).on('select', function(e){
						u.state().get('selection').each(function(f){
							d.children().remove();
							d.append(jQuery('<img style="width:100%;mheight:auto;">').attr('src',f.toJSON().url));
							jQuery(w).val(f.toJSON().id).change();
						});
					});
					u.open();
				};
			}
			// Function of Delete background image
			if ( stk_bg_image_delete == undefined ){
				var stk_bg_image_delete = function(e){
					// Preview area div
					var d=jQuery(e).parent().children("._display");
						// Input tag of save image id.
					var w=jQuery(e).parent().children("._form").children('.__id')[0];

					// Delete tag of preview img.
					d.children().remove();
					// w.attr("value","");
					jQuery(e).parent().children("._form").children('.__id').attr("value","").change();
				};
			}
		</script>
		<?php
	}

	// update
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['media_image_id'] = $new_instance['media_image_id'];
		$instance['profile_user'] = $new_instance['profile_user'];
		return $instance;
	}

	// widget
	public function widget($args, $instance) {
		$profile_user = isset($instance['profile_user']) ? esc_attr($instance['profile_user']) : '';
		$user = get_user_by('id', $profile_user);
		if (!$user) {
			return;
		}
		// 背景画像のURLを取得
		if ( !empty( $instance['media_image_id'] ) ) {
			$image = wp_get_attachment_image_src( $instance['media_image_id'], 'full' );
			$image = $image[0];
		} else {
			$image = null;
		}
		// 背景画像が設定されているなら値を出力
		if ( !empty( $image ) ) {
			$media_image_id = ' bgimg="' . esc_url( $image ) . '"';
		} elseif ( empty( $image ) ) {
			$media_image_id = '';
		}

		echo $args ['before_widget']; 
		    echo do_shortcode('[profile id="'.$profile_user.'"'.$media_image_id.']');
		echo $args['after_widget'];
	}
}
add_action('widgets_init', function(){ register_widget('STK_ProfileWidget'); });


// 目次ウィジェット
class STK_TocWidget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'stk_toc_widget',
			'[STORK19] 目次',
			array(
				'description' => '目次を表示します。'
			)
		);
	}

	//form出力
	public function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '', //初期値をココに入力
			)
		);
?>
<!--<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">タイトル</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
</p>-->
<p><?php _e('目次は投稿または固定ページでのみ表示されます。目次に関するオプションはカスタマイザーの【投稿・固定ページ設定 > 目次設定】にあります。','stork19theme'); ?></p>
<?php
	}

	//データ保存時の処理
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	//ウィジェットの出力
	public function widget( $args, $instance ) {
		if ( is_single() || is_page() ) {
			echo $args['before_widget'];
			//if ( $instance['title'] ) {
			//	echo $args['before_title'] . $instance['title'] . $args['after_title'];
			//}
			//ここでショートコードを実行
			echo do_shortcode('[stk_toc]');
			echo $args['after_widget'];
		}
	}
}
add_action('widgets_init', function(){ register_widget('STK_TocWidget'); });


// Home Widget
if (!function_exists('parts_add_top')) {
	function parts_add_top(){
		if ( is_front_page()&&!is_admin()){
			if ( is_active_sidebar( 'home-top_mobile' ) && is_mobile() ){
				echo '<div class="homeadd_wrap homeaddtop mobile">';
				dynamic_sidebar( 'home-top_mobile' );
				echo '</div>';
			}
			if ( is_active_sidebar( 'home-top' ) && !is_mobile() ){
				echo '<div class="homeadd_wrap homeaddtop">';
				dynamic_sidebar( 'home-top' );
				echo '</div>';
			}
		}
	}
}

if (!function_exists('parts_add_bottom')) {
	function parts_add_bottom(){
		if ( is_front_page()&&!is_admin()){
			if ( is_active_sidebar( 'home-bottom_mobile' ) && is_mobile() ){
				echo '<div class="homeadd_wrap homeaddbottom mobile">';
				dynamic_sidebar( 'home-bottom_mobile' );
				echo '</div>';
			}
			if ( is_active_sidebar( 'home-bottom' ) && !is_mobile() ){
				echo '<div class="homeadd_wrap homeaddbottom">';
				dynamic_sidebar( 'home-bottom' );
				echo '</div>';
			}
		}
	}
}

// 記事ページ用Widget

if (!function_exists('widget_single_titleunder')) {
	function widget_single_titleunder(){
		if ( is_active_sidebar( 'addbanner-amp-titleunder' ) && stk_is_amp()) {
			echo '<div class="add titleunder amp_widget">';
			dynamic_sidebar( 'addbanner-amp-titleunder' );
			echo '</div>';
			return;
		}

		if ( is_active_sidebar( 'addbanner-sp-titleunder' ) && is_mobile() ) {
			echo '<div class="add titleunder">';
			dynamic_sidebar( 'addbanner-sp-titleunder' );
			echo '</div>';
		}
		
		if ( is_active_sidebar( 'addbanner-pc-titleunder' ) && !is_mobile()) {
			echo '<div class="add titleunder">';
			dynamic_sidebar( 'addbanner-pc-titleunder' );
			echo '</div>';
		}
	}
}

if (!function_exists('widget_single_contentunder')) {
	function widget_single_contentunder(){
		if ( is_active_sidebar( 'addbanner-amp-contentfoot' ) && stk_is_amp()) {
			echo '<div class="add contentunder amp_widget">';
			dynamic_sidebar( 'addbanner-amp-contentfoot' );
			echo '</div>';
			return;
		}

		if ( is_active_sidebar( 'addbanner-sp-contentfoot' ) && is_mobile() ) {
			echo '<div class="add contentunder">';
			dynamic_sidebar( 'addbanner-sp-contentfoot' );
			echo '</div>';
		}
		
		if ( is_active_sidebar( 'addbanner-pc-contentfoot' ) && !is_mobile()) {
			echo '<div class="add contentunder">';
			dynamic_sidebar( 'addbanner-pc-contentfoot' );
			echo '</div>';
		}
	}
}


function stk_widget_cta(){
    if (
		!is_active_sidebar('cta')
		|| ( is_page() && !get_option('post_options_page_cta') )
	) {
		return;
    }
	
	echo '<div class="cta-wrap">';
	dynamic_sidebar( 'cta' );
	echo '</div>';
}
