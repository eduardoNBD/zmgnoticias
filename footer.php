            </main><!-- #main -->
        </div><!-- #content --> 
        <div id="site-loader" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#000000dd]">
            <div class="relative flex flex-col items-center animate-custom-pulse">
                <!-- Contenedor del logo con efecto de pulsación -->
                <div class="animate-custom-pulse">
                <?php if (has_custom_logo()): ?>
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image($custom_logo_id, 'medium', false, [
                        'class' => 'h-24 w-auto text-white opacity-90',
                        'alt' => get_bloginfo('name')
                    ]);
                    echo $logo;
                    ?>
                <?php else: ?>
                    <span class="text-white text-2xl font-bold tracking-wide">
                    <?php bloginfo('name'); ?>
                    </span>
                <?php endif; ?>
                </div> 
            </div>
        </div>
        <div id="alert-container" class="fixed top-[30%] right-4 space-y-4 z-[60]"></div> 
        <div id="search-form" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden bg-[#000000AA] fixed inset-0 z-50 flex items-center justify-center w-full h-screen">
            <div class="p-4 w-full max-w-2xl mx-auto relative h-auto">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex flex-col md:flex-row gap-3 md:gap-0 w-full">
                    <input type="text" name="s" placeholder="Buscar ..." class="bg-black bg-opacity-65 text-white border-0 py-2 leading-[45px] px-4 w-full md:w-[80%] hover:outline-none" autocomplete="off"/>
                    <button type="submit" class="w-full md:w-[20%] bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded md:rounded-l-none md:rounded-r transition">
                        Buscar
                    </button>
                </form> 
                <div class="text-center mt-8">
                    <button id="close-search" class="text-white hover:text-gray-300" onclick="hideSearchForm()"> 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <div id="main-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden bg-[#00000055] overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] h-screen">
            <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 rounded-t bg-[#09357A] border-b-[20px] border-[#27C195] text-white" id="main-modal-header">
                        <h3 class="text-xl font-semibold">
                            Static modal
                        </h3>
                        <button onclick="closeModal('#main-modal')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="main-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4" id="main-modal-body"> 

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b bg-[#09357A] text-white" id="main-modal-footer">
                            
                    </div>
                </div>
            </div>
        </div>
        <footer id="colophon" class="site-footer bg-[#212121] text-white">
            <div class="px-4 lg:px-6 py-12">
                
                <!-- Widgets del footer -->
                <?php if (is_active_sidebar('footer-widgets')) : ?>
                    <div class="footer-widgets">
                        <?php dynamic_sidebar('footer-widgets'); ?>
                    </div>
                <?php endif; ?>

                <!-- Información del sitio -->
                <div class="footer-info pt-8">
                    <div class="flex justify-center items-center space-y-6 lg:space-y-0">
                        <!-- Menú del footer -->
                        <div class="footer-menu-wrapper order-1 lg:order-2">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_class' => 'footer-menu flex flex-wrap justify-center lg:justify-end space-x-6 text-sm',
                                'container' => false,
                                'fallback_cb' => false,
                                'items_wrap'
                            ));
                            ?>
                        </div>
                    </div> 
                    <div class="footer-links text-sm text-gray-400 order-3 mt-4">
                        <div class="grid grid-cols-12">
                            <div class="col-span-12 md:col-span-4 text-center md:text-left mb-4 md:mb-0">
                                GST Medios - S de RL de CV
                            </div>
                            <div class="col-span-12 md:col-span-4 text-center mb-4 md:mb-0">
                                Developed by 
                                <a href="https://www.greenshieldtech.com/" target="_blank" rel="noopener" class="text-[#1259aa]">Green Shield Technology</a> 
                                copyright © <?php echo date('Y'); ?>. All rights reserved.
                            </div>
                            <div class="col-span-12 md:col-span-4 text-center md:text-right flex gap-2 justify-center md:justify-end mb-4 md:mb-0">
                                <div>
                                    <a href="https://zmgnoticias.com/aviso-de-privacidad/">Aviso de privacidad</a> - 
                                    <a href="https://zmgnoticias.com/terminos-de-uso/">Términos de Uso</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </footer><!-- #colophon -->

    </div><!-- #page -->
    <script type="text/javascript" src="https://www.tutiempo.net/s-widget/l_JijwLxdBt1AaE8hA7fxzzjDzj6nALfI2btktkZioK1z"></script>
    <script>
        const base_url = "<?=get_bloginfo('url')?>"; 
    </script>
    <?php wp_footer();?>      
</body>
</html>
