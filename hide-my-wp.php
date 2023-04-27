

function ocultar_versao_wordpress() {
    return '';
}
add_filter('the_generator', 'ocultar_versao_wordpress');

function ocultar_versao_plugins() {
    global $wp_version;

    $plugins = get_plugins();
    foreach($plugins as $file => $plugin) {
        $plugin_data = get_plugin_data( WP_PLUGIN_DIR.'/'.$file );
        $plugins[$file]['Name'] = $plugin_data['Name'];
        $plugins[$file]['Version'] = '';
    }

    return $plugins;
}
add_filter('all_plugins', 'ocultar_versao_plugins'); ?>
