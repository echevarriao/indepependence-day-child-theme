<?php get_header(); ?>
<?php

global $wp_query;
$total_results = $wp_query->found_posts;

if(is_active_sidebar('secondary-page-bannerarea')) {

	dynamic_sidebar('secondary-page-bannerarea');

}
?>
<div class = "row">
<h2 class = "content-title">Search</h2>
<p><strong>Search query:</strong> <?php print $_REQUEST['s']; ?> <strong>returned </strong> <?php print $total_results; ?> <strong>results</strong></p>

<?php if(have_posts()) { ?>
<ol>
<?php while(have_posts()) { the_post(); ?>

<li><p><strong><?php the_title(); ?></strong></p>
<?php the_excerpt(); ?>
<p><a href = "<?php the_permalink(); ?>" class = "button radius medium">View Page</a></p>
<hr />
</li>
<?php } ?>
</ol>

<?php } else { ?>

<p>Your search did not return any results, please try again.</p>
<form method = "get" role = "search" action = "<?php bloginfo('url'); ?>">
<input type = "text" name = "s" id = "s" value = "" style = "" />

</form>

<?php } ?>

<?php wp_reset_postdata(); ?>
</div>
<?php get_footer(); ?>
