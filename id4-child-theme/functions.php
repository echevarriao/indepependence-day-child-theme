<?php

require_once('senior-design.post-type.php');
require_once('senior-design.taxonomy.php');
require_once('inc/seniordesign.shortcode.php');
// require_once('inc/seniordesign-intake-form.php');

add_filter( 'manage_edit-seniorprojectpt_columns', 'manage_seniorprojectpt_posts_columns', 10, 2 );

function manage_seniorprojectpt_posts_columns($columns) {
    $columns['user_email'] = __('E-Mail', 'text-domain');
    return $columns;
}


add_action( 'manage_seniorprojectpt_posts_custom_column' , 'manage_seniorprojectpt_custom_column', 10, 2 );

function manage_seniorprojectpt_custom_column($column, $post_id) {
	
	$user_info = "";
	
    switch ( $column ) {
		
        case 'user_email' :

		$author_id = get_post_field('post_author', $post_id);
		$user_info = get_userdata($author_id);
		echo "<a href = \"mailto:$user_info->user_email\">$user_info->user_email</a>";
		
        break;
    }
}

add_action('init', 'support_senior_projects');

function support_senior_projects(){

	add_post_type_support('seniordesignproject', 'author');

//	return;

}

add_shortcode('display_dept_proj', 'display_projs_sc');

