<?php get_header(); ?>
<div class = "row" id = "contentsection">
    <div class = "large-12 column" id = "content-box">
<h2 class = "content-title">
    <?php
$p_type = "";
$p_type = get_post_type();

					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'eversource' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'eversource' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'eversource' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'eversource' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'eversource' ) ) . '</span>' );
					elseif ($p_type == 'seniordesignproject'):
						print "Senior Design Archive";
					else :
						_e( 'Archive Type Not Available', 'eversource' );
					endif;
// print get_post_type();
				?>    
    
</h2>

<p>
<?php posts_nav_link(); ?>
</p>

<!-- <ul class = "grid small-block-grid-1 medium-block-grid-2 large-block-grid-3"> -->
<ul class = "grid">
<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); ?>
	<li class = "grid-item">
<?php get_template_part('content', 'archive'); ?>
	</li>
	<?php endwhile; ?>
<?php else: ?>
	<li>
<?php get_template_part('content', '404'); ?>
	</li>
<?php endif; ?>
</ul>

<p><b>Available Archives</b></p>
<ul>
    <?php wp_get_archives('post_type=seniordesignproject&type=yearly'); ?>
</ul>
	</div>
</div>

<?php get_footer(); ?>
