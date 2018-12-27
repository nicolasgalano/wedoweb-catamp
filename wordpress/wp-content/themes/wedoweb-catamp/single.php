<?php
if(have_posts()) {
    while (have_posts()) {
        the_post();
        $newsGroup = get_field('news-group');
    }
}
//var_dump($newsGroup);
$isFromCatamp = 0;
$headerType = '';

if($newsGroup){

    $isFromCatamp = array_search('catamp', $newsGroup);

    if($isFromCatamp === 0 || count($newsGroup) > 1) {} else {
        if(array_search('cipet', $newsGroup) === 0) {
            $headerType = 'cipet';
        }
        else if(array_search('lnh', $newsGroup) === 0) {
            $headerType = 'lnh';
        }
    }

}

get_header($headerType);

if (is_singular('noticia')) {

    get_template_part('templates/single', 'news');

}else if (is_singular('indice')) {

    get_template_part('templates/single', 'indice');

}
?>

<?php get_footer(); ?>
