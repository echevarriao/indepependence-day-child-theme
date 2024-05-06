<?php /* Template Name: All Sponsors Graphics */ ?>
<?php get_header(); ?>

<?php // $argv = array('post_type' => 'seniordesignproject'); 

$argv = array('posts_per_page' => '300', 'post_type' => 'seniorprojectpt', 'tax_query' => array(

array(

'taxonomy' => 'seniorprojectcategories',
'field' => 'slug',
'terms' => '2021',
),

));


?>
<?php $pg = new WP_Query($argv); ?>
<?php if($pg->have_posts()){ ?>
<ul class = "small-block-grid-1 medium-block-grid-2 large-block-grid-3">
<?php 		while($pg->have_posts()){ $pg->the_post(); 

$img_src = get_field('sponsor_logo', get_the_ID());

if($img_src) {
?>

<li><img src = "<?php print get_field('sponsor_logo', get_the_ID()); ?>" alt = "photo sponsor" align = "right" hspace = "5" /></li>
<?php 	

}


	} ?>
</ul>
<?php 		wp_reset_postdata(); ?>

<?php } else { ?>


<?php } ?>
<?php get_footer(); ?>
