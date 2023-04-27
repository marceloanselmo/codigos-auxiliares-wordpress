<?php

function minificar_html($html) {
    $search = array(
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s',
        '#<!–[^\[].*?[^\]]–>#s'
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $minificado = preg_replace($search, $replace, $html);

    return $minificado;
}
add_action('get_header', function() {
    ob_start('minificar_html');
});
add_action('wp_footer', function() {
    ob_end_flush();
}, 999);?>
