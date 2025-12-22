<?php 
    class ZMG_Nav_Walker extends Walker_Nav_Menu {

        /**
         * Inicia el elemento de salida.
         */
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            // Añadir clase "group" a los elementos de nivel 0 que tienen hijos
            if ( $depth === 0 && in_array( 'menu-item-has-children', $classes ) ) {
                $classes[] = 'group relative';
            }

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $attributes = '';
            if ( ! empty( $item->attr_title ) ) {
                $attributes .= ' title="' . esc_attr( $item->attr_title ) . '"';
            }
            if ( ! empty( $item->target ) ) {
                $attributes .= ' target="' . esc_attr( $item->target ) . '"';
            }
            if ( ! empty( $item->xfn ) ) {
                $attributes .= ' rel="' . esc_attr( $item->xfn ) . '"';
            }
            if ( ! empty( $item->url ) ) {
                $attributes .= ' href="' . esc_attr( $item->url ) . '"';
            }

            // Clases del enlace
            $link_classes = 'px-3 h-[63px] flex items-center inline-block transition';

            // Menú principal (nivel 0)
            if ( $depth === 0 ) {
                $link_classes .= ' uppercase font-bold text-sm';
                // Hover y estado activo
                if ( in_array( 'current-menu-item', $item->classes ) || in_array( 'current_page_item', $item->classes ) ) {
                    $link_classes .= ' bg-[#eb2f21]';
                } else {
                    $link_classes .= ' hover:bg-[#eb2f21]';
                }

                // Si tiene submenú, hacerlo flex para el ícono
                if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                    $link_classes .= ' flex items-center gap-1';
                }
            } else {
                // Submenús
                $link_classes .= ' block w-full text-left text-sm hover:bg-[#eb2f21]';
            }

            $attributes .= ' class="' . esc_attr( $link_classes ) . '"';

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

            // Ícono de flecha solo en nivel 0 con hijos
            if ( $depth === 0 && in_array( 'menu-item-has-children', $item->classes ) ) {
                $item_output .= '<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>';
            }

            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        /**
         * Inicia el nivel (submenú).
         */
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            if ( $depth === 0 ) {
                // Submenú de primer nivel: dropdown absoluto
                $output .= '<ul class="absolute left-0 bg-[#2d2d2d] min-w-[200px] shadow-lg z-10 hidden group-hover:block">';
            } else {
                // Submenús anidados: estilo indentado
                $output .= '<ul class="bg-[#3a3a3a] py-1 pl-2">';
            }
        }

        /**
         * Finaliza el nivel.
         */
        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= '</ul>';
        }

        /**
         * Finaliza el elemento de salida.
         */
        function end_el( &$output, $item, $depth = 0, $args = array() ) {
            $output .= "</li>\n";
        }
    } 

    class ZMG_Nav_Walker_Mobile extends Walker_Nav_Menu {

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $has_children = in_array( 'menu-item-has-children', $classes );
    
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $class_names . '>';

    $attributes = '';
    if ( ! empty( $item->attr_title ) ) {
        $attributes .= ' title="' . esc_attr( $item->attr_title ) . '"';
    }
    if ( ! empty( $item->target ) ) {
        $attributes .= ' target="' . esc_attr( $item->target ) . '"';
    }
    if ( ! empty( $item->xfn ) ) {
        $attributes .= ' rel="' . esc_attr( $item->xfn ) . '"';
    }
    if ( ! empty( $item->url ) ) {
        $attributes .= ' href="' . esc_attr( $item->url ) . '"';
    }

    $link_classes = 'block px-3 py-2 transition uppercase font-bold text-sm w-full text-left';
    if ( in_array( 'current-menu-item', $item->classes ) || in_array( 'current_page_item', $item->classes ) ) {
        $link_classes .= ' bg-[#eb2f21]';
    } else {
        $link_classes .= ' hover:bg-[#eb2f21]';
    }

    // Contenedor flex para alinear ícono a la derecha
    $item_output = $args->before;
    $item_output .= '<div class="flex items-center justify-between">';

    // Enlace principal (siempre navega si se hace clic en el texto)
    $item_output .= '<a' . $attributes . ' class="' . esc_attr( $link_classes ) . ' flex-grow">';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';

    // Botón de toggle SOLO si tiene hijos
    if ( $has_children ) {
        $item_output .= '<button type="button" class="mobile-submenu-toggle ml-2 p-1 focus:outline-none" aria-expanded="false" aria-label="Abrir submenú de ' . esc_attr( $item->title ) . '">';
        $item_output .= '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>';
        $item_output .= '</button>';
    }

    $item_output .= '</div>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= '<ul class="mobile-submenu hidden ml-4 mt-1 space-y-1 bg-[#3a3a3a] rounded">';
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= '</ul>';
        }

        function end_el( &$output, $item, $depth = 0, $args = array() ) {
            $output .= "</li>\n";
        }
    }