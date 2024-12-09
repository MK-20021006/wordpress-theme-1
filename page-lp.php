<?php
/*
Template Name:ランディングページ
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="content" class="lp-wrap fadeIn">
<?php stk_post_main_thum( get_the_ID(), $container_class = 'lp' ); ?>
<div id="inner-content" class="wrap page-full">
<main id="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<section class="entry-content cf">
<?php the_content(); ?>
</section>
</article>
</main>
</div>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>