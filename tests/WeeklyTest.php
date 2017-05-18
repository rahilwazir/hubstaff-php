<?php

class WeeklyTest extends \PHPUnit_Framework_TestCase
{
    private $stub;
    private $options = [];

    public function __construct()
    {
        parent::__construct();
        $this->options['users'] = '61188';
        $this->options['projects'] = '112761';
        $this->options['organizations'] = '27572';
        $this->options['date'] = '2016-05-01';

        $this->stub = $this->getMockBuilder('Hubstaff\Client')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function test_weekly_team()
    {
        $expected = json_decode('{"organizations":[]}', true);
        $this->stub->expects($this->any())
            ->method('weeklyTeam')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->weeklyTeam($this->options));
    }

    public function testWeekly_my()
    {
        $expected = json_decode('{"organizations":[]}', true);
        $this->stub->expects($this->any())
            ->method('weeklyMy')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->weeklyMy($this->options));
    }
}