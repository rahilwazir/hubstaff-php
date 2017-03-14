<?php 

	namespace Hubstaff
	{
		include(__DIR__."/config.php");
		class Client
		{
			public $app_token = "";
			public $auth_token = "";
			function __construct($app_token) {
				$this->app_token = $app_token;
			}	
			public function get_auth_token()
			{
				return $this->auth_token;
			}
			public function set_auth_token($auth_token)
			{
				$this->auth_token = $auth_token;
			}
			public function auth($email, $password)
			{
				$auth = new Client\userauth;
				$auth_token = $auth->auth($this->app_token, $email, $password, BASE_URL.AUTH);
				if(isset($auth_token["error"]))
				{
					return $auth_token["error"];
				}
				$this->set_auth_token($auth_token["auth_token"]);
			}
			public function users($organization_memberships = 0, $project_memberships = 0, $offset = 0)
			{
				$users = new Client\users;
				return $users->getusers($this->auth_token, $this->app_token, $organization_memberships, $project_memberships, $offset, BASE_URL.USERS);
			}
			
			public function find_user($id)
			{
				$users = new Client\users;
				return $users->find_user($this->auth_token, $this->app_token, sprintf(BASE_URL.FIND_USER,$id));
			}
			public function find_user_orgs($id,$offset = 0)
			{
				$users = new Client\users;
				return $users->find_user_orgs($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL.FIND_USER_ORG,$id));
			}
			public function find_user_projects($id,$offset = 0)
			{
				$users = new Client\users;
				return $users->find_user_projects($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL.FIND_USER_PROJ,$id));
			}
	
			public function organizations($offset = 0)
			{
				$organizations = new Client\organizations;
				return $organizations->getorganizations($this->auth_token, $this->app_token, $offset,BASE_URL.ORGS);
			}
			
			public function find_organization($id)
			{
				$organizations = new Client\organizations;
				return $organizations->find_organization($this->auth_token, $this->app_token, sprintf(BASE_URL.FIND_ORG,$id));
			}
			public function find_org_projects($id,$offset = 0)
			{
				$organizations = new Client\organizations;
				return $organizations->find_org_projects($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL.FIND_ORG_PROJ,$id));
			}
			public function find_org_members($id,$offset = 0)
			{
				$organizations = new Client\organizations;
				return $organizations->find_org_members($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL.FIND_ORG_MEMBERS,$id));
			}
	
			public function projects($active = '', $offset = 0)
			{
				$projects = new Client\projects;
				return $projects->getprojects($this->auth_token, $this->app_token, $active,$offset,BASE_URL.PROJS);
			}
			
			public function find_project($id)
			{
				$projects = new Client\projects;
				return $projects->find_project($this->auth_token, $this->app_token, sprintf(BASE_URL.FIND_PROJ,$id));
			}
			
			public function find_project_members($id,$offset = 0)
			{
				$projects = new Client\projects;
				$projects->find_project_members($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL.FIND_PROJ_MEMBERS,$id));
			}
	
			public function activities($start_time, $stop_time, $offset = 0, $options = array())
			{
				$activities = new Client\activities;
				return $activities->getactivities($this->auth_token, $this->app_token, $start_time, $stop_time, $offset = 0, $options ,BASE_URL.ACTIVITIES);
			}
	
			public function screenshots($start_time, $stop_time, $offset = 0, $options = array())
			{
				$screenshots = new Client\screenshots;
				return $screenshots->getscreenshots($this->auth_token, $this->app_token, $start_time, $stop_time, $offset = 0, $options ,BASE_URL.SCREENSHOTS);
			}
	
			public function notes($start_time, $stop_time, $offset = 0, $options = array())
			{
				$notes = new Client\notes;
				return $notes->getnotes($this->auth_token, $this->app_token, $start_time, $stop_time, $offset = 0, $options ,BASE_URL.NOTES);
			}
	
			public function find_note($id)
			{
				$projects = new Client\notes;
				return $projects->find_note($this->auth_token, $this->app_token, sprintf(BASE_URL.FIND_NOTE,$id));
			}
	
			public function weekly_team($options = array())
			{
				$weekly = new Client\weekly;
				return $weekly->weekly_team($this->auth_token, $this->app_token, $options, BASE_URL.WEEKLY_TEAM);
			}
			public function weekly_my($options = array())
			{
				$weekly = new Client\weekly;
				return $weekly->weekly_my($this->auth_token, $this->app_token, $options, BASE_URL.WEEKLY_MY);
			}
	
			public function custom_date_team($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL.CUSTOM_DATE_TEAM);
			}
	
			public function custom_date_my($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL.CUSTOM_DATE_MY);
			}
			public function custom_member_team($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL.CUSTOM_MEMBER_TEAM);
			}
			public function custom_member_my($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL.CUSTOM_MEMBER_MY);
			}
			public function custom_project_team($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL.CUSTOM_PROJECT_TEAM);
			}
			public function custom_project_my($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL.CUSTOM_PROJECT_MY);
			}
	
		}
	}

?>
