<?php 

	get_header();
	
	while(have_posts()){
		the_post();
		pageBanner();
?>

  <div class="container container--narrow page-section">

  	<?php 
  	$theChildID = get_the_ID();
  	$theParentID = wp_get_post_parent_id($theChildID);
  	// echo "<br>The child ID = " . $theChildID;
  	// echo "<br>";
  	// echo "The parent ID = " . $theParentID;
   	if($theParentID){
    ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParentID); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParentID); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
   <?php } ?>
    
    <?php 
    	$hasChildren = get_pages(array(
    		"child_of" => get_the_ID()
    	));
    	if($theParentID or $hasChildren){
    ?>
	    <div class="page-links">
	      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParentID); ?>"><?php echo get_the_title($theParentID); ?></a></h2>
	      <ul class="min-list">
	        <?php 

	        	if($theParentID){
	        		$findChildrenOf = $theParentID;
	        	}else{
	        		$findChildrenOf = get_the_ID();
	        	}
	        	wp_list_pages(array(
	        		"title_li" => NULL,
	        		"child_of" => $findChildrenOf,
	        		"sort_column" => "menu_order"
	        	));
	        ?>
	      </ul>
	    </div>
	<?php } ?>

    <div class="generic-content">
      <p><?php the_content(); ?></p>
    </div>

  </div>

<?php
	}

	get_footer();

?>