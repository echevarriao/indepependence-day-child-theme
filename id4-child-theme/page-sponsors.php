<?php /* Template Name: All Sponsors */ ?>
<?php get_header(); ?>

<?php $argv = array('posts_per_page' => '300', 'post_type' => 'seniorprojectpt', 'tax_query' => array(

array(

'taxonomy' => 'seniorprojectcategories',
'field' => 'slug',
'terms' => '2021',
),

)); ?>
<?php $pg = new WP_Query($argv); ?>
<?php if($pg->have_posts()){ ?>
<p>
<?php

$i = 1;

 		while($pg->have_posts()){ $pg->the_post(); ?>
<?php

$sponsor = get_field('sponsor');
$other_sponsor = get_field('other_sponsor');
?>
<?php if($sponsor != 'Other') {

print $i . "|" . get_the_title() . "|" . $sponsor;

} elseif($sponsor == 'Other') { 

print $i . "|" . get_the_title() . "|" . $other_sponsor;

} else {


} 

$i++;

?>
<br />
<?php 		} ?>
</p>
<?php 		wp_reset_postdata(); ?>

<?php } else { ?>


<?php } ?>
<?php get_footer(); ?>
