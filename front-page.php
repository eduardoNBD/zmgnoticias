<?php
/**
 * The front page template file
 *
 * @package ZMG_Theme
*/ 
    get_header(); 
?>
<div class="max-w-7xl mx-auto mt-4">
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9309651612334237"
     data-ad-slot="7767656990"
     data-ad-format="auto"
     data-full-width-responsive="true">
    </ins>
    <div>
        <div class="flex items-center">
            <div class="h-1 bg-[#002D56] w-[30%]"></div>
            <div class="h-1 bg-[#c7c7c7] flex-grow"></div>
        </div>
    </div>
    <h3 class="ml-4 text-[#002D56] text-xl md:text-3xl font-bold text-lg my-4">LO MÁS RECIENTE</h3>
    <?php get_ZMG_Theme_Post_Template('twoColumnsPost'); ?>
</div>
<div class="max-w-7xl mx-auto mt-4">
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9309651612334237"
     data-ad-slot="7767656990"
     data-ad-format="auto"
     data-full-width-responsive="true">
    </ins>
</div> 
<div class="bg-[#002D56] py-6 mt-8"> 
    <div class="max-w-7xl mx-auto mt-4">
        <h3 class="ml-4 text-white text-xl md:text-3xl font-bold text-lg my-4">MÁS POPULARES</h3>
        <?php get_ZMG_Theme_popular_post(4) ?>
    </div>
</div>
<div>
    <div class="max-w-7xl mx-auto mt-4"> 
        <?php
            $selectedCategory = get_category_by_slug( 'noticias-de-jalisco' );
        ?>
        <div>
            <div class="flex items-center">
                <div class="h-1 bg-[#002D56] w-[30%]"></div>
                <div class="h-1 bg-[#c7c7c7] flex-grow"></div>
            </div>
        </div>
        <h3 class="ml-4 text-[#002D56] text-xl md:text-3xl font-bold text-lg my-4"><?=$selectedCategory->name ?></h3>
        <?php get_ZMG_Theme_Posts_By_Category('noticias-de-jalisco',8) ?>
    </div>
</div>
<div>
    <div class="max-w-7xl mx-auto mt-4">  
        <div>
            <div class="flex items-center">
                <div class="h-1 bg-[#002D56] w-[30%]"></div>
                <div class="h-1 bg-[#c7c7c7] flex-grow"></div>
            </div>
        </div>
        <h3 class="ml-4 text-[#002D56] text-xl md:text-3xl font-bold text-lg my-4">NACIONALES</h3>
        <?php get_ZMG_Theme_Posts_By_Category('nacional',4) ?>
    </div>
</div>
<div>
    <div class="max-w-7xl mx-auto mt-4">  
        <div>
            <div class="flex items-center">
                <div class="h-1 bg-[#002D56] w-[30%]"></div>
                <div class="h-1 bg-[#c7c7c7] flex-grow"></div>
            </div>
        </div>
        <h3 class="ml-4 text-[#002D56] text-xl md:text-3xl font-bold text-lg my-4">INTERNACIONALES</h3>
        <?php get_ZMG_Theme_Posts_By_Category('internacional',4) ?>
    </div>
</div>
<?php get_footer(); ?>
