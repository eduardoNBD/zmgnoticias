<?php
  $posts = get_posts([
      'numberposts' => 4,
      'post_status' => 'publish',
      'orderby'     => 'date',
      'order'       => 'DESC'
  ]);

  if (empty($posts)) return;

  $featured = $posts[0];
  $others = array_slice($posts, 1, 3);
?>

<div class="mx-auto grid grid-cols-3 gap-6 flex items-center h-full">

  <!-- POST DESTACADO -->
  <div class=" mx-4 md:mx-0 col-span-3 md:col-span-2 relative rounded shadow-[0px_0px_5px_#00000055] overflow-hidden h-[500px]">
    <?php
      $thumb_id = get_post_thumbnail_id($featured->ID);
      $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
      echo "thumb_id ".$thumb_id." thumb_url ".$thumb_url;
    ?>
    <div 
      class="absolute inset-0 top-2 bg-cover bg-center"
      style="<?php echo $thumb_url ? "background-image: url('{$thumb_url}');" : 'background-color: #e5e7eb;'; ?>">
      <div class="absolute top-[20px] inset-0 bg-[#00000055]"></div>
    </div>

    <!-- Título superpuesto en la parte superior (pegado como en tu imagen) -->
    <div class="absolute top-0 left-0 right-0">
      <div class="bg-white rounded-t-lg p-3 shadow-sm">
        <h2 class="font-bold text-gray-800 line-clamp-2">
          <a href="<?php echo esc_url(get_permalink($featured->ID)); ?>">
            <?php echo esc_html($featured->post_title); ?>
          </a>
        </h2>
      </div>
    </div>

    <!-- Categorías (badges) en esquina inferior izquierda -->
    <div class="absolute bottom-4 left-4 flex flex-wrap gap-1">
      <?php
      $categories = get_the_category($featured->ID);
      if ($categories) {
        foreach ($categories as $cat) {
          $cat_link = get_category_link($cat->term_id);
          echo '<a href="' . esc_url($cat_link) . '" class="bg-[#1259aa] text-white text-xs px-2 py-1 rounded-full hover:underline">' . esc_html($cat->name) . '</a>';
        }
      }
      ?>
    </div>

    <!-- Vistas (ojo + número) en esquina inferior derecha -->
    <div class="absolute bottom-4 right-4 flex items-center gap-1 bg-black bg-opacity-60 text-white text-sm px-2 py-1 rounded-full">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
      <?=zmg_get_post_views($featured->ID);?>
    </div>
  </div>

  <!-- COLUMNAS DE ÚLTIMOS ARTÍCULOS -->
  <div class="col-span-3 md:col-span-1 flex flex-col gap-2 h-[700px] md:h-[500px]">
    <?php foreach ($others as $index => $post): ?>
      <?php
      $thumb_id = get_post_thumbnail_id($post->ID);
      $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'medium') : '';
      $categories = get_the_category($post->ID);
      $first_cat = !empty($categories) ? $categories[0]->name : '';
      ?>

      <div class="mx-4 md:mx-0 relative flex-1 rounded overflow-hidden shadow-[0px_0px_5px_#00000055]" style="<?php echo $thumb_url ? "background-image: url('{$thumb_url}'); background-size: cover; background-position: center;" : 'background-color: #f3f4f6;'; ?>">
        <div class="absolute inset-0 bg-[#00000055]"></div>
        <!-- Solo el primer post muestra "Últimos artículos" en la esquina superior izquierda -->
        <?php if ($index === 0): ?>
          <div class="absolute top-2 left-2">
            <span class="bg-blue-600 text-white text-sm font-medium px-2 py-1 rounded">
              Últimos artículos
            </span>
          </div>
        <?php endif; ?>

        <!-- Categoría + título en esquina inferior izquierda -->
        <div class="absolute bottom-2 left-2 text-white w-full">
          <?php if ($first_cat): ?>
            <?php $cat_link = get_category_link($categories[0]->term_id); ?>
            <a href="<?php echo esc_url($cat_link); ?>" class="bg-[#1259aa] text-white text-xs px-2 py-1 rounded inline-block mb-1 hover:underline">
              <?php echo esc_html($first_cat); ?>
            </a>
          <?php endif; ?>
          <h3 class="w-full font-semibold text-sm leading-tight max-w-[80%] line-clamp-2">
            <a class="inline-block" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
              <?php echo esc_html($post->post_title); ?>
            </a>
          </h3>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>