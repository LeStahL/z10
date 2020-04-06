<?php $postParentID=wp_get_post_parent_id(0);
  if ($postParentID) { ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($postParentID);?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo get_the_title($postParentID); ?> </a> <span class="metabox__main"><?php the_title();?></span></p>
    </div>
<?php } ?>