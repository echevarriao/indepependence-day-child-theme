<?php

//////////////// add menu ////////////////////

add_action('admin_menu', 'export_projects_menu');

function export_projects_menu (){
	
	add_menu_page ('Senior Projects Utilities', 'Senior Project Actions', 'manage_options', 'custompage', 'display_sdd_menu_page', 'dashicons-tickets', 6);
	
}

function display_sdd_menu_page(){
	
	?>
	<h1>Export Senior Design Project</h1>
	<?php

	$sdd_terms = array();
	$sdd_obj = null;
	$sdd_action = "";
	$sdd_dis_type = array('table', 'csv', 'xls');
	$projects = null;
	$sdd_terms = get_terms(
		array('hide_empty' => false, 'taxonomy' => 'seniorprojectcategories')
	);
?>
<p><b>Export Senior Project Data: </b></p>
	<form action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=custompage" method = "post">
<input type = "hidden" name = "actiontype" value = "categoryexport" />
<p><b>Category to Export: </b><select name = "cat_opts">
	<?php	
	
	foreach ($sdd_terms as $sdd_obj){

		print "<option value = \"" . $sdd_obj->slug . "\">" . $sdd_obj->name. "</option>\n";
		
	}
?>
	</select>
<p><b>Publish Status: </b> <label>All</label></p>
<p><b>Export As: </b> <label><input type = "radio" value = "csv" name = "displayas" checked /> Comma Seperated Values (csv)</label> <label><input type = "radio" value = "table" name = "displayas"  /> HTML Tablular Format</label> <label><input type = "radio" value = "xls" name = "displayas"  /> Excel Format</label></p>
<p><b>Order Title by: </b> <label><input type = "radio" value = "asc" name = "order" checked /> Ascending Order(asc)</label> <label><input type = "radio" value = "desc" name = "order"  /> Descending Order (desc)</label></p>
<input type = "submit" value = "Export Data"/></form>
<?php

	if($_POST['actiontype'] == "categoryexport" && $_POST['displayas'] == 'csv') {

	include("export-sdd-csv.php");		
		
	} elseif($_POST['actiontype'] == "categoryexport" && $_POST['displayas'] == 'table') {

	include("export-sdd-table.php");		
		
	} elseif($_POST['actiontype'] == "categoryexport" && $_POST['displayas'] == 'xls') {

	include("export-sdd-xls.php");
		
	} else {
		
	// do nothing;
		
	}

}

//////////////////////////////////////////////

//if(function_exists('show_rand_project_sc')){ 

add_shortcode('show_depts_projects', 'show_depts_projects_sc');

