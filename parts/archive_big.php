<?php if (have_posts()) :?>
<div class="archives-list big-list">
<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-list cf fadeIn'); ?>>
<header class="article-header">

<?php 
	echo stk_archives_entrytitle('big');
	echo stk_archives_post_meta('big'); 
?>

<?php if ( has_post_thumbnail() ) :?>
<figure class="eyecatch">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
<?php
	the_post_thumbnail();
	 if($pt_caption = get_post(get_post_thumbnail_id())->post_excerpt) {//caption
		 echo '<figcaption class="eyecatch-caption-text">'.$pt_caption.'</figcaption>';
	 }
?>
</a>
</figure>
<?php endif; ?>
</header>

<section class="archives-list-entry-content">
<?php echo stk_archives_description(); ?>
<div class="wp-block-button is-style-outline aligncenter"><a class="wp-block-button__link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">続きを読む</a></div>
</section>
</article>
<?php endwhile; ?>
</div>

<?php 
	elseif(is_search()):
		echo stk_archives_notfound();
	endif;
?>