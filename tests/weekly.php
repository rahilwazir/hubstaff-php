<?php 
	class test_weekly extends \PHPUnit_Framework_TestCase
	{
		public $stub;
		public $options = array();
		function __construct()
		{
			$this->options["users"] = "61188";
			$this->options["projects"] ="112761";
			$this->options["organizations"] = "27572";
			$this->options["date"] = "2016-05-01";

			require_once("../hubstaff.php");
	        $this->stub = $this->getMockBuilder('hubstaff\Client')->disableOriginalConstructor()->getMock();
		}		
		public function testWeekly_team()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('weekly/team.yml');
	        $this->stub->method('weekly_team')->willReturn(json_decode('{"organizations":[]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->weekly_team($this->options));
		}
		public function testWeekly_my()
		{
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('weekly/my.yml');
	        $this->stub->method('weekly_my')->willReturn(json_decode('{"organizations":[]}',true));	
       		$this->assertArrayHasKey("organizations", $this->stub->weekly_my($this->options));
		}
	}

?>