<?php
/**
 * Custom Pages setup for the theme
 *
 * @package zmg_Theme
*/ 

// Definir todas las páginas personalizables en un solo array
function zmg_get_custom_pages_config() {
    return [
    ];
}

// Registrar ajustes en el Customizer
function zmg_pages_customize_register($wp_customize) {
    $pages = zmg_get_custom_pages_config();

    foreach ($pages as $setting_id => $config) {
        $wp_customize->add_setting($setting_id, array(
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control($setting_id, array(
            'type'    => 'dropdown-pages',
            'label'   => $config['label'],
            'section' => 'static_front_page',
        ));
    }
}
add_action('customize_register', 'zmg_pages_customize_register');

function zmg_register_custom_scripts() {
    
    // Registro del estilo para datepicker de flowbite
    wp_register_style(
        'flowbite-datepicker-css', // handle
        ZMG_Theme_URL. '/assets/libs/flowbite/datepicker.min.css', // URL pública
        [],
        date("Ymd.H.m.s")
    );

    // Registro del script para datepicker de flowbite
    wp_register_script(
        'flowbite-datepicker', // handle
        ZMG_Theme_URL. '/assets/libs/flowbite/datepicker.min.js', // URL pública
        ['zmg-theme-script-0','zmg-theme-script-1'],
        date("Ymd.H.m.s"),
        true // en footer
    );  

    // Registro del script para multiSelect
    wp_register_script(
        'multiSelect', // handle
        ZMG_Theme_URL. '/assets/libs/multiSelect/multiSelect.js', // URL pública
        ['zmg-theme-script-0','zmg-theme-script-1'],
        date("Ymd.H.m.s"),
        true // en footer
    );  
}
add_action('init', 'zmg_register_custom_scripts');

// Asignar plantillas personalizadas según la página seleccionada
function zmg_set_custom_page_template($template) {
    if (!is_page()) {
        return $template;
    }
    
    $current_page_id = get_queried_object_id();
    $pages = zmg_get_custom_pages_config();

    foreach ($pages as $setting_id => $config) {
        $saved_page_id = get_theme_mod($setting_id, 0);
         
        if ($saved_page_id && $current_page_id == $saved_page_id && !empty($config['template'])) {
            // Encolar scripts
            if (!empty($config['scripts'])) {
                foreach ($config['scripts'] as $handle) {  
                    if (wp_script_is($handle, 'registered')) {
                        wp_enqueue_script($handle);
                    }
                }
            }

            // Encolar estilos
            if (!empty($config['styles'])) {
                foreach ($config['styles'] as $handle) {
                    if (wp_style_is($handle, 'registered')) {
                        wp_enqueue_style($handle);
                    }
                }
            }
            // Construir ruta completa a la plantilla
            $custom_template = ZMG_Theme_PATH . '/templates-pages/' . $config['template'];
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
    }

    return $template;
}

add_filter('template_include', 'zmg_set_custom_page_template');

function zmg_enqueue_custom_page_assets() {
    if (!is_page()) {
        return;
    }

    $current_page_id = get_queried_object_id();
    $pages_config = zmg_get_custom_pages_config();

    foreach ($pages_config as $setting_id => $config) {
        $saved_page_id = get_theme_mod($setting_id, 0);

        // Si la página actual coincide con una configurada
        if ($saved_page_id && $current_page_id == $saved_page_id) {
            
            // Encolar scripts si existen
            if (!empty($config['assets']) && is_array($config['assets'])) {
                foreach ($config['assets'] as $handle) {
                    // Verifica si es script o estilo (puedes usar prefijos o lógica)
                    if (wp_script_is($handle, 'registered')) {
                        wp_enqueue_script($handle);
                    } elseif (wp_style_is($handle, 'registered')) {
                        wp_enqueue_style($handle);
                    }
                }
            }

            break; // Solo una página coincide, salimos
        }
    }
}

add_action('wp_enqueue_scripts', 'zmg_enqueue_custom_page_assets', 10);