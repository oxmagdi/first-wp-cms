<?php 
get_header();
pageBanner(array(
  'title' => "Past Events",
  'subtitle' => "See what is going on in our world.",
));
?>

  <div class="container container--narrow page-section">
          <?php 

          	$today = date("Ymd");
            $pastPageEvents = new WP_Query(array(
              "paged" => get_query_var("paged", 1),
              "post_type" => "event",
              "meta_key" => "event_date",
              "orderby" => "meta_value_num",
              "order" => "ASC",
              "meta_query" => array(
                array(
                  "key" => "event_date",
                  "compare" => "<",
                  "value" => $today,
                  "type" => "numeric",
                ),
              ),
            ));

            while ($pastPageEvents->have_posts()) {
              # code...
              $pastPageEvents->the_post();
              get_template_part("template-parts/content-event");
            }  
            echo paginate_links(array(
            	"total" => $pastPageEvents->max_num_pages,
            )); 
          ?>
  </div>

<?php get_footer(); ?>