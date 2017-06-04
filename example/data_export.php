<?php 

	include("hubstaff.php");

	$app_token = "1u6rQ6kuB46U8kSYAXRPDaBvvAiB7GPMMxZVLii79KQ";
	// $auth_token = "5WZ1SCto37HBhH-AR1jn0kC3FXROO4b39CREMSyt_1U"
	$email = "rkcudjoe@hookengine.com";
	$password = "hookdev001";

	$hubstaff = new Hubstaff\HubStaffClient($app_token);

	$hubstaff->auth($email,$password);

	$time_start = "2016-09-22";
	$time_end = "2016-09-26";
	$project_id = "112761";

	$auth_token = $hubstaff->get_auth_token();

	echo "Your authentication token is: ".$auth_token."\n";

	//retrieve and display screenshot url
	$screenshots = $hubstaff->screenshots($time_start, $time_end,0 , array("projects"=>$project_id));

	foreach($screenshots->screenshots as $screenshot)
	{
		echo "Screen shot was found: ".$screenshot->url."\n";
	}
	
?>