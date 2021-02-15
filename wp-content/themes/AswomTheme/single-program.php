<?php 

	get_header();
	
	while(have_posts()){
    the_post();
    pageBanner();
?>

  <div class="container container--narrow page-section">
	<div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Programs Home</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

	<?php the_content(); ?>

    <?php 

             $relatedProfessors = new WP_Query(array(
              "post_type" => "professor",
              "orderby" => "title",
              "order" => "ASC",
              "meta_query" => array(
                array(
                  "key" => "related_programs",
                  "compare" => "LIKE",
                  "value" => '"'. get_the_ID() .'"',
                ),
              ),
            ));

      if($relatedProfessors->have_posts()){
            echo "<hr class='section-break' />";
            echo "<h1 class='headline headline--medium' >". get_the_title() ." Professors</h2>";

            echo '<ul class="professor-cards" >';

            while ($relatedProfessors->have_posts()) {
              # code...
              $relatedProfessors->the_post();
    ?>
          <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink(); ?>">
              <img src="<?php the_post_thumbnail_url('professorLabscape'); ?>" alt="" class="professor-card__image">
              <span class="professor-card__name"><?php the_title(); ?></span>
            </a>
          </li>

    <?php 
              } /* End relatedProfessors loop */
              echo '</ul>';
            
        } /* End relatedProfessors if condetion */

            wp_reset_postdata();  
            
            $today = date("Ymd");
            $upcomingEvents = new WP_Query(array(
              "posts_per_page" => 2,
              "post_type" => "event",
              "meta_key" => "event_date",
              "orderby" => "meta_value_num",
              "order" => "ASC",
              "meta_query" => array(
                array(
                  "key" => "event_date",
                  "compare" => ">=",
                  "value" => $today,
                  "type" => "numeric",
                ),
                array(
                  "key" => "related_programs",
                  "compare" => "LIKE",
                  "value" => '"'. get_the_ID() .'"',
                ),
              ),
            ));

      if($upcomingEvents->have_posts()){
            echo "<hr class='section-break' />";
            echo "<h1 class='headline headline--medium' >Upcoming ". get_the_title() ." Event</h2>";

            while ($upcomingEvents->have_posts()) {
              # code...
              $upcomingEvents->the_post();
              get_template_part("template-parts/content-event");
            }  /* End upcomingEvents loop */
      } /* End upcomingEvents if condetion */
    ?>

  </div>

<?php } get_footer(); ?>