function show_depts_projects_sc($argv = ''){

	$atts = array();
	$wp_q = null;
	$data_inf = "";
	$dept = "";
	$defaults = array('dept' => '');
	$content = "";
	$m_team_img = "";
        $depts = array(
'se-2020' => 'Systems Engineering', 'me-2020' => 'Mechanical Engineering','mse-2020' => 'Materials Science &amp; Engineering', 'mem-2020' => 'Management &amp; Engineering for Manufacturing','enve-2020' => 'Environmental Engineering','ece-2020' => 'Electrical &amp; Computer Engineering','cse-2020' => 'Computer Science &amp; Engineering','ce-2020' => 'Civil Engineering','cbe-2020' => 'Chemical &amp; Biomolecular Engineering','bme-2020' => 'Biomedical Engineering', 
'se-2021' => 'Systems Engineering', 'me-2021' => 'Mechanical Engineering','mse-2021' => 'Materials Science &amp; Engineering', 'mem-2021' => 'Management &amp; Engineering for Manufacturing','enve-2021' => 'Environmental Engineering','ece-2021' => 'Electrical &amp; Computer Engineering','cse-2021' => 'Computer Science &amp; Engineering','ce-2021' => 'Civil Engineering','cbe-2021' => 'Chemical &amp; Biomolecular Engineering','bme-2021' => 'Biomedical Engineering', '2023-systems-engineering' => 'Systems Engineering','2023-mechanical-engineering' => 'Mechanical Engineering','2023-materials-science-and-engineering' => 'Materials Science and Engineering','2023-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2023-environmental-engineering' => 'Environmental Engineering','2023-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2023-computer-science-and-engineering' => 'Computer Science and Engineering', '2023-civil-engineering' => 'Civil Engineering','2023-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2023-biomedical-engineering' => 'Biomedical Engineering', 
			
			'2024-systems-engineering' => 'Systems Engineering','2024-mechanical-engineering' => 'Mechanical Engineering','2024-materials-science-and-engineering' => 'Materials Science and Engineering','2024-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2024-environmental-engineering' => 'Environmental Engineering','2024-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2024-computer-science-and-engineering' => 'Computer Science and Engineering',
'2024-civil-engineering' => 'Civil Engineering','2024-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2024-biomedical-engineering' => 'Biomedical Engineering');
	$m_title = "";
	$m_content = "";
	$m_teamno = "";
	$m_sponsor_logo = "";

	$atts = shortcode_atts($defaults, $argv);

	if($atts['dept'] == ''){

	$data_inf = '';

	} elseif($atts['dept'] != ''){

	$dept = $atts['dept'];

	$wp_q = new WP_Query(array('post_type' => 'seniorprojectpt', 
               'orderby' => 'meta_value_num',
                'meta_key' => 'team_number',
                'order' => 'ASC',

				   'tax_query' => array(
					array('taxonomy' => 'seniorprojectcategories', 
						'field' => 'slug', 
						'terms' => $dept,
						), 
					),
				     )
				);


		if(count($wp_q->posts) > 0){

			if($wp_q->have_posts()){

			while($wp_q->have_posts()){ $wp_q->the_post();

			$m_team_mem = "<p>\n";
			
			if($m_mem = get_field('team_member_1') != ''){ $m_team_mem .= get_field('team_member_1') . "<br />\n"; }
			if($m_mem = get_field('team_member_2') != ''){ $m_team_mem .= get_field('team_member_2') . "<br />\n"; }
			if($m_mem = get_field('team_member_3') != ''){ $m_team_mem .= get_field('team_member_3') . "<br />\n"; }
			if($m_mem = get_field('team_member_4') != ''){ $m_team_mem .= get_field('team_member_4') . "<br />\n"; }
			if($m_mem = get_field('team_member_5') != ''){ $m_team_mem .= get_field('team_member_5') . "<br />\n"; }
			if($m_mem = get_field('team_member_6') != ''){ $m_team_mem .= get_field('team_member_6') . "<br />\n"; }

			$m_team_mem .= "</p>\n";

			$m_dept = $depts[$dept];
			$m_fac_advisor = preg_replace('/,/', '<br />', get_field('faculty_advisor'));
			$m_sponsor_logo = get_field('sponsor_logo');
			$m_title = get_field('project_title');
			$m_teamno = get_field('team_number');
			$m_ind_advisor = get_field('non_uconn_project_sponsor_advisor');
			$m_team_img = get_field('team_photo');
			$m_project_desc = get_field('project_description');


			if($m_ind_advisor){

			$m_ind_advisor = "<b>INDUSTRY ADVISOR</B>\n<p>$m_ind_advisor</p>\n";

			} else { $m_ind_advisor = ""; }


			$content = "<table border = '0' cellspacing = '0' style = 'border: 0;'>\n
<tr bgcolor = \"#ffffff\" style = \"height: 200px !important;\">\n
	<td valign = \"top\" width = \"20%\" bgcolor = \"#335eb0\"><h4 style = \"text-transform: uppercase; padding: 5px; font-weight: bold; background-color: #335eb0; color: #fff;\">$m_dept</h4></td>\n
	<td valign = \"top\" width = \"30%\" style = 'padding-top: 0;'><img align = 'left' vspace = '0' hspace = '0' width = \"100%\" src = \"$m_team_img\" style = 'padding: 0; margin: 0; float: left; position: relative;' alt = \"team photo\" /></td>\n
	<td valign = \"top\"><b>TEAM $m_teamno</b>\n$m_team_mem</td>\n
	<td valign = \"top\" style = 'border-right: 1px solid #000; border-left: 1px solid #000;'><b>ADVISOR</b><br />\n$m_fac_advisor</p>\n
	$m_ind_advisor</td>\n
	<td valign = \"top\" width = \"20%\" valign = \"top\"><b>SPONSOR</b>\n
	<br clear = \"all\" />\n
	<img src = \"$m_sponsor_logo\" alt = \"sponsor logo\" /></td>\n
</tr>\n
<tr style = \"background-color: #ffffff\">\n
	<td colspan = \"5\">\n
		<h3 style = \"font-weight: bold; text-transform: uppercase; \">$m_title</h3>\n
		<p>$m_project_desc</p>\n
	</td>\n
</tr>\n
</table>\n";

			$data_inf .= $content;
			$content = "";

			}

        wp_reset_postdata();

			}

		} else {

		$data_inf = '';

		}

	} else {


	}

	return $data_inf;

}

