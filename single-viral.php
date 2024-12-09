<?php
/*
Template Name: バイラル風（1カラム）
Template Post Type: post
*/
?>

<?php get_header(); ?>

<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php if ( is_active_sidebar( 'addbanner-titletop' )) : ?>
<div class="wrap"><?php dynamic_sidebar( 'addbanner-titletop' ); ?></div>
<?php endif;?>

<header id="viral-header" class="article-header entry-header wp-block-cover has-background-dim has-background-dim-30">
<?php
	echo wp_get_attachment_image(
		get_post_thumbnail_id(), 
		'full', 
		false,
		array(
			'alt' => get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ),
			'class' => 'wp-block-cover__image-background',
			'loading' => false,
		)
	);
?>
<div class="wp-block-cover__inner-container">

<?php 
	stk_post_meta();
	stk_post_title();
?>

</div>
</header>


<div id="inner-content" class="fadeIn wrap viral">

<main id="main">

<?php stk_snsbutton(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<section class="entry-content cf">

<?php
	widget_single_titleunder();
	echo do_shortcode('[profile wrap="on" position="singlehead"]');

	the_content();
	stk_wp_link_pages();

	widget_single_contentunder();
?>

</section>

<?php stk_article_footer();?>

</article>

<?php get_template_part( 'parts/singlefoot' ); ?>

</main>
<?php get_sidebar(); ?>
</div>
<?php endwhile; ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>