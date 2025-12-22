<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Formulario de búsqueda médica personalizado
 */
function get_ZMG_Theme_partial($partial) {  
    if(file_exists(ZMG_Theme_PATH . '/partials/'.$partial.'.php')){  
        include ZMG_Theme_PATH . '/partials/'.$partial.'.php'; 
    } 
}