//////////////////////////////////

add_shortcode('show_depts_projects_photos', 'show_depts_projects_photos_sc');

function show_depts_projects_photos_sc($argv = ''){

	$atts = array();
	$wp_q = null;
	$data_inf = "";
	$dept = "";
	$p_status = "publish";
	$defaults = array('dept' => '', 'post_status' => 'publish');
	$content = "";
	$m_team_img = "";
        $depts = array(
'se-2020' => 'Systems Engineering', 'me-2020' => 'Mechanical Engineering','mse-2020' => 'Materials Science &amp; Engineering', 'mem-2020' => 'Management &amp; Engineering for Manufacturing','enve-2020' => 'Environmental Engineering','ece-2020' => 'Electrical &amp; Computer Engineering','cse-2020' => 'Computer Science &amp; Engineering','ce-2020' => 'Civil Engineering','cbe-2020' => 'Chemical &amp; Biomolecular Engineering','bme-2020' => 'Biomedical Engineering', 
'se-2021' => 'Systems Engineering', 'me-2021' => 'Mechanical Engineering','mse-2021' => 'Materials Science &amp; Engineering', 'mem-2021' => 'Management &amp; Engineering for Manufacturing','enve-2021' => 'Environmental Engineering','ece-2021' => 'Electrical &amp; Computer Engineering','cse-2021' => 'Computer Science &amp; Engineering','ce-2021' => 'Civil Engineering','cbe-2021' => 'Chemical &amp; Biomolecular Engineering','bme-2021' => 'Biomedical Engineering',
'2022-systems-engineering' => 'Systems Engineering', '2022-mechanical-engineering' => 'Mechanical Engineering','2022-materials-science-and-engineering' => 'Materials Science &amp; Engineering', '2022-management-engineering-for-manufacturing' => 'Management &amp; Engineering for Manufacturing','2022-environmental-engineering' => 'Environmental Engineering','2022-electrical-and-computer-engineering' => 'Electrical &amp; Computer Engineering','2022-computer-science-and-engineering' => 'Computer Science &amp; Engineering','2022-civil-engineering' => 'Civil Engineering','2022-chemical-and-biomolecular-engineering' => 'Chemical &amp; Biomolecular Engineering','2022-biomedical-engineering' => 'Biomedical Engineering','2023-systems-engineering' => 'Systems Engineering','2023-mechanical-engineering' => 'Mechanical Engineering','2023-materials-science-and-engineering' => 'Materials Science and Engineering','2023-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2023-environmental-engineering' => 'Environmental Engineering','2023-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2023-computer-science-and-engineering' => 'Computer Science and Engineering',
'2023-civil-engineering' => 'Civil Engineering','2023-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2023-biomedical-engineering' => 'Biomedical Engineering',
			
'2024-systems-engineering' => 'Systems Engineering','2024-mechanical-engineering' => 'Mechanical Engineering','2024-materials-science-and-engineering' => 'Materials Science and Engineering',
'2024-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2024-environmental-engineering' => 'Environmental Engineering',
'2024-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2024-computer-science-and-engineering' => 'Computer Science and Engineering',
'2024-civil-engineering' => 'Civil Engineering','2024-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2024-biomedical-engineering' => 'Biomedical Engineering'			
			
);
	$m_title = "";
	$m_content = "";
	$m_teamno = "";
	$m_sponsor_logo = "";

	$atts = shortcode_atts($defaults, $argv);

	if($atts['dept'] == ''){

	$data_inf = '';

	} elseif($atts['dept'] != ''){

	$dept = $atts['dept'];
	$p_status = $atts['post_status'];

	$wp_q = new WP_Query(array('post_type' => 'seniorprojectpt', 'post_status' => $p_status, 'post_per_page' => 300,
               'orderby' => 'meta_value_num',
                'meta_key' => 'team_number',
                'order' => 'DESC',

				   'tax_query' => array(
					array('taxonomy' => 'seniorprojectcategories', 
						'field' => 'slug', 
						'terms' => $dept,
						), 
					),
				     )
				);

		if(count($wp_q->posts) > 0){
		
			if($wp_q->have_posts()){

			while($wp_q->have_posts()){ $wp_q->the_post();

			$m_dept = $depts[$dept];
			$m_fac_advisor = preg_replace('/,/', '<br />', get_field('faculty_advisor'));
			$m_sponsor_logo = get_field('sponsor_logo');
			$m_title = get_field('project_title');
			$m_teamno = get_field('team_number');
			$m_ind_advisor = get_field('non_uconn_project_sponsor_advisor');
			$m_team_img = get_field('team_photo');
			$m_project_desc = get_field('project_description');
			$content = "<table border = '0' cellspacing = '0' style = 'border: 0;'>\n
<tr bgcolor = \"#ffffff\">\n
	<td valign = \"top\" style = 'padding-top: 0;'><p><b>" . get_the_title() . "</b></p></td>\n
</tr>\n
<tr bgcolor = \"#ffffff\">\n
	<td valign = \"top\" style = 'padding-top: 0;'><img align = 'left' vspace = '0' hspace = '0' width = \"100%\" src = \"$m_team_img\" style = 'padding: 0; margin: 0; float: left; position: relative;' alt = \"team photo\" /></td>\n
</tr>\n
</table>\n";

			$data_inf .= $content;

			}

			$content = "";
			
        wp_reset_postdata();

			}

		} else {

		$data_inf = '';

		}

	} else {


	}

	return $data_inf;

}

