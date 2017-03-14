<?php 
	class test_notes extends \PHPUnit_Framework_TestCase
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
		public function testNotes()
		{
            $starttime = "2016-05-20";
            $stoptime = "2016-05-23";
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('notes/notes.yml');
	        $this->stub->method('notes')->willReturn(json_decode('{"notes":[{"id":716530,"description":"Practice Notes","time_slot":"2016-05-23T22:20:00Z","recorded_at":"2016-06-04T19:08:22Z","user_id":61188,"project_id":112761}]}',true));	
       		$this->assertArrayHasKey("notes", $this->stub->notes($starttime, $stoptime, $this->options, 0));
		}
		public function testFind_note()
		{ 
			\VCR\VCR::turnOn();
			\VCR\VCR::insertCassette('notes/find_note.yml');
	        $this->stub->method('find_note')->willReturn(json_decode('{"note":{"id":716530,"description":"Practice Notes","time_slot":"2016-05-23T22:20:00Z","recorded_at":"2016-06-04T19:08:22Z","user_id":61188,"project_id":112761}}',true));	
       		$this->assertArrayHasKey("note", $this->stub->find_note(716530));
		}
	}

?>