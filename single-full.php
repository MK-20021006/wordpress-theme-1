<?php
/*
Template Name: フルサイズ（1カラム）
Template Post Type: post
*/
?>

<?php get_header(); ?>

<div id="content">

<div id="inner-content" class="fadeIn wrap page-full">

<main id="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php dynamic_sidebar( 'addbanner-titletop' ); ?>

<header class="article-header entry-header">

<?php 
	stk_post_meta();
	stk_post_title();
	stk_post_main_thum( get_the_ID() );
	stk_snsbutton(); 
?>

</header>

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

<?php endwhile; ?>
<?php endif; ?>
</main>
<?php get_sidebar(); ?>
</div>
</div>

<?php get_footer(); ?>