<?php 

	get_header();
	
	while(have_posts()){
		the_post();
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(images/ocean.jpg);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>Keep up with our latest news.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

	<?php the_content(); ?>


  <?php 
      $realtedPrograms = get_field('related_programs');
      if($realtedPrograms){
        echo "<hr class='section-break' />";
        echo "<h2 class='headline headline--medium' >Subject(s) Taught</h2>";
        echo "<ul class='link-list min-list'>";
        foreach ($realtedPrograms as $program) {
          
  ?>
        <li><a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program); ?></a></li>
  <?php 
        } 

        echo "</ul>";

      } 
  ?>

  </div>

<?php } get_footer();?>