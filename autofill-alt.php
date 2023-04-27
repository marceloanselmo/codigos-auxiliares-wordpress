
function auto_fill_image_alt_tag_and_caption($attachment_ID) {
    $attachment = get_post($attachment_ID);
    $attachment_title = $attachment->post_title;
    $attachment_caption = $attachment->post_excerpt;
    $attachment_alt = get_post_meta($attachment_ID, '_wp_attachment_image_alt', true);

    if(empty($attachment_alt)) {
        update_post_meta($attachment_ID, '_wp_attachment_image_alt', $attachment_title);
    }

    if(empty($attachment_caption)) {
        update_post_meta($attachment_ID, '_wp_attachment_image_caption', $attachment_title);
        update_post_meta($attachment_ID, '_wp_attachment_image_description', $attachment_title);
    }
}

add_action('add_attachment', 'auto_fill_image_alt_tag_and_caption');?>


