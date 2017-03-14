<?php 
	class test_orgs extends \PHPUnit_Framework_TestCase
	{
		public $stub;
		function __construct()
		{
			require_once("../hubstaff.php");
	        $this->stub = $this->getMockBuilder('hubstaff\Client')->disableOriginalConstructor()->getMock();
		}	
		public function testOrganizations()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('organizations/organizations.yml');
	        $this->stub->method('organizations')->willReturn(json_decode('{ "organizations": [ { "id": 27572, "name": "Hook Engine", "last_activity": "2016-05-24T01:25:21Z" } ] }',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->organizations());
		}
		public function testFind_organization()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('organizations/find_organization.yml');
	        $this->stub->method('find_organization')->willReturn(json_decode('{ "organization": { "id": 27572, "name": "Hook Engine", "last_activity": "2016-05-24T01:25:21Z" } } ',true));	
       		$this->assertArrayHasKey("organization", $this->stub->find_organization(27572));
			
		}
		public function testFind_org_projects()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('organizations/find_org_projects.yml');
	        $this->stub->method('find_org_projects')->willReturn(json_decode('{ "projects": [ { "id": 112761, "name": "Build Ruby Gem", "last_activity": "2016-05-24T01:25:21Z", "status": "Active", "description": null }, { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } ] }',true));	
       		$this->assertArrayHasKey("projects", $this->stub->find_org_projects(27572));
		}
		public function testFind_org_members()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('organizations/find_org_members.yml');
	        $this->stub->method('find_org_members')->willReturn(json_decode('{ "users": [ { "id": 61188, "name": "Raymond Cudjoe", "last_activity": "2016-05-24T01:25:21Z", "email": "rkcudjoe@hookengine.com", "pay_rate": "No rate set" } ] }',true));	
       		$this->assertArrayHasKey("users", $this->stub->find_org_members(27572));
		}
	}

?>