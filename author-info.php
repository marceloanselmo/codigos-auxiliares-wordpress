 <div class="bio">
    <div>
    <?php echo get_avatar( get_the_author_meta('user_email') , 90 );?>
    </div>
    <div>
        <h3><?php echo  get_the_author_meta( 'display_name', $post->post_author );?></h3>
        <p><?php echo get_the_author_meta( 'user_description', $post->post_author );?></p>
    </div>
</div>