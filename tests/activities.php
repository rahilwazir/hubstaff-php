<?php 
	class test_activities extends \PHPUnit_Framework_TestCase
	{
		public $stub;
		public $options = array();
		function __construct()
		{			
			$this->options["users"] = "61188";
			$this->options["projects"] ="112761";
			$this->options["organizations"] = "27572";
		
			require_once("../hubstaff.php");
	        $this->stub = $this->getMockBuilder('hubstaff\Client')->disableOriginalConstructor()->getMock();
		}		
		public function testActivities()
		{
            $starttime = "2016-03-14";
            $stoptime = "2016-03-20";
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('activities/activities.yml');
	        $this->stub->method('activities')->willReturn(json_decode('{"activities":[]}',true));	
       		$this->assertArrayHasKey("activities", $this->stub->activities($starttime, $stoptime, $this->options, 0));
		}
	}	
	
?>