//////////////////////////////////


function show_rand_project_sc($argv = [], $content = null){

	$m_content = "";
	$m_post = array();
	$m_query = null;
	$depts = array(
'se-2020' => 'Systems Engineering', 'me-2020' => 'Mechanical Engineering','mse-2020' => 'Materials Science and Engineering',
'mem-2020' => 'Management and Engineering for Manufacturing','enve-2020' => 'Environmental Engineering','ece-2020' => 'Electrical and Computer Engineering','cse-2020' => 'Computer Science and Engineering',
'ce-2020' => 'Civil Engineering','cbe-2020' => 'Chemical and Biomolecular Engineering','bme-2020' => 'Biomedical Engineering',
'se-2021' => 'Systems Engineering', 'me-2021' => 'Mechanical Engineering','mse-2021' => 'Materials Science and Engineering',
'mem-2021' => 'Management and Engineering for Manufacturing','enve-2021' => 'Environmental Engineering','ece-2021' => 'Electrical and Computer Engineering','cse-2021' => 'Computer Science and Engineering',
'ce-2021' => 'Civil Engineering','cbe-2021' => 'Chemical and Biomolecular Engineering','bme-2021' => 'Biomedical Engineering',
'mem-2022' => 'Management and Engineering for Manufacturing','enve-2022' => 'Environmental Engineering','ece-2022' => 'Electrical and Computer Engineering','cse-2022' => 'Computer Science and Engineering',
'ce-2022' => 'Civil Engineering','cbe-2022' => 'Chemical and Biomolecular Engineering','bme-2022' => 'Biomedical Engineering','2023-systems-engineering' => 'Systems Engineering','2023-mechanical-engineering' => 'Mechanical Engineering','2023-materials-science-and-engineering' => 'Materials Science and Engineering','2023-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2023-environmental-engineering' => 'Environmental Engineering','2023-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2023-computer-science-and-engineering' => 'Computer Science and Engineering',
'2023-civil-engineering' => 'Civil Engineering','2023-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2023-biomedical-engineering' => 'Biomedical Engineering',
		
'2024-systems-engineering' => 'Systems Engineering','2024-mechanical-engineering' => 'Mechanical Engineering','2024-materials-science-and-engineering' => 'Materials Science and Engineering',
'2024-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2024-environmental-engineering' => 'Environmental Engineering',
'2024-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2024-computer-science-and-engineering' => 'Computer Science and Engineering',
'2024-civil-engineering' => 'Civil Engineering','2024-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2024-biomedical-engineering' => 'Biomedical Engineering'		
);
	$depturl = "";

	if(key_exists($argv['dept'], $depts)){

	$m_content .= "<!-- display project content -->";

	} else {

	$m_content .= "<p><b>There is no such program or department participating in senior design.</b></p>";

	return $m_content;

	}

	$depturl = $argv['depturl'];

	if(preg_match('/.uconn.edu/i', $depturl)){

	$m_content .= "<!-- display project content -->";

	} else {

	$m_content .= "<p><b>Please enter a valid UConn URL</b></p>";

	return $m_content;

	}

	


	$atts = shortcode_atts (

	array(

	null

	), $argv, 'show_rand_project');

	$m_query = new WP_Query(

	array(
//		'post_type' => 'seniordesignproject', 
		'post_status' => 'publish',
		'post_type' => 'seniorprojectpt', 
		'posts_per_page' => 1,
		'orderby' => 'rand',
		'tax_query' => array(
			//'relation' => 'AND',

			array(

//			'taxonomy' => 'senior-design',
			'taxonomy' => 'seniorprojectcategories',
			'field' => 'slug',
			'terms' => array($argv['dept']),

			) /*,
			array(

			'taxonomy' => 'senior-design',
			'field' => 'slug',
			'terms' => array($argv['year']),

			)*/

		)

	));

	if($m_query->have_posts()){

	while($m_query->have_posts()) {

	$m_query->the_post();
	

//	$m_content .= "<li class = \"grid-item\">\n";

	$m_link = get_the_permalink();
	$m_feat_img = get_the_post_thumbnail_url();
	$m_proj_title = get_field('project_title');
	$m_dept = $depts[$argv['dept']];
	$m_teamno = get_field('team_number');

        $m_content .= "<div>\n";

	if(has_post_thumbnail($m_query->post->ID)):

        $m_content .= "<img src = \"$m_feat_img\" alt = \"team photo\" width = \"100%\" />\n";

	elseif($m_teamphoto = get_field('team_photo')):

	$m_content .= "<img src = \"$m_teamphoto\" alt = \"team photo\" width = \"100%\" />";

	else:

	endif; 

	$m_url = get_the_permalink();

        $m_content .= "<p class = \"text-center\"><span class = \"proj-title\"><a href = \"$m_url\">$m_proj_title</a></span></p>\n";
        $m_content .= "<p class = \"text-center\"><span class = \"proj-num\"><a href = \"$m_url\">$m_dept Team $m_teamno</a></span></p>\n";
	
	$m_content .= "</div>\n";
	
	} // end whle loop

	wp_reset_postdata();

	} else  { // end if

	$m_content .= "<p><b>There is no such program or department participating in senior design.</b></p>";

	}

//	$m_content .= "</ul>\n";

	return $m_content;

}

