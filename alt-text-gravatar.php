
function crunchify_gravatar_alt($crunchifyGravatar) {
    if (have_comments()) {
        $alt = get_comment_author();
    }
    else {
        $alt = get_the_author_meta('display_name');
    }
    $crunchifyGravatar = str_replace('alt=\'\'', 'alt=\'Avatar for ' . $alt . '\' title=\'Gravatar for ' . $alt . '\'', $crunchifyGravatar);
    return $crunchifyGravatar;
}
add_filter('get_avatar', 'crunchify_gravatar_alt');