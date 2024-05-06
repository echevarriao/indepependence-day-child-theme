<?php

	$projects = new WP_Query(array(
				'post_type' => 'seniorprojectpt',
				'post_status' => $_POST['publishstatus'],
                'orderby' => 'title',
                'order' => $_POST['order'],
				'tax_query' => array(
					array('taxonomy' => 'seniorprojectcategories', 
						'field' => 'slug', 
						'terms' => $_POST['cat_opts'],
						), 
					),
				     ));
?>
<button onclick = "download_csv_file();">Download Data</button>

<script language = "javascript" type = "text/javascript">

<?php if($projects->have_posts()) { ?>

	var elemId = null;
	var csv = "";
	var csvData = null;

function download_csv_file() {

	var myLink = null;
	
	elemId = null;
	csv = "Team Manager E-Mail,Under NDA Status,Has Video,Team,Team Photo,Sponsor Logo,Figure One,Figure Two,Team Number,Faculty Advisor,Partnered with Teams,Teams List,Sponsor,Other Sponsor,Has Non-UConn Advisor,Non-UConn Advisor Name,Project Title,Description,Full Description,Member 1,Member 2,Member 3,Member 4,Member 5,Member 6,Last Updated - Pretty Format, Last Updated - YYYY-MM-DD\n";
	csvData = { "projects" : [

<?php while($projects->have_posts()) { $projects->the_post();
			
			$m_data .= "{";
			$m_data .= "'author': \"" . get_the_author_meta('user_email') . "\",";
			$m_data .= "'is_public': \"" . get_field('is_public') . "\",";
			$m_data .= "'video': \"" . (get_field('kaltura_video') ? "Yes" : "No" . "\",";
			$m_data .= "'project': \"" . get_the_title() . "\",";	
			$m_data .= "'teamphoto': \"" . get_field('team_photo') . "\",";	
			$m_data .= "'sponsorlogo': \"" . get_field('sponsor_logo') . "\",";	
			$m_data .= "'figureone': \"" . get_field('figure_one') . "\",";	
			$m_data .= "'figuretwo': \"" . get_field('figure_two') . "\",";	
			$m_data .= "'teamno': \"" . get_field('team_number') . "\",";	
			$m_data .= "'advisor': \"" . str_replace(array(","), " | ", get_field('faculty_advisor')) . "\",";	
			$m_data .= "'multi_team': \"" . get_field('is_multiple_teams') . "\",";	
			$m_data .= "'other_teams': \"" . implode(" | ", get_field('multiple_other_teams_list')) . "\",";	
			$m_data .= "'sponsor': \"" . str_replace(array(","), " ", get_field('sponsor')) . "\",";	
			$m_data .= "'other_sponsor': \"" . str_replace(array(","), " ", get_field('other_sponsor')) . "\",";	
			$m_data .= "'has_non_uconn_advisor': \"" . str_replace(array(","), "", get_field('have_a_non_uconn_project_sponsor_advisor')) . "\",";	
			$m_data .= "'non_uconn_advisor': \"" . str_replace(array(","), " | ", get_field('non_uconn_project_sponsor_advisor')) . "\",";	
			$m_data .= "'project_title': \"" . str_replace(array(","), " ", get_field('protect_title')) . "\",";	
			$m_data .= "'description': \"" . str_replace(array("\n", "\r", ",", "\"\""), "", esc_html(get_field('project_description'))) . "\",";	
			$m_data .= "'full_desc': \"" . str_replace(array("\n", "\r", ",", "\"\""), "", esc_html(get_field('full_project_description'))) . "\",";	
			$m_data .= "'team_mem_1': \"" . str_replace(array(","), "", get_field('team_member_1')) . "\",";	
			$m_data .= "'team_mem_2':\"" . str_replace(array(","), "", get_field('team_member_2')) . "\",";	
			$m_data .= "'team_mem_3':\"" . str_replace(array(","), "", get_field('team_member_3')) . "\",";	
			$m_data .= "'team_mem_4':\"" . str_replace(array(","), "", get_field('team_member_4')) . "\",";	
			$m_data .= "'team_mem_5':\"" . str_replace(array(","), "", get_field('team_member_5')) . "\",";	
                        $m_data .= "'team_mem_6':\"" . str_replace(array(","), "", get_field('team_member_6')) . "\",";
                        $m_data .= "'pretty_modified_time': \"" . get_the_modified_time('F jS Y - h:i a') . "\",";
                        $m_data .= "'mod_time': \"" . get_the_modified_time('Y-m-d - h:i a') . "\"";
			$m_data .= "},\n";	
			
		}

		$m_data .= "{'author': null,'is_public': null,'project': null,'teamphoto': null,'sponsorlogo': null,'figureone': null,'figuretwo': null,'teamno': null,'advisor': null,'multi_team': null,'other_teams': null,'sponsor': null,'other_sponsor': null,'has_non_uconn_advisor': null,'non_uconn_advisor': null,'project_title': null,'description': null,'full_desc': null,'team_mem_1': null,'team_mem_2':null,'team_mem_3':null,'team_mem_4':null,'team_mem_5':null,'team_mem_6':null,'pretty_modified_time': null,'mod_time': null}\n";
		
		echo $m_data;
		
?>
]
};

	csvData.forEach(function(row) {
	  
	  csv = csv + row.join(',');
	  csv = csv + "\n";
	  
	});

	elemId = document.createElement("a");

	elemId.setAttribute("href", "data:text/csv;charset=utf-8," + encodeURIComponent("\uFEFF" + csv));
	elemId.setAttribute("download", "sdd.csv");
	elemId.click();

	return;

}

</script>
<div id = "csvInfo"></div>
<?php
		
	} else {
		
		
	}
	
?>
