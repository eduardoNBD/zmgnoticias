<div class="flex items-center"> 
  <span class="bg-[#eb2f21] mr-2 py-2 italic min-w-[120px] md:min-w-[160px] text-xs md:text-md flex items-center justify-center rounded">ÚLTIMAS NOTICIAS</span>

  <div class="overflow-hidden flex gap-2 marquee-container">   
    <div class="marquee flex items-center space-x-6 px-2"> 
      <?php
        $latest_posts = get_posts( array(
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        foreach ( $latest_posts as $post ) : 
            $time_ago = zmg_time_ago( $post->post_date );?> 
            <a href="<?=get_permalink($post->ID) ?>" class="px-2 text-white hover:bg-[#eb2f21] text-md transition rounded">
                <?php echo esc_html( $time_ago ); ?> | <?=$post->post_title; ?>
            </a>
        <?php endforeach;?> 
    </div> 
  </div>
</div>
 