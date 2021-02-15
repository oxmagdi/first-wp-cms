<?php 
get_header();
pageBanner(array(
  'title' => "All Programs",
  'subtitle' => "See what is going on in our world.",
));

?>

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