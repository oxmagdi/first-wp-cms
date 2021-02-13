<?php get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(images/ocean.jpg);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All Programs</h1>
      <div class="page-banner__intro">
        <p>See what is going on in our world.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <ul class="link-list min-list">
          <?php 

            while (have_posts()) {
              # code...
              the_post();
          ?>
            <li><a href="<?php the_permalink();  ?>"><?php the_title(); ?></a></li>
          <?php }  
            echo paginate_links(); 
          ?>
    </ul>
  </div>

<?php get_footer(); ?>