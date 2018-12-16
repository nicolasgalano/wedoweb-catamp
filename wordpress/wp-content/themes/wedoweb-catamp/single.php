<?php
if(have_posts()) {
    while (have_posts()) {
        the_post();
        $newsGroup = get_field('news-group');
    }
}
//var_dump($newsGroup);
$isFromCatamp = array_search('catamp', $newsGroup);

$headerType = '';
if($isFromCatamp === 0 || count($newsGroup) > 1) {
    $headerType = '';
}
else {
    if(array_search('cipet', $newsGroup) === 0) {
        $headerType = 'cipet';
    }
    else if(array_search('lnh', $newsGroup) === 0) {
        $headerType = 'lnh';
    }
}
get_header($headerType);

if (is_singular('noticia')) {
    get_template_part('templates/single', 'news');
}
?>

<?php get_footer(); ?>
