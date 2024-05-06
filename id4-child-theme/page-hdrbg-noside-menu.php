<?php /* Template Name: Page -- Header Background - No Sidebar */ ?>
<?php get_header(); ?>
<?php 

if(is_active_sidebar('secondary-page-bannerarea')) {

dynamic_sidebar('secondary-page-bannerarea');

}
?>
<div class = "row" id = "contentsection">
<?php custom_breadcrumbs(); ?>
    <div id = "content-box">
        <div class = "large-12 column">
<?php   if(have_posts()): ?>
<?php   while(have_posts()): the_post(); ?>
<h2 class = "content-title"><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php   endwhile; ?>
<?php   else: ?>
<?php get_template_part('content', '404'); ?>
<?php   endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
