
function use_classic_editor() {   
    add_filter( 'use_block_editor_for_post', '__return_false' );   
}
add_action( 'admin_init', 'use_classic_editor' );?>