add_shortcode('show_rand_project', 'show_rand_project_sc');

// }

// if(function_exists('show_design_projects_sc')){

function show_design_projects_sc($argv = [], $content = null){

	$m_content = "";
	$m_post = array();
	$m_query = null;
	$depts = array(

'se-2020' => 'Systems Engineering', 'me-2020' => 'Mechanical Engineering','mse-2020' => 'Materials Science and Engineering',
'mem-2020' => 'Management and Engineering for Manufacturing','enve-2020' => 'Environmental Engineering','ece-2020' => 'Electrical and Computer Engineering','cse-2020' => 'Computer Science and Engineering',
'ce-2020' => 'Civil Engineering','cbe-2020' => 'Chemical and Biomolecular Engineering','bme-2020' => 'Biomedical Engineering',
'se-2021' => 'Systems Engineering', 'me-2021' => 'Mechanical Engineering','mse-2021' => 'Materials Science and Engineering',
'mem-2021' => 'Management and Engineering for Manufacturing','enve-2021' => 'Environmental Engineering','ece-2021' => 'Electrical and Computer Engineering','cse-2021' => 'Computer Science and Engineering',
'ce-2021' => 'Civil Engineering','cbe-2021' => 'Chemical and Biomolecular Engineering','bme-2021' => 'Biomedical Engineering',
'se-2022' => 'Systems Engineering','me-2022' => 'Mechanical Engineering','mse-2022' => 'Materials Science and Engineering','mem-2022' => 'Management and Engineering for Manufacturing','enve-2022' => 'Environmental Engineering',
'ece-2022' => 'Electrical and Computer Engineering','cse-2022' => 'Computer Science and Engineering',
'ce-2022' => 'Civil Engineering','cbe-2022' => 'Chemical and Biomolecular Engineering','bme-2022' => 'Biomedical Engineering',
'2023-systems-engineering' => 'Systems Engineering','2023-mechanical-engineering' => 'Mechanical Engineering','2023-materials-science-and-engineering' => 'Materials Science and Engineering',
'2023-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2023-environmental-engineering' => 'Environmental Engineering',
'2023-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2023-computer-science-and-engineering' => 'Computer Science and Engineering',
'2023-civil-engineering' => 'Civil Engineering','2023-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2023-biomedical-engineering' => 'Biomedical Engineering',
		
'2024-systems-engineering' => 'Systems Engineering','2024-mechanical-engineering' => 'Mechanical Engineering','2024-materials-science-and-engineering' => 'Materials Science and Engineering',
'2024-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2024-environmental-engineering' => 'Environmental Engineering',
'2024-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2024-computer-science-and-engineering' => 'Computer Science and Engineering',
'2024-civil-engineering' => 'Civil Engineering','2024-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2024-biomedical-engineering' => 'Biomedical Engineering'		

);

	if(key_exists($argv['dept'], $depts)){

	$m_content .= "<!-- display content -->";

	} else {

	$m_content .= "<p><b>There is no such program or department participating in senior design.</b></p>";

	return $m_content;

	}


	$atts = shortcode_atts (

	array(

	null

	), $argv, 'show_design_projects_li');




	$m_content .= "
<style>

[class*=\"block-grid-\"] > li {
    display: block;
    float: left;
    height: auto;
    padding: 0 0rem 0rem;
}
</style>

<ul class = \"grid\">\n";

	$m_query = new WP_Query(

	array(
//		'post_type' => 'seniordesignproject', 
		'post_type' => 'seniorprojectpt', 
		'orderby' => 'meta_value_num',
		'meta_key' => 'team_number',
		'order' => 'ASC',
		'tax_query' => array(
			// 'relation' => 'AND',

			array(

			'taxonomy' => 'seniorprojectcategories',
			'field' => 'slug',
			'terms' => array($argv['dept']),

			) /*,
			array(

			'taxonomy' => 'seniorprojectcategories',
			'field' => 'slug',
			'terms' => array($argv['year']),

			)*/

		)

	));

	if($m_query->have_posts()){

	while($m_query->have_posts()) {

	$m_query->the_post();
	

	$m_content .= "<li class = \"grid-item\">\n";

	$m_link = get_the_permalink();
	$m_feat_img = get_the_post_thumbnail_url();

	if($argv['year'] > 2021) {

	$m_proj_title = get_field('protect_title');

	} else {

	$m_proj_title = get_field('project_title');

	} 

	$m_dept = $depts[$argv['dept']];
	$m_teamno = get_field('team_number');

	

	if(has_post_thumbnail($m_query->post->ID)):

        $m_content .= "<img src = \"$m_feat_img\" alt = \"team photo\" width = \"100%\" />\n";

	elseif($m_teamphoto = get_field('team_photo')):

        $m_content .= "<img src = \"$m_teamphoto\" alt = \"team photo\" width = \"100%\" />\n";

	else:

	// do nothing at this point since there are no images

	endif; 

        $m_content .= "<p class = \"text-center\"><span class = \"proj-title\"><a href = \"$m_link\">$m_proj_title</a></span></p>\n";
        $m_content .= "<p class = \"text-center\"><span class = \"proj-num\"><a href = \"$m_link\">$m_dept Team $m_teamno</a></span></p>\n";
	
	$m_content .= "</li>\n";
	
	} // end whle loop

	wp_reset_postdata();

	} else  { // end if

	$m_content .= "<p><b>There is no such program or department participating in senior design.</b></p>";

	}

	$m_content .= "</ul>\n";

	return $m_content;

}

