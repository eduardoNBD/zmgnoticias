<?php
class last_posts_week_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'ultimos_posts_semana',
            __('Últimos Posts de la Semana (views)', 'text_domain'),
            ['description' => __('Muestra los posts de esta semana con imagen, categoría, título y extracto, ordenados por vistas.', 'text_domain')]
        );
    }

    // Formulario en el admin
    public function form($instance) {
        $qty = !empty($instance['qty']) ? $instance['qty'] : 5;
        $title = !empty($instance['title']) ? $instance['title'] : __('Últimos Posts de la Semana', 'text_domain');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php _e('Título del widget:', 'text_domain'); ?>
            </label>
            <input 
                class="widefat" 
                id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                type="text" 
                value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('qty')); ?>">
                <?php _e('Cantidad de posts a mostrar:', 'text_domain'); ?>
            </label>
            <input 
                class="tiny-text" 
                id="<?php echo esc_attr($this->get_field_id('qty')); ?>" 
                name="<?php echo esc_attr($this->get_field_name('qty')); ?>" 
                type="number" 
                step="1" 
                min="1" 
                value="<?php echo esc_attr($qty); ?>" 
                size="3">
        </p>
        <?php
    }

    // Guardar opciones
    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : __('Últimos Posts de la Semana', 'text_domain');
        $instance['qty'] = (!empty($new_instance['qty'])) ? absint($new_instance['qty']) : 5;
        return $instance;
    }

    // Mostrar el widget
    public function widget($args, $instance) {
        $qty = !empty($instance['qty']) ? $instance['qty'] : 5;
        $title = !empty($instance['title']) ? $instance['title'] : __('Últimos Posts de la Semana', 'text_domain');

        echo $args['before_widget'];

        // Título
        if (!empty($args['before_title'])) {
            echo $args['before_title'] . '<span class="text-lg font-semibold text-gray-900">' . esc_html($title) . '</span>' . $args['after_title'];
        } else {
            echo '<h3 class="text-lg font-semibold text-gray-900 mb-3">' . esc_html($title) . '</h3>';
        }

        // Detectar post actual para excluirlo
        $current_post_id = get_queried_object_id();
        $exclude_posts = [];
        
        if (is_singular('post') && $current_post_id) {
            $exclude_posts[] = $current_post_id;
        }

        // Fechas de esta semana
        $inicio_semana = date('Y-m-d', strtotime('-10 days'));
        $hoy = date('Y-m-d');

        // Consulta con filtro de fecha y exclusión del post actual
        $query_args = [
            'post_type'      => 'post',
            'posts_per_page' => $qty, 
            'meta_key'       => 'post_views',
            'orderby'        => 'meta_value_num date',
            'order'          => 'DESC',
            'ignore_sticky_posts' => true,
            'date_query'     => [
                [
                    'after'     => $inicio_semana . ' 00:00:00',
                    'before'    => $hoy . ' 23:59:59',
                    'inclusive' => true,
                ]
            ],
            'post__not_in'   => $exclude_posts,
        ];

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            echo '<div class="grid gap-4">';

            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                $permalink = get_permalink();
                $title = get_the_title();
                $author_id = get_the_author_meta('ID');
                $author_name = get_the_author();
                $author_url = $author_id ? get_author_posts_url($author_id) : '';
                $views = intval(get_post_meta($post_id, 'post_views', true));
                $views = $views ?: 0;
                $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
                $category = get_the_category();
                $category_name = !empty($category) ? $category[0]->name : '';
                $category_link = !empty($category) ? get_category_link($category[0]->term_id) : '#';
                $thumb = get_the_post_thumbnail_url($post_id, 'medium_large');

                echo '<article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition mx-4">';
                if ($thumb) {
                    echo '<a href="' . esc_url($permalink) . '" class="block relative">';
                    echo '<img src="' . esc_url($thumb) . '" alt="' . esc_attr($title) . '" class="w-full h-48 object-cover">';
                    if ($category_name) {
                        echo '<span class="absolute bottom-2 left-2 bg-black/80 text-white text-xs font-semibold px-2 py-1 rounded">' . esc_html($category_name) . '</span>';
                    }
                    echo '</a>';
                }

                echo '<div class="p-3">';
                $author_html = $author_url
                    ? '<a class="hover:underline" href="' . esc_url($author_url) . '">' . esc_html($author_name) . '</a>'
                    : esc_html($author_name);
                echo '<div class="flex justify-between text-xs font-semibold px-2 py-1 rounded text-gray-600">'
                    . '<span>' . get_the_date() . '</span>'
                    . '<span class="flex gap-2 items-center">'
                        . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>'
                        . number_format($views, 0, ',')
                    . '</span>'
                . '</div>';
                echo '<a href="' . esc_url($permalink) . '" class="block text-base font-semibold text-gray-900 hover:underline">' . esc_html($title) . '</a>';
                echo '<p class="text-sm text-gray-600 mt-1">' . esc_html($excerpt) . '</p>';
                echo '<div class="flex justify-end text-xs font-semibold px-2 py-1 rounded text-gray-600 mt-2">
                    <span>' . $author_html . '</span>
                </div>';
                echo '</div>';
                echo '</article>';
            }

            echo '</div>';
        } else {
            echo '<p class="text-gray-600 text-sm">No hay publicaciones esta semana.</p>';
        }

        wp_reset_postdata();
        echo $args['after_widget'];
    }
}

// Registrar widget
function register_last_posts_week_widget() {
    register_widget('last_posts_week_Widget');
}
add_action('widgets_init', 'register_last_posts_week_widget');