function display_projs_sc($atts){

        $defaults = array('msg' => 'please enter a category', 'dept' => '', 'icon' => '');
        $icons = array(

'bme' => 'bme-engr.jpg',
'cbe' => 'cbe-engr.jpg',
'cee' => 'cee-engr.jpg',
'cse' => 'cse-engr.jpg',
'ece' => 'ece-engr.jpg',
'enve' => 'enve-engr.jpg',
'mech' => 'mech-engr.jpg',
'mem' => 'mem-engr.jpg',
'mse' => 'mse-engr.jpg',
'sys' => 'sys-engr.jpg'

);
        $defs = null;
        $wp_q = null;
        $html_content = "";
        $final_content = "";
        $proj_title = "";
        $proj_icon = "";
        $sponsor_log = "";
        $team_no = "";
        $team_photo = "";
        $team_mems = "";
        $fac_adv = "";

        $info = shortcode_atts($defaults, $atts);

        if($info['dept']){

        $wp_q = new WP_Query(
//                array('post_type' => 'seniordesignproject', 
                array('post_type' => 'seniorprojectpt', 
                'orderby' => 'meta_value_num',
                'meta_key' => 'team_number',
                'order' => 'ASC',
                'tax_query' => 
                        array(
                                array(
//                                        'taxonomy' => 'senior-design', 
                                        'taxonomy' => 'seniorprojectcategories', 
                                        'field' => 'slug', 
                                        'terms' => $info['dept'],
                                ),
                        )
                )
        );

                if($wp_q->have_posts()){

                while($wp_q->have_posts()){ $wp_q->the_post();


                $sponsor_logo = "";
                $sponsor_img = "";
                $proj_icon = "";
                $team_no = "";
                $team_photo = "";
                $proj_title = "";
                $fac_adv = "";
		$is_multi_team = null;
		$multi_teams = "";
        	$is_multiple_teams = "";
	        $multiple_other_teams_list = "";
		$oth_teams = "";
		$sponsor_text = "";
		$other_sponsor_text = "";
		$non_uc_advisor = "";

        $is_multiple_teams = get_field('is_multiple_teams');
        $multiple_other_teams_list = get_field('multiple_other_teams_list');
	$sponsor_text = get_field('sponsor');
	$other_sponsor_text = get_field('other_sponsor');
	$non_uc_advisor = get_field('non_uconn_project_sponsor_advisor');

//	if($is_multiple_teams == "yes"){

	$oth_teams .= "<p><b>Partnered with the following other teams</b></p>";
	$oth_teams .= "<p>" . implode("<br />", $multiple_other_teams_list) . "</p>";

//	}

	if($non_uc_advisor != null || $non_uc_advisor != "") {

	$non_uc_advisor = "<p><b>Non-UConn Advisor</b></p>\n<p>$non_uc_advisor</p>\n";

	} else {

	$non_uc_advisor = "<p><b>Non-UConn Advisor</b></p>\n<p>None</p>\n";

	}
	

	if($sponsor_text != "Other"){

	$sponsor_text = "<p>$sponsor_text</p>";

	} else {

	$sponsor_text = "<p>Other</p>";

	}

	if($other_sponsor_text != "" || $other_sponsor_text != null) {

	$other_sponsor_text = "<p>$other_sponsor_text</p>";

	} else {

	$other_sponsor_text = "<p>Sponsor Not Avaiable</p>";

	}


                        if($info['icon']){

                        $proj_icon = "<img src = 'https://seniordesignday.engr.uconn.edu/sd-images/" . $icons[$info['icon']] . "' alt = 'photo icon' width = '100%' />";

                        }
               $sponsor_logo = get_field('sponsor_logo');
		$other_sponsor = get_field('other_sponsor');

        
                $team_no = get_field('team_number');
                $sponsor_logo = get_field('sponsor_logo');
                $team_photo = get_field('team_photo');
                $fig_photos = "";
		$cmp_sponsor = get_field('sponsor');

                $fig_one = get_field('figure_one');
                $fig_two = get_field('figure_two');
                $fac_adv = get_field('faculty_advisor');

                if($fig_one){

                $fig_photos .= "<p><b>Figure One</b></p><br /><img src = '$fig_one' alt = 'figure one photo' width = '100%' /><br clear = 'all' />";

                }

                if($fig_two){

                $fig_photos .= "<p><b>Figure Two</b></p><br /><img src = '$fig_two' alt = 'figure two photo' width = '100%' /> <br clear = 'all' />";

                }

                        if($sponsor_logo){

                        $sponsor_img = "<img src = '$sponsor_logo' alt = 'sponsor logo' />";

                        } elseif($sponsor_logo == '' &&  $cmp_sponsor == 'Other') {

			$sponsor_img = $other_sponsor;

			} 


                        if($team_photo){

                        $team_photo = "<img src = '$team_photo' alt = 'group team photo' width = '100%' />";

                        }

                $proj_title = get_field('protect_title');

                $team_mems = "";

        $team_mems .= get_field('team_member_1') . "<br />";
        $team_mems .= get_field('team_member_2') . "<br />";
        $team_mems .= get_field('team_member_3') . "<br />";
        $team_mems .= get_field('team_member_4') . "<br />";
        $team_mems .= get_field('team_member_5') . "<br />";
        $team_mems .= get_field('team_member_6') . "<br />";

                $html_content .= "<table width = '100%' class = '$multi_teams'>
<tr>
        <td valign = 'top' width = '10%'>$proj_icon</td>
        <td valign = 'top' width = '35%'><p><b>" . get_the_title() . "</b></p><br clear = 'all'/>$team_photo</td>
        <td valign = 'top' width = '15%'><p><b>Team $team_no</b></p>
        <p>$team_mems</p>
        </td>
        <td valign = 'top' width = '15%'><p><b>Faculty Advisor(s)</b></p>
        <p>$fac_adv</p>\n
	$non_uc_advisor</td>
        <td valign = 'top' width = '20%'>

<p><b>Sponsor (Text)</b></p>\n$sponsor_text
<p><b>Other Sponsor (Text)</b></p>\n$other_sponsor_text

<p><b>Sponsor Image</b></p>$sponsor_img</td>
</tr>
<tr>
        <td colspan = '5'>
                <h2>
                        <b>
                                " . get_field('protect_title') . "
                        </b>
                </h2>
        </td>
</tr>
<tr>
        <td valign = 'top' colspan = '3'><p><b>Description</b></p>\n<p>" . get_field('project_description') . "</p>$oth_teams</td>
        <td valign = 'top' colspan = '2'>$fig_photos</td>
</tr>
<tr>
        <td colspan = '5' bgcolor = '#000000'><p>&nbsp;</p></td>
</tr>
</table>
";

                } // end while

        return $html_content;

                } else {

                return "No teams to display";

                }

        } else {

        return $defaults['msg'];

        }

        return ;

}




add_action( 'wp_enqueue_scripts', 'load_theme_enqueue_styles' );

function load_theme_enqueue_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', 'parent-style');
	wp_enqueue_style( 'videopopup-style', get_stylesheet_directory_uri() . '/css/video.popup.css');

	wp_enqueue_script('videopopup-script', get_stylesheet_directory_uri() . '/js/video.popup.js');
/*	wp_enqueue_style( 'masonry-style', get_stylesheet_directory_uri() . '/css/masonry.grid.css'); */

	wp_enqueue_script ('masonry');
 
}

