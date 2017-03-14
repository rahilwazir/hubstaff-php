<?php 

	include("hubstaff/hubstaff.php");

	$app_token = "< your hubstaff app token >";
	$email = "< your hubstaff account email address >";
	$password = "< your hubstaff account password >";

	$hubstaff = new hubstaff\Client($app_token);

	$hubstaff->auth($email,$password);

	$time_start = "2016-09-22";
	$time_end = "2016-09-26";
	$project_id = "112761";

	$auth_token = $hubstaff->get_auth_token();

	echo "Your authentication token is: ".$auth_token."\n";

	//retrieve and display screenshots
	$screenshots = $hubstaff->screenshots($time_start, $time_end,0 , array("projects"=>$project_id));

	foreach($screenshots->screenshots as $screenshot)
	{
		echo "Screen shot was found: ".$screenshot->url."\n";
	}
	
?>