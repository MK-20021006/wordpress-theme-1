<?php if (have_posts()) :?>
    <div class="archives-list text-list">
    
    <?php while (have_posts()) : the_post(); ?>
    
    <article <?php post_class('post-list fadeInDown'); ?>>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="post-list__link">
    
    <section class="archives-list-entry-content">
    <?php
        echo stk_archives_entrytitle();
        echo stk_archives_post_meta('text');
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