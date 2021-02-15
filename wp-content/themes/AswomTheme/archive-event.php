<?php 
  get_header();
  pageBanner(array(
    'title' => "All Events",
    'subtitle' => "See what is going on in our world.",
  ));
?>

  <div class="container container--narrow page-section">
          <?php 

            while (have_posts()) {
              # code...
              the_post();
              get_template_part("template-parts/content-event");
            }  
            echo paginate_links(); 
          ?>

          <hr class="section-break">
          <p>Looking for a recap of past event ? <a href="<?php echo site_url('/index.php/past-events'); ?>">Check out our past events archive.</a></p>
  </div>

<?php get_footer(); ?>