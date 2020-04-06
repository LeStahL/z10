<?php 
$testArray = get_pages(array(
  'child_of' => get_the_ID()
));
$theParent = wp_get_post_parent_id(get_the_ID());
    
if ($theParent or $testArray ) { ?>
  <div class="page-links">
    <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent);?>"><?php echo get_the_title($theParent) ?></a></h2>
    <ul class="min-list">
      <?php
      if($theParent) {
        $findChildrenOf = $theParent;
      } else{
        $findChildrenOf = get_the_ID();
      }

      wp_list_pages(array(
        'title_li' => NULL, 
        'child_of' => $findChildrenOf,
        'sort_column' => 'menu-order'
      ));
      ?>
    </ul>
  </div>
<?php } ?>

