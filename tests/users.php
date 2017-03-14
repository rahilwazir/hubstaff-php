<?php 
	class test_users extends \PHPUnit_Framework_TestCase
	{
		public $stub;
		function __construct()
		{
			require_once("../hubstaff.php");
	        $this->stub = $this->getMockBuilder('hubstaff\Client')->disableOriginalConstructor()->getMock();
		}	
		
		public function testUsers()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('users/users.yml');
	        $this->stub->method('users')->willReturn(json_decode('{"users": [ {"id": 61188, "name": "Raymond Cudjoe","last_activity": "2016-05-24T01:25:21Z","email": "rkcudjoe@hookengine.com"}]}',true));	
       		$this->assertArrayHasKey("users", $this->stub->users());
		}
		public function testFind_user()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('users/find_user.yml');
	        $this->stub->method('find_user')->willReturn(json_decode('{"user": {"id": 61188,"name": "Raymond Cudjoe","last_activity": "2016-05-24T01:25:21Z","email": "rkcudjoe@hookengine.com"}}',true));	
       		$this->assertArrayHasKey("user", $this->stub->find_user(61188));
			
		}
		public function testFind_user_projects()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('users/find_user_projects.yml');
	        $this->stub->method('find_user_projects')->willReturn(json_decode('{ "projects": [ { "id": 112761, "name": "Build Ruby Gem", "last_activity": "2016-05-24T01:25:21Z", "status": "Active", "description": null }, { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } ] }',true));	
       		$this->assertArrayHasKey("projects", $this->stub->find_user_projects(61188));
		}
		public function testFind_user_orgs()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('users/find_user_organizations.yml');
	        $this->stub->method('find_user_orgs')->willReturn(json_decode('{ "organizations": [ { "id": 27572, "name": "Hook Engine", "last_activity": "2016-05-24T01:25:21Z" } ] } ',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->find_user_orgs(61188));
		}
	}
?>