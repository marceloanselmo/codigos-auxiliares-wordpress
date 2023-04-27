function gerar_alt_text_para_imagens_sem_alt() {
    global $wpdb;
    $images = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND post_mime_type LIKE 'image/%' AND (post_content IS NULL OR post_content='')");
    foreach ($images as $image) {
        $image_id = $image->ID;
        $image_url = wp_get_attachment_url($image_id);
        $image_alt = basename($image_url);
        $image_alt = preg_replace('/\.[^.]+$/', '', $image_alt);
        update_post_meta($image_id, '_wp_attachment_image_alt', $image_alt);
    }
}
add_action('init', 'gerar_alt_text_para_imagens_sem_alt');