<?php get_header(); ?>
<div class = "row" id = "contentsection">
    <div class = "large-12 column" id = "content-box">
<?php

    $on_off = true;

?>
    
<h2 class = "content-title">Category: <?php single_cat_title(''); ?></h2>
        
    <div class = "large-12 column left" id = "category-column">
<?php if(have_posts()): ?>

<?php while(have_posts()): the_post(); ?>
    <div class = "category-row long-row is-<?php print (($on_off == true) ? "off" : "on"); ?>">
<?php get_template_part('content', 'category'); ?>
    </div>
<?php

    if($on_off){
        
        $on_off = false;
        
    } else {
        
        $on_off = true;
        
    }

?>
<?php endwhile; ?>

<?php else: ?>

    <div class = "category-row long-row">
<?php get_template_part('content', '404'); ?>
    </div>
<?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>