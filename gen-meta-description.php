//põe na última linha do head no header.php
<?php gen_meta_description_post(); ?>



// põe no function.php
function gen_meta_description_post() {
    global $post;

    $meta_description = '';

    if ( is_single() ) {
        // verifica se o post já tem uma meta description definida
        $post_meta_description = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );
        if ( empty( $post_meta_description ) ) {
            $content = strip_tags( get_the_content() );
            $meta_description = wp_trim_words( $content, 25 );
        }
    }

    $meta_description = wp_trim_words( $meta_description, 155 );

    if ( ! empty( $meta_description ) ) {
        echo '<meta name="description" content="' . esc_attr( $meta_description ) . '" />';
    }
}