add_shortcode('show_design_projects_li', 'show_design_projects_sc');

// }


function show_dept_fmt_projects_sc($argv = [], $content = null) {

        $m_content = "";
        $m_post = array();
        $m_query = null;
	$default = array();
        $depts = array(

'se-2020' => 'Systems Engineering', 'me-2020' => 'Mechanical Engineering','mse-2020' => 'Materials Science and Engineering',
'mem-2020' => 'Management and Engineering for Manufacturing','enve-2020' => 'Environmental Engineering','ece-2020' => 'Electrical and Computer Engineering','cse-2020' => 'Computer Science and Engineering',
'ce-2020' => 'Civil Engineering','cbe-2020' => 'Chemical and Biomolecular Engineering','bme-2020' => 'Biomedical Engineering',
'se-2021' => 'Systems Engineering', 'me-2021' => 'Mechanical Engineering','mse-2021' => 'Materials Science and Engineering',
'mem-2021' => 'Management and Engineering for Manufacturing','enve-2021' => 'Environmental Engineering','ece-2021' => 'Electrical and Computer Engineering','cse-2021' => 'Computer Science and Engineering',
'ce-2021' => 'Civil Engineering','cbe-2021' => 'Chemical and Biomolecular Engineering','bme-2021' => 'Biomedical Engineering',
'se-2022' => 'Systems Engineering','me-2022' => 'Mechanical Engineering','mse-2022' => 'Materials Science and Engineering','mem-2022' => 'Management and Engineering for Manufacturing','enve-2022' => 'Environmental Engineering',
'ece-2022' => 'Electrical and Computer Engineering','cse-2022' => 'Computer Science and Engineering',
'ce-2022' => 'Civil Engineering','cbe-2022' => 'Chemical and Biomolecular Engineering','bme-2022' => 'Biomedical Engineering',
'2023-systems-engineering' => 'Systems Engineering','2023-mechanical-engineering' => 'Mechanical Engineering','2023-materials-science-and-engineering' => 'Materials Science and Engineering',
'2023-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2023-environmental-engineering' => 'Environmental Engineering',
'2023-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2023-computer-science-and-engineering' => 'Computer Science and Engineering',
'2023-civil-engineering' => 'Civil Engineering','2023-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2023-biomedical-engineering' => 'Biomedical Engineering',
			'2024-systems-engineering' => 'Systems Engineering','2024-mechanical-engineering' => 'Mechanical Engineering','2024-materials-science-and-engineering' => 'Materials Science and Engineering',
'2024-management-engineering-for-manufacturing' => 'Management and Engineering for Manufacturing','2024-environmental-engineering' => 'Environmental Engineering',
'2024-electrical-and-computer-engineering' => 'Electrical and Computer Engineering','2024-computer-science-and-engineering' => 'Computer Science and Engineering',
'2024-civil-engineering' => 'Civil Engineering','2024-chemical-and-biomolecular-engineering' => 'Chemical and Biomolecular Engineering','2024-biomedical-engineering' => 'Biomedical Engineering'

);

        if(key_exists($argv['dept'], $depts)){

        $m_content .= "<!-- display project content -->";

        } else {

        $m_content .= "<p><b>There is no such program or department participating in senior design.</b></p>";

        return $m_content;

        }

	$depturl = $argv['depturl'];

/*

        if(preg_match('/.uconn.edu/i', $depturl)){

        $m_content .= "<!-- display project content -->";

        } else {

        $m_content .= "<p><b>Please enter a valid UConn URL</b></p>";

        return $m_content;

        }
*/
        $atts = shortcode_atts (

        $defaults, $argv, 'show_dept_fmt_projects'
	
	);

	$m_query = new WP_Query(

        array(
                'post_type' => 'seniorprojectpt',
                'orderby' => 'meta_value_num',
                'meta_key' => 'team_number',
                'order' => 'ASC',
                'tax_query' => array(

                        array(

                        'taxonomy' => 'seniorprojectcategories',
                        'field' => 'slug',
                        'terms' => array($argv['dept']),

                        )

                )

        ));

?>
<style>

</style>
<?php

	if($m_query->have_posts()){

        	while($m_query->have_posts()) {

        	$m_query->the_post();


		$sponsor = get_field('sponsor');
		$sponsor_logo = get_field('sponsor_logo');
		$figure_one = get_field('figure_one');
		$figure_two = get_field('figure_two');

                        $m_team_mem = "<p>\n";

                        if($m_mem = get_field('team_member_1') != ''){ $m_team_mem .= get_field('team_member_1') . "<br />\n"; }
                        if($m_mem = get_field('team_member_2') != ''){ $m_team_mem .= get_field('team_member_2') . "<br />\n"; }
                        if($m_mem = get_field('team_member_3') != ''){ $m_team_mem .= get_field('team_member_3') . "<br />\n"; }
                        if($m_mem = get_field('team_member_4') != ''){ $m_team_mem .= get_field('team_member_4') . "<br />\n"; }
                        if($m_mem = get_field('team_member_5') != ''){ $m_team_mem .= get_field('team_member_5') . "<br />\n"; }
                        if($m_mem = get_field('team_member_6') != ''){ $m_team_mem .= get_field('team_member_6') . "<br />\n"; }

                        $m_team_mem .= "</p>\n";
?>
<table class = "outerbox">
	<tr>
		<td>
			<table class = "innerbox" border = "0" cellspacing = "0" style = "border: 0;">
				<tr>
					<td colspan = "4"><b><?php the_title(); ?></p></td>
				</tr>
				<tr>
					<td width = "30%" valign = "top"><img src = "<?php print get_field('team_photo'); ?>" id = "teamphoto" alt = "team photo" /></td>
					<td width = "25%" valign = "top">

						<p><span class="projtext tablelabel">Team Members</span></p>
						<?php print $m_team_mem; ?>
					</td>
					<td valign = "top" width = "25%">
						<p><span class="projtext tablelabel">Faculty Advisor</span></p>
						<p><span class = "projtext"><?php print get_field('faculty_advisor'); ?></span></p>

						<?php

						if($sponsor != 'sponsor not indicated by team') {
?>
						<p><span class="projtext tablelabel">Sponsor</span></p>
						<p><span class = "projtext"><?php print get_field('sponsor'); ?></span></p>
<?php
						}

						?>
					</td>
					<td width = "20%" valign = "top"><?php if($sponsor_logo) { ?>
                                                <p><span class="projtext tablelabel">Sponsor Logo</span></p>
					        <img src = "<?php print $sponsor_logo ?>" width = "100%" alt = "sponsor logo" />
					<?php } else {?>

					<?php } ?></td>
				</tr>
				<tr>
					<td colspan = "4"><p><b><?php print get_field('protect_title'); ?></b></p>
					<p class = "desc-txt"><?php print get_field('project_description'); ?></p></td>
				</tr>
				<tr>
					<td colspan = "2" valign = "top"><?php if($figure_one) { ?>
					<p><b>Figure 1.</b></p>
					<img src = "<?php print $figure_one; ?>" width = "50%" alt = "figure one">
					<?php } ?></td>
					<td colspan = "2" valign = "top"><?php if($figure_two) { ?>
					<p><b>Figure 2.</b></p>
					<img src = "<?php print $figure_two; ?>" width = "50%" alt = "figure two">
					<?php } ?></td>
				</tr>
			</table>
		</td>
	</tr>

</table>
<hr />

<?php

		} 
	
		wp_reset_postdata();


	} else {


	}

}

add_shortcode('show_dept_fmt_projects', 'show_dept_fmt_projects_sc');
