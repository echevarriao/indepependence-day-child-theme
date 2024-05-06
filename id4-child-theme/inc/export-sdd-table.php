<p>&nbsp;</p>
<script language = "javascript" type = "text/javascript">
	
function save_table_xls(tableID, filename = '') {

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    var secs = "", mins = "", hour = "";

    // Specify file name
    var fileName = new Date();
    fileName = fileName.getTime(); // fileName.getYear() + "" + fileName.getMonth() + "" + fileName.getDay()

    filename = filename ? 'excel-data-' + fileName + '.xls' : 'excel-data-' + fileName + '.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    downloadLink.innerText = "Click";
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }

/*	
	var elemId = null; 
	var dataFormat = 'application/vnd.ms-excel';
	var tableSelection = null;
	var theDownload = null;
	var fileName = "";
	var blob = null;
	var tableID = 'sdd-data';
	
	elemId = document.getElementById(tableID);
	tableSelection = elemId.outerHTML.replace(/ /g, '%20');
	
	fileName = "senior-design-data.xls";
	
	theDownload = document.createElement("a");
	document.body.appendChild(theDownload);
	
	if(navigator.msSaveOrOpenBlob){
		
		blob = new Blob(['\ufeff', tableSelection], {type: dataFormat});
		
		navigator.msSaveOrOpenBlob( blob, fileName);
	
	} else {
		
		theDownload.href = "data:application/vnd.ms-excel, " + tableSelection;
		theDownload.download = fileName;
		theDownload.click();
		
	}
	
	*/
}
</script>
<?php

	$i = 1;
	$p_title = "";
	$projects = new WP_Query(array(
				'post_type' => 'seniorprojectpt',
//				'post_status' => $_POST['publishstatus'],
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
<p><button onClick = "save_table_xls('mydata');">Save Table as Excel Workbook</button></p>
<table id = "mydata" border = "1">
<tr>
<td align = "center" valign = "top">Index ID</td>
<td align = "center" valign = "top"><b>Post Status/CUI</b></td>
<td align = "center" valign = "top"><b>Has NDA/CUI</b></td>
<td align = "center" valign = "top"><b>Under NDA</b></td>
<td align = "center" valign = "top"><b>Has Video</b></td>
<td align = "center" valign = "top"><b>Team Manager E-Mail</b></td>
<td align = "center" valign = "top"><b>Team</b></td>
<td align = "center" valign = "top"><b>Team Photo</b></td>
<td align = "center" valign = "top"><b>Sponsor Logo</b></td>
<td align = "center" valign = "top"><b>Figure One</b></td>
<td align = "center" valign = "top"><b>Figure Two</b></td>
<td align = "center" valign = "top"><b>Team Number</b></td>
<td align = "center" valign = "top"><b>Faculty Advisor</b></td>
<td align = "center" valign = "top"><b>Partnered with Teams</b></td>
<td align = "center" valign = "top"><b>Teams List</b></td>
<td align = "center" valign = "top"><b>Sponsor</b></td>
<td align = "center" valign = "top"><b>Other Sponsor</b></td>
<td align = "center" valign = "top"><b>Has Non-UConn Advisor</b></td>
<td align = "center" valign = "top"><b>Non-UConn Advisor Name</b></td>
<td align = "center" valign = "top"><b>Project Title</b></td>
<td align = "center" valign = "top"><b>Description</b></td>
<td align = "center" valign = "top"><b>Full Description</b></td>
<td align = "center" valign = "top"><b>Member 1</b></td>
<td align = "center" valign = "top"><b>Member 2</b></td>
<td align = "center" valign = "top"><b>Member 3</b></td>
<td align = "center" valign = "top"><b>Member 4</b></td>
<td align = "center" valign = "top"><b>Member 5</b></td>
<td align = "center" valign = "top"><b>Member 6</b></td>
<td align = "center" valign = "top"><b>Last Updated - Pretty Format</b></td>
<td align = "center" valign = "top"><b>Last Updated - YYYY-MM-DD</b></td>
</tr>
<?php
	
	if($projects->have_posts()){
	
	while($projects->have_posts()){
		
		$projects->the_post();
		$p_title = get_the_title();
		$pattern = '/â€“/i';
?>
	<tr>
		<td><?php print $i; ?></td>
		<td><?php print get_post_status(); ?></td>
		<td><?php print get_field('has_nda_cui'); ?></td>
		<td><?php print get_field('is_public'); ?></td>
		<td><?php print (get_field('kaltura_video') ? "Yes" : "No"); ?></td>
		<td><?php print get_the_author_meta('user_email'); ?></td>
		<td><?php print preg_replace($pattern, "-", $p_title); ?></td>
		<td><?php
		
		if(get_field('team_photo')) {
			
?>
<a href = "<?php print get_field("team_photo"); ?>" target = "_blank">View Photo</a><?php	} ?></td>
		<td><?php
		
		if(get_field('sponsor_logo')) {
			
?>
<a href = "<?php print get_field("sponsor_logo"); ?>" target = "_blank">View Sponsor Logo</a><?php	} ?></td>
		<td><?php
		
		if(get_field('figure_one')) {
			
?>
<a href = "<?php print get_field("figure_one"); ?>" target = "_blank">View Figure 1</a><?php	} ?></td>
		<td><?php
		
		if(get_field('figure_two')) {
			
?>
<a href = "<?php print get_field("figure_two"); ?>" target = "_blank">View Figure 2</a><?php	} ?></td>
		<td><?php print get_field('team_number'); ?></td>
		<td><?php print get_field('faculty_advisor'); ?></td>
		<td><?php print get_field('is_multiple_teams'); ?></td>
<?php if(get_field('multiple_other_teams_list') != NULL) { ?>
		<td><?php print implode(" | ", get_field('multiple_other_teams_list')); ?></td>
<?php } else { ?>
		<td><?php print ""; ?></td>
<?php } ?>

		<td><?php print get_field('sponsor'); ?></td>
		<td><?php print get_field('other_sponsor'); ?></td>
		<td><?php print get_field('have_a_non_uconn_project_sponsor_advisor'); ?></td>
		<td><?php print get_field('non_uconn_project_sponsor_advisor'); ?></td>
		<td><?php print get_field('protect_title'); ?></td>
		<td><?php print get_field('project_description'); ?></td>
		<td><?php print get_field('full_project_description'); ?></td>
		<td><?php print get_field('team_member_1'); ?></td>
		<td><?php print get_field('team_member_2'); ?></td>
		<td><?php print get_field('team_member_3'); ?></td>
		<td><?php print get_field('team_member_4'); ?></td>
		<td><?php print get_field('team_member_5'); ?></td>
		<td><?php print get_field('team_member_6'); ?></td>
		<td><?php print get_the_modified_time('F jS, Y - h:i a'); ?></td>
		<td><?php print get_the_modified_time('Y-m-d - h:i a'); ?></td>
	</tr>
<?php

	$i = $i + 1;
	
	}
		
	} else {
		
?>
<tr>
	<td colspan = "23">
		<p><b>There is no data available to display</b></p>
	</td>
</tr>
<?php
	}
	
?>
</table>
