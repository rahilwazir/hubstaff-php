<?php

class test_screenshots extends \PHPUnit_Framework_TestCase
{
    public $stub;
    public $options = [];

    public function __construct()
    {
        parent::__construct();
        $this->options["users"] = "61188";
        $this->options["projects"] = "112761";
        $this->options["organizations"] = "27572";

        $this->stub = $this->getMockBuilder('Hubstaff\Client')
            ->disableOriginalConstructor()
            ->getMock();

    }

    public function testScreenshots()
    {
        $starttime = "2016-03-14";
        $stoptime = "2016-03-20";

        $this->stub->expects($this->any())
            ->method('screenshots')
            ->will($this->returnValue(json_decode('{"screenshots":[]}', true)));

        $this->assertArrayHasKey("screenshots", $this->stub->screenshots($starttime, $stoptime, $this->options, 0));
    }
}