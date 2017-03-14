<?php 
	class test_screenshots extends \PHPUnit_Framework_TestCase
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
		public function testScreenshots()
		{
            $starttime = "2016-03-14";
            $stoptime = "2016-03-20";
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('screenshots/screenshots.yml');
	        $this->stub->method('screenshots')->willReturn(json_decode('{"screenshots":[]}',true));	
       		$this->assertArrayHasKey("screenshots", $this->stub->screenshots($starttime, $stoptime, $this->options, 0));
		}
	}

?>