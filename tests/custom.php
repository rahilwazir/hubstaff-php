<?php 
	class test_custom extends \PHPUnit_Framework_TestCase
	{
		public $stub;
		public $options = array();
        public $start_date = "2016-05-23";
        public $end_date = "2016-05-25";
		function __construct()
		{
			$this->options["users"] = "61188";
			$this->options["projects"] ="112761";
			$this->options["organizations"] = "27572";
            $this->options["show_tasks"] = "1";
            $this->options["show_notes"] = "1";
            $this->options["show_activity"] = "1";
            $this->options["include_archived"] = "1";
		
			require_once("../hubstaff.php");
	        $this->stub = $this->getMockBuilder('hubstaff\Client')->disableOriginalConstructor()->getMock();
		}		
		public function testCustom_date_team()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('custom/custom_date_team.yml');
	        $this->stub->method('custom_date_team')->willReturn(json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->custom_date_team($this->start_date, $this->end_date, $this->options));
		}
		public function testCustom_date_my()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('custom/custom_date_my.yml');
	        $this->stub->method('custom_date_my')->willReturn(json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->custom_date_my($this->start_date, $this->end_date, $this->options));
		}
		public function testCustom_member_team()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('custom/custom_member_team.yml');
	        $this->stub->method('custom_member_team')->willReturn(json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->custom_member_team($this->start_date, $this->end_date, $this->options));
		}
		public function testCustom_member_my()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('custom/custom_member_my.yml');
	        $this->stub->method('custom_member_my')->willReturn(json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->custom_member_my($this->start_date, $this->end_date, $this->options));
		}
		public function testCustom_project_team()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('custom/custom_project_team.yml');
	        $this->stub->method('custom_project_team')->willReturn(json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->custom_project_team($this->start_date, $this->end_date, $this->options));
		}
		public function testCustom_project_my()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('custom/custom_project_my.yml');
	        $this->stub->method('custom_project_my')->willReturn(json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->custom_project_my($this->start_date, $this->end_date, $this->options));
		}
	}

?>