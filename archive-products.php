<?php get_header();?>
<main class="site-body">
  <section class="products">
    <h1 class="products__heading">Products</h1>
    <?php 
      $the_query = new WP_Query( array(
        'post_type' => 'products',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 3
      )); 
    ?> 
    <?php if ( $the_query->have_posts() ) : ?>
      <h2>Recently Added</h2>
      <div class="products__columns">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
          get_template_part('template-parts/all', 'products',
        );
        ?>
        <?php endwhile;?>
      </div>  
    <?php endif;?>
    <?php if ( have_posts() ) : ?>
      <h2>All Products</h2>
      <div class="products__columns">
        <?php while( have_posts() ) :
          the_post();
          get_template_part('template-parts/all', 'products'); 
        ?>
        <?php endwhile;?>
      </div>  
    <?php endif;?>
  </section>
</main>
<?php get_footer();?>