<?php get_header(); 
  $price = get_field('product_price');
  $description = get_field('product_description');
  $image = get_field('product_image_group');
  $terms = get_the_terms( $post->ID, 'product_category' );
?>
<main class="site-body">
  <section class="product-detail">
    <h1 class="product-detail__heading"><?php the_title();?></h1>
    <?php if($terms):
      $category_names = array();
      foreach ( $terms as $term ) {
        $category_names[] = $term->name;
      }
    ?>
      <h2>
        Category: <?php echo implode( ', ', $category_names ); ?>
      </h2>
    <?php endif;?>

    <div class="product-detail__body">
      <?php if($image):?>
        <img 
          class="product-detail__image" 
          src="<?= $image['image'] ?>" 
          alt="<?= $image['alt_text'] ?>"
        >
      <?php endif;?>
      
      <div class="product-content">
        <p class="product-content__price">
          <?php if($price):?>
            $<?= $price ?>
          <?php endif;?>
        </p>
        <p class="product-content__description">
          <?php if($description):?>
            <?= $description ?>
          <?php endif;?>
        <a class="button" href="/products">
          Back To Products
        </a>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>