<?php
namespace Hubstaff;

class ActivitiesTest extends \PHPUnit_Framework_TestCase
{
    private $stub;
    private $options = [];

    public function __construct()
    {
        parent::__construct();
        $this->options['users'] = '61188';
        $this->options['projects'] = '112761';
        $this->options['organizations'] = '27572';

        $this->stub = $this->getMockBuilder('Hubstaff\Client')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function test_activities()
    {
        $starttime = '2016-03-14';
        $stoptime = '2016-03-20';
        $expected = json_decode('{"activities":[]}', true);
        $this->stub->expects($this->any())
            ->method('activities')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('activities', $this->stub->activities($starttime, $stoptime, $this->options, 0));
    }
}
