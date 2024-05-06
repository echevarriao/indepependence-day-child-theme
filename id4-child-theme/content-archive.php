<?php

$cats = get_the_terms(get_the_ID(), 'senior-design');
// $cats = get_taxonomy('seniordesignproject');

// var_dump($cats);

foreach($cats as $term){

// print $term->name;

}

?>
<?php if(has_post_thumbnail($post->ID)):?>
	<img src = "<?php the_post_thumbnail_url(); ?>" alt = "team photo" width = "100%" />
<?php endif; ?>
	<p class = "text-center"><span class = "proj-title"><a href = "<?php the_permalink(); ?>"><?php print get_field('project_title'); ?></a></span></p>
	<p class = "text-center"><span class = "proj-num"><a href = "<?php the_permalink(); ?>"><?php print $term->name; ?> Team <?php print get_field('team_number'); ?></a></span></p>
