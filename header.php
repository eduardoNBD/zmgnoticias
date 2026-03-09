<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta property="fb:admins" content="100079289360125" />
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="profile" href="https://gmpg.org/xfn/11"> 
    <link href="<?=ZMG_Theme_URL?>/style.css?v=<?=date('ymdhis')?>" rel="stylesheet" />
    <script async="" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9309651612334237" crossorigin="anonymous"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-gray-50 text-gray-900'); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site min-h-screen flex flex-col">
        <a class="skip-link screen-reader-text sr-only" href="#main">
            <?php _e('Saltar al contenido', 'ZMG_Theme'); ?>
        </a>

        <header class="">
            <div class="grid grid-cols-12 bg-[#212121] text-white">
                <div class="col-span-12 md:col-span-2 px-4 py-3 bg-[#1259aa] flex items-center justify-center md:justify-end">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold">
                        <?php bloginfo('name'); ?>
                    </a>
                </div>
                <div class="col-span-12 md:col-span-7 px-2 py-3 bg-[#282828]"> 
                  <?php get_ZMG_Theme_Post_Template('marquee'); ?>
                </div>
                <div class="col-span-12 md:col-span-3 px-4 flex justify-between md:justify-center gap-2"> 
                  <div class="flex items-center">
                    <h2 class="text-xl text-center py-2"><?php echo date(get_option('date_format')); ?></h2> 	
                  </div>
                  <div class="relative">
                    <div id="socialmedia-menu" class="right-0 md:left-0 w-[60px] pb-8 h-[70px] top-0 overflow-hidden bg-[#1259aa] rounded-b-full absolute text-center z-50">
                      <div class="w-full h-[30px] mt-4 text-center">
                        <button type="button" id="share-button" class="focus:outline-none">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-share"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M8.7 10.7l6.6 -3.4" /><path d="M8.7 13.3l6.6 3.4" /></svg>
                        </button> 
                      </div>
                      <div class="w-full h-[30px] mt-4">
                        <a href="https://www.facebook.com/ZMGNoticias/" class="inline-block mt-2 text-center" target="_blank" rel="noopener noreferrer">
                          <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                        </a>
                      </div>
                      <div class="w-full h-[30px] mt-4">
                        <a href="https://twitter.com/ZMG_Noticias" class="inline-block mt-2 text-center" target="_blank" rel="noopener noreferrer">
                          <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-twitter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" /></svg>
                        </a>
                      </div>
                      <div class="w-full h-[30px] mt-4">
                        <a href="https://www.linkedin.com/company/gst-medios/" class="inline-block mt-2 text-center" target="_blank" rel="noopener noreferrer">
                          <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-linkedin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 11v5" /><path d="M8 8v.01" /><path d="M12 16v-5" /><path d="M16 16v-3a2 2 0 1 0 -4 0" /><path d="M3 7a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v10a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4z" /></svg>
                        </a>
                      </div>
                      <div class="w-full h-[30px] mt-4">
                        <a href="https://www.instagram.com/" class="inline-block mt-2 text-center" target="_blank" rel="noopener noreferrer">
                          <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M16.5 7.5v.01" /></svg>
                        </a>
                      </div>
                    </div> 
                  </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 py-2">  
              <div class="grid grid-cols-12 gap-4 px-4 py-6 items-center"> 
                <div class="col-span-12 md:col-span-6 flex justify-center items-center">
                  <?php
                  if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                      the_custom_logo();
                  } else {
                      echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="text-2xl font-bold text-gray-800">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                  }
                  ?>
                </div>

                <div class="col-span-12 md:col-span-6 flex justify-center"> 
                  <div id="TT_JijwLxdBt1AaE8hA7fxzzjDzj6nALfI2btktkZioK1z" style="float: right;">El tiempo - Tutiempo.net</div> 
                </div>
              </div>
            </div>
            <div>
              <?php 
                if(is_front_page()){ 
                  get_ZMG_Theme_Post_Template('sliderHome'); 
                }elseif(is_category()){ 
                  ?>
                    <div class="bg-[#1259aa] text-white py-10 px-4">
                      <h2 class="text-xl md:text-3xl text-center font-bold"><?php single_cat_title(); ?></h2> 
                      <hr class="my-4">
                    </div>
                  <?php
                }elseif(is_search()){
                  ?>
                    <div class="bg-[#1259aa] text-white py-10 px-4">
                      <h2 class="text-xl md:text-3xl text-center font-bold">Resultados de búsqueda para: "<?php echo get_search_query(); ?>"</h2> 
                      <hr class="my-4"> 
                    </div>
                  <?php
                }
              ?>
            </div>
            <nav class="bg-[#2d2d2d] text-white relative">
              <div class="w-full md:max-w-[90%] md:mx-auto">
                <div class="grid grid-cols-12 items-center">
                  <!-- Logo o placeholder (opcional en móvil) -->
                  <div class="col-span-2 md:hidden flex justify-start items-center pl-2">
                    <button id="mobile-menu-toggle" class="text-white focus:outline-none ml-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                      </svg>
                    </button>
                  </div>

                  <!-- Menú desktop -->
                  <div class="col-span-12 md:col-span-11 hidden md:flex justify-center border-r border-l border-gray-600">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex flex-wrap items-center font-bold uppercase text-sm',
                        'fallback_cb'    => 'zmg_menu_fallback',
                        'walker'         => new ZMG_Nav_Walker(),
                    ) );
                    ?>
                  </div>

                  <!-- Ícono de búsqueda -->
                  <div class="col-span-10 md:col-span-1 flex justify-end md:justify-start">
                    <button id="search-toggle" class="p-4 hover:text-red-400 border-r-0 border-gray-600 md:border-r" onclick="showSearchForm()">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Menú móvil (solo en xs/sm) -->
                <div id="mobile-menu" class="hidden md:hidden bg-[#2d2d2d] px-4 py-4 border-t border-gray-600">
                  <?php
                  wp_nav_menu( array(
                      'theme_location' => 'primary-menu',
                      'container'      => false,
                      'menu_class'     => 'space-y-2 font-bold uppercase text-sm',
                      'fallback_cb'    => 'zmg_menu_fallback',
                      'walker'         => new ZMG_Nav_Walker_Mobile(), // Walker diferente para móvil
                  ) );
                  ?>
                </div>
              </div>
            </nav>
        </header>

        <div id="content" class="site-content flex-1">
            <main id="main" class="site-main bg-gray-50">
