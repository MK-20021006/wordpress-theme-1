<?php if (have_posts()) :

    $cardlayout = get_option('stk_archivelayout', 'toplayout-simple');
    $cardlayout_home = get_option('stk_archivelayout_home', 'toplayout-card');
    
    $cardlayout_sp = get_option('stk_archivelayout_sp', 'toplayout-card');
    $cardlayout_sp_home = get_option('stk_archivelayout_home_sp', 'toplayout-simple');
    
    if (is_mobile() && ($cardlayout_sp == 'toplayout-card2')){
        $archives_class = ' card-column2-sp';
	} elseif (is_mobile() && ($cardlayout_sp == 'toplayout-overlay')){
		$archives_class = ' card-overlay';
    } elseif (!is_mobile() && ($cardlayout == 'toplayout-overlay')){
        $archives_class = ' card-overlay';
    } else {
        $archives_class = null;
    }
    
    if (is_mobile() && (($cardlayout_sp_home == 'toplayout-card2')) ){
        $archives_class_home = ' card-column2-sp';
	} elseif (is_mobile() && ($cardlayout_sp_home == 'toplayout-overlay')){
		$archives_class_home = ' card-overlay';
    } elseif (!is_mobile() && ($cardlayout_home == 'toplayout-overlay')){
        $archives_class_home = ' card-overlay';
    } else {
        $archives_class_home = null;
    }
?>
<div class="archives-list card-list<?php if (!is_home()){ echo $archives_class; } elseif (is_home()){ echo $archives_class_home; } ?>">

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('post-list fadeInDown'); ?>>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="post-list__link">
<figure class="eyecatch of-cover">
<?php
	echo skt_oc_post_thum();
	echo stk_archivecatname();
?>
</figure>

<section class="archives-list-entry-content">
<?php 
	echo stk_archives_entrytitle();
	echo stk_archives_post_meta();
	echo stk_archives_description();
?>
</section>
</a>
</article>

<?php endwhile; ?>
</div>

<?php 
	elseif(is_search()):
		echo stk_archives_notfound();
	endif;
?>