<?php /* Template Name: All Students */ ?>
<?php get_header(); ?>

<?php $argv = array('post_type' => 'seniordesignproject'); ?>
<?php $pg = new WP_Query($argv); ?>
<?php if($pg->have_posts()){ ?>
<?php 		while($pg->have_posts()){ $pg->the_post(); ?>
<p>
<?php // print get_the_ID(); ?>
<?php print get_field('team_member_1', get_the_ID()); ?><br />
<?php print get_field('team_member_2', get_the_ID()); ?><br />
<?php print get_field('team_member_3', get_the_ID()); ?><br />
<?php print get_field('team_member_4', get_the_ID()); ?><br />
<?php print get_field('team_member_5', get_the_ID()); ?><br />
<?php print get_field('team_member_6', get_the_ID()); ?><br />
</p>
<?php 		} ?>

<?php 		wp_reset_postdata(); ?>

<?php } else { ?>


<?php } ?>
<?php get_footer(); ?>
