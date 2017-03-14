<?php 
	
	define("ROOT_FOLDER",__DIR__."/");
	define("BASE_URL","https://api.hubstaff.com/v1/");
	define("AUTH","auth");
	define("USERS","users");
	define("FIND_USER","users/%d");
	define("FIND_USER_ORG","users/%d/organizations");
	define("FIND_USER_PROJ","users/%d/projects");
	
	define("ORGS","organizations");
	define("FIND_ORG","organizations/%d");
	define("FIND_ORG_PROJ","organizations/%d/projects");
	define("FIND_ORG_MEMBERS","organizations/%d/members");
	
	define("PROJS","projects");
	define("FIND_PROJ","projects/%d");
	define("FIND_PROJ_MEMBERS","projects/%d/members");

	define("ACTIVITIES","activities");

	define("SCREENSHOTS","screenshots");

	define("NOTES","notes");
	define("FIND_NOTE","notes/%d");

	define("WEEKLY_TEAM","weekly/team");
	define("WEEKLY_MY","weekly/my");

	define("CUSTOM_DATE_TEAM","custom/by_date/team");
	define("CUSTOM_DATE_MY","custom/by_date/my");
	define("CUSTOM_MEMBER_TEAM","custom/by_member/team");
	define("CUSTOM_MEMBER_MY","custom/by_member/my");
	define("CUSTOM_PROJECT_TEAM","custom/by_project/team");
	define("CUSTOM_PROJECT_MY","custom/by_project/my");

	require_once(ROOT_FOLDER."lib/auth.php");
	require_once(ROOT_FOLDER."lib/users.php");
	require_once(ROOT_FOLDER."lib/organizations.php");
	require_once(ROOT_FOLDER."lib/projects.php");
	require_once(ROOT_FOLDER."lib/activities.php");
	require_once(ROOT_FOLDER."lib/screenshots.php");
	require_once(ROOT_FOLDER."lib/notes.php");
	require_once(ROOT_FOLDER."lib/weekly.php");
	require_once(ROOT_FOLDER."lib/custom.php");
	require_once(ROOT_FOLDER."helper/curl.php");
		
?>
