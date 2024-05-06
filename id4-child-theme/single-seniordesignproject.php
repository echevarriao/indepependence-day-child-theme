<?php get_header(); ?>

<?php if(have_posts()){ ?>

<?php while(have_posts()){ the_post(); ?>

<!-- <h3 class = "content-title"><?php print get_field('project_title'); ?></h3> -->
<?php

	$img_logo = get_field('sponsor_logo');
	$team_mems = array();
	$yt_video = get_field('youtube_video');;
	$the_team = "";
	$counter = 0;
	$t_mem = "";
	$fig_one = "";
	$fig_two = "";
	$fig_count = 0;

	for($i = 0; $i < 7; $i++){

	$t_mem = get_field("team_member_$i");

	if($t_mem){

	$team_mems[$counter] = $t_mem;
	$counter = $counter + 1;

	}

	}

	$the_team = implode("<br />", $team_mems);

	$fig_one = get_field('figure_one');
	$fig_two = get_field('figure_two');

?>
<?php edit_post_link( __( 'Edit Senior Design Project', 'textdomain' ), '<p>', '</p>', null, 'button radius' ); ?>
<div class = "teaminfo long-row">
	<div class = "large-6 left">
		<div id = "" class = "column long-row left-box">
		<img src = "<?php print get_field('team_photo'); ?>" id = "teamphoto" alt = "team photo" />
		</div>
		<div id = "" class = "column long-row">
		</div>
		<div id = "" class = "column long-row left-box">
<?php

print "<!-- $yt_video -->";

if($yt_video){

$yt_video = preg_replace('/watch\?v=/i', 'embed/', $yt_video);

?>
<iframe width="100%" height="350" src="<?php print $yt_video ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
} else {

?>
<img src = "<?php print get_stylesheet_directory_uri() ?>/images/no-video.jpg" alt = "no video icon" width = "100%" />
<p>This video contains proprietary information and cannot be shared publicly at this time.</p>
<?php

}

?>
		</div>
		<div class = "column long-row">
<?php if(strlen($fig_one) > 0) { 

$fig_count = $fig_count + 1;

?>
<p><b>Figure <?php print $fig_count; ?></b><br clear = "all" />
<img src = "<?php print $fig_one; ?>" alt = "project photo" />
</p>
<?php } ?>
<?php if(strlen($fig_two) > 0) { 

$fig_count = $fig_count + 1;

?>
<p><b>Figure <?php print $fig_count; ?></b><br clear = "all" />
<img src = "<?php print $fig_two; ?>" alt = "project photo" />
</p>
<?php } ?>
		</div>
	</div>
	<div class = "large-6 column left right-box">
	<p><span class = "deptname"><?php print get_field('department'); ?></span><br />
	<span class = "teamno">Team <?php print get_field('team_number'); ?></p>
		<table id = "teambox" cellpadding = "5" width = "100%" cellspacing = "0">
			<tr>
				<td><p><span class = "projtext tablelabel">Team Members</span></p></td>
				<td><p><span class = "projtext tablelabel">Faculty Advisor</span></p></td>
			</tr>
			<tr>
				<td valign = "top"><p><span class = "projtext"><?php print $the_team; ?></span></p></td>
				<td valign = "top"><p><span class = "projtext"><?php print get_field('faculty_advisor'); ?></span></p>
<?php if(get_field('have_a_non_uconn_project_sponsor_advisor') == "Yes") { ?>
<!-- <p><span class = "projtext tablelabel">Non-UConn Project Sponsor Advisor </span></p>
<p><span class = "projtext"><?php print get_field('non_uconn_project_sponsor_advisor'); ?></span></p> -->
<?php } else { print ""; }?>


</td>
			</tr>
		</table>

	<p>sponsored by<br />
        <?php if($img_logo) { 

        print "<img src = \"$img_logo\" width = \"50%\" alt = \"sponsor logo\" />";

        } else {

        print "Sponsor Image Not Available";

        }
?>	
	</p>
	<!-- project title -->
	<p><span class = "project-title"><?php print get_field('project_title'); ?></span></p>
		<div id = "projdesc" class = "projtext">
        	<?php print get_field('project_description'); ?>
		</div>
	</div>
</div>


<?php } ?>

<?php } else { ?>

<?php } ?>

<?php get_footer(); ?>
