<?php 
	class test_projects extends \PHPUnit_Framework_TestCase
	{
		public $stub;
		function __construct()
		{
			require_once("../hubstaff.php");
	        $this->stub = $this->getMockBuilder('hubstaff\Client')->disableOriginalConstructor()->getMock();
		}	
		public function testProjects()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('projects/projects.yml');
	        $this->stub->method('projects')->willReturn(json_decode('{ "projects": [ { "id": 112761, "name": "Build Ruby Gem", "last_activity": "2016-05-24T01:25:21Z", "status": "Active", "description": null }, { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } ] }',true));	
       		$this->assertArrayHasKey("projects", $this->stub->projects());
		}
		public function testFind_project()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('projects/find_project.yml');
	        $this->stub->method('find_project')->willReturn(json_decode('{ "project": { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } }',true));	
       		$this->assertArrayHasKey("project", $this->stub->find_project(120320));
			
		}
		public function testFind_project_members()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('projects/find_project_members.yml');
	        $this->stub->method('find_project_members')->willReturn(json_decode('{ "users": [ { "id": 61188, "name": "Raymond Cudjoe", "last_activity": "2016-05-24T01:25:21Z", "email": "rkcudjoe@hookengine.com", "pay_rate": "No rate set" } ] }',true));	
       		$this->assertArrayHasKey("users", $this->stub->find_project_members(120320));
		}
	}

?>