<?php
/*
Template Name:フルワイド
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="content" class="lp-wrap fullwide fadeIn">
<div id="inner-content" class="wrap page-wide">
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