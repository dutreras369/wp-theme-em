<?php
function custom_register_blocks() {
    // Registro del bloque "About Us"
    register_block_type('custom/about', array(
        'editor_script' => 'custom-block-editor-js',
        'editor_style'  => 'custom-block-editor-css',
        'style'         => 'custom-block-css',
    ));

    // Aquí puedes añadir registros de otros bloques (Hero, Services, etc.)
}

function custom_enqueue_block_assets() {
    // Verificar si el archivo `index.asset.php` existe antes de incluirlo
    $asset_file = get_template_directory() . '/assets/js/blocks/build/index.asset.php';

    if (file_exists($asset_file)) {
        // Cargar las dependencias y la versión del archivo de assets
        $asset = include($asset_file);
        
        // Registrar el script del editor de bloques
        wp_register_script(
            'custom-block-editor-js',
            get_template_directory_uri() . '/assets/js/blocks/build/index.js',  // Ruta del script compilado
            $asset['dependencies'],  // Dependencias incluidas en index.asset.php
            $asset['version']  // Versión del script
        );
    } else {
        // Lanza un error si el archivo `index.asset.php` no existe
        error_log('No se pudo encontrar el archivo de dependencias index.asset.php para los bloques personalizados.');
    }

    // Encolar los estilos del editor
    wp_register_style(
        'custom-block-editor-css',
        get_template_directory_uri() . '/assets/css/editor.css', // Ruta al archivo CSS compilado para el editor
        array('wp-edit-blocks'), // Dependencias
        filemtime(get_template_directory() . '/assets/css/editor.css')
    );

    // Encolar los estilos para el frontend
    wp_register_style(
        'custom-block-css',
        get_template_directory_uri() . '/assets/css/main.css', // Ruta al archivo CSS compilado para el frontend
        array(),
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    // Encolar los scripts y estilos
    wp_enqueue_script('custom-block-editor-js');
    wp_enqueue_style('custom-block-editor-css');
    wp_enqueue_style('custom-block-css');
}

// Hooks para registrar y encolar los bloques y sus scripts/estilos
add_action('enqueue_block_assets', 'custom_enqueue_block_assets');
add_action('init', 'custom_register_blocks');
