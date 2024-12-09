<?php
  if ( post_password_required() || is_page() ) {
    return;
  }

if ( have_comments() ) {
  echo '<section id="comments">';
  echo '<h3 id="comments-title" class="comments-title">';
        comments_number();
  echo '</h3>';
  echo '<section class="commentlist">';

  wp_list_comments( array(
    'style'             => 'div',
    'avatar_size'       => 30,
    'reverse_children' => 'true',
  ) );

  echo '</section>';

  if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
    echo '<nav class="navigation comment-navigation">';
      echo '<div class="comment-nav-prev">' . previous_comments_link() . '</div>';
      echo '<div class="comment-nav-next">' . next_comments_link() . '</div>';
    echo '</nav>';
  }
  echo '</section>';
}
if (is_singular()) wp_enqueue_script("comment-reply");
comment_form();