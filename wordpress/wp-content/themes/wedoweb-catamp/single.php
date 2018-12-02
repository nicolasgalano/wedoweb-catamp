<?php
if(have_posts()) {
    while (have_posts()) {
        the_post();
//        var_dump(get_the_category_list());
        $newGroup = get_field('news-group');
    }
}
get_header($newGroup);

if (is_singular('noticia')) {
    get_template_part('templates/single', 'news');
}
?>

<?php get_footer(); ?>
