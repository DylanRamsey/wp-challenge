<?php
  $price = get_field('product_price');
  $description = get_field('product_description');
  $image = get_field('product_image_group');
?>

<div class="single-product">
  <a href="<?php echo the_permalink(); ?>">
    <?php if($image):?>
      <img 
        class="single-product__image" 
        src="<?= $image['image'] ?>" 
        alt="<?= $image['alt_text'] ?>"
      >
    <?php endif;?>
    <div class="single-product__content">
      <p><?php echo the_title(); ?></p>
      <?php if($price):?>
        <p>$<?= $price ?></p>
      <?php endif;?>
    </div>
  </a>
</div>