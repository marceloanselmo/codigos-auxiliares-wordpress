<?php

if(!function_exists('wp_post_page_clone')) {
   
    function wp_post_page_clone(){

            global $wpdb;
                      
            $nonce = $_REQUEST['nonce'];
            $post_id = (isset($_GET['post']) ? intval($_GET['post']) : intval($_POST['post']));

            // check access permissions to even consider the cloning....
            if( ! wp_verify_nonce( $nonce, 'wp-post-page-clone-'.$post_id) || ! current_user_can( 'edit_posts' )) {
                wp_die("You don't have permission to be here", "wp-post-page-clone");
            }

            if ( !isset( $_GET['post']) || (!isset($_REQUEST['action']) && 'wp_post_page_clone' != $_REQUEST['action'] ) ) {
                wp_die("No post or page to clone has been supplied!, Please try again!", "wp-post-page-clone");
            }
            
            $post = get_post( $post_id );
            $current_user = wp_get_current_user();
            $post_author = $current_user->ID;

            if( current_user_can('delete_others_posts') || current_user_can( 'setup_network' ) || (current_user_can('edit_posts') && $post_author == $post->post_author)){

                if (isset( $post ) && $post != null) {

                        $args = array(
                                'comment_status' => $post->comment_status,
                                'ping_status'    => $post->ping_status,
                                'post_author'    => $post_author,
                                'post_content'   => $post->post_content,
                                'post_excerpt'   => $post->post_excerpt,
                                'post_name'      => $post->post_name,
                                'post_parent'    => $post->post_parent,
                                'post_password'  => $post->post_password,
                                'post_status'    => 'draft',
                                'post_title'     => $post->post_title,
                                'post_type'      => $post->post_type,
                                'to_ping'        => $post->to_ping,
                                'menu_order'     => $post->menu_order
                        );

                        $clone_post_id = wp_insert_post( $args );

                        $taxonomies = get_object_taxonomies($post->post_type);
                        if (!empty($taxonomies) && is_array($taxonomies)){
                            foreach ($taxonomies as $taxonomy) {
                                    $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                                    wp_set_object_terms($clone_post_id, $post_terms, $taxonomy, false);
                            }
                        }

                        $post_meta_data = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
                        if (count($post_meta_data)!=0) {
                                $clone_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                                foreach ($post_meta_data as $meta_data) {
                                        $meta_key = sanitize_text_field($meta_data->meta_key);
                                        $meta_value = addslashes($meta_data->meta_value);
                                        $clone_query_select[]= "SELECT $clone_post_id, '$meta_key', '$meta_value'";
                                }
                                $clone_query.= implode(" UNION ALL ", $clone_query_select);
                                $wpdb->query($clone_query);
                        }

                        wp_redirect(admin_url('edit.php?post_type='.$post->post_type));
                        exit;

                } else {

                        wp_die(__('Post or Page creation failed, could not find original post:', 'wp-post-page-clone') . $post_id);

                }

            } else {
                wp_die('Security issue occure, Please try again!.', 'wp-post-page-clone');
            }

    }

}

add_action( 'admin_action_wp_post_page_clone', 'wp_post_page_clone' );


if(!function_exists('wp_post_page_link')) {   
    function wp_post_page_link( $actions, $post ) {

            $current_user = wp_get_current_user();
            $post_author = $current_user->ID;
            $allowed_roles = array( 'editor', 'administrator' );
            if ( array_intersect( $allowed_roles, $current_user->roles ) ) {
                    $actions['clone'] = '<a '.$post_author.'==='.$post->post_author.' href="admin.php?action=wp_post_page_clone&amp;post=' . $post->ID . '&amp;nonce='.wp_create_nonce( 'wp-post-page-clone-'.$post->ID ).'" title="'.__('Clone Post and Page', 'wp-post-page-clone').'" rel="permalink">'.__('Clonar', 'wp-post-page-clone').'</a>';
            }

            return $actions;
    }

}
add_filter( 'post_row_actions', 'wp_post_page_link', 10, 2 );
add_filter('page_row_actions', 'wp_post_page_link', 10, 2);

?>