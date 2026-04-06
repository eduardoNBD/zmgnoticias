<div class="relative w-full h-[70vh] md:h-[45vh] overflow-hidden" id="hero-slider">
  <?php
    $slider_posts = get_posts( array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
 
    foreach ( $slider_posts as $index => $post ) :
        $featured_img_url = get_the_post_thumbnail_url( $post->ID, 'full' );

        if ( ! $featured_img_url ) { 
            $featured_img_url = zmg_get_default_image_url();
        }
        $author_id = isset($post->post_author) ? (int) $post->post_author : 0;
        $author_name = $author_id ? get_the_author_meta('display_name', $author_id) : '';
        $author_url = $author_id ? get_author_posts_url($author_id) : '';
        $categories = get_the_category($post->ID);
        $first_cat = !empty($categories) ? $categories[0]->name : '';
        ?>
        <div class="slider-item absolute inset-0 transition-opacity duration-1000 opacity-100 z-10" style="background-image: url('<?php echo esc_url( $featured_img_url ); ?>'); background-size: cover; background-position: top center;">
        <!-- Overlay negro degradado -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
        <!-- Título centrado -->
        <div class="absolute bottom-0 left-0 right-0 text-center text-white pb-12 z-10">
            <div class="container mx-4 md:mx-auto"> 
                <?php if ($first_cat): ?>
                  <?php $cat_link = get_category_link($categories[0]->term_id); ?>
                  <a href="<?php echo esc_url($cat_link); ?>" class="bg-[#1259aa] text-white text-md italic px-4 py-1 rounded inline-block mb-1 hover:underline">
                    <?php echo esc_html($first_cat); ?>
                  </a>
                <?php endif; ?>
                <hr class="my-4">
                <a href="<?=get_permalink($post->ID) ?>" class="text-xl md:text-3xl font-bold px-4 text-shadow-md"><?=$post->post_title ?></a>
                <?php if ($author_url && $author_name) : ?>
                    <div class="mt-2 text-sm px-4">
                        <a href="<?= esc_url($author_url) ?>" class="hover:underline font-semibold"><?= esc_html($author_name) ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        </div>
        <?php
    endforeach; 
  ?>

  <!-- Botones de navegación (opcional) -->
  <button id="prev-btn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-[#1259aa] text-white w-14 h-14 z-20 flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
  </button>
  <button id="next-btn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-[#1259aa] text-white w-14 h-14 z-20 flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
  </button>

  <!-- Indicadores (puntos) -->
  <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
    <?php for ( $i = 0; $i < min( 3, count( $slider_posts ) ); $i++ ) : ?>
      <span class="slider-dot w-3 h-3 rounded-full bg-white/50 cursor-pointer <?php echo $i === 0 ? 'bg-white' : ''; ?>" data-index="<?php echo $i; ?>"></span>
    <?php endfor; ?>
  </div>
</div>

<style>
  #hero-slider {
    max-height: 80vh;
  }
  @media (min-width: 768px) {
    #hero-slider { height: 80vh; }
  }
</style> 