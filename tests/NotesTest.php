<?php

namespace Hubstaff;

class NotesTest extends \PHPUnit_Framework_TestCase
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

    public function test_notes()
    {
        $starttime = '2016-05-20';
        $stoptime = '2016-05-23';

        $expected = json_decode('{"notes":[{"id":716530,"description":"Practice Notes","time_slot":"2016-05-23T22:20:00Z","recorded_at":"2016-06-04T19:08:22Z","user_id":61188,"project_id":112761}]}', true);
        $this->stub->expects($this->any())
            ->method('notes')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('notes', $this->stub->notes($starttime, $stoptime, $this->options, 0));
    }

    public function test_find_note()
    {
        $expected = json_decode('{"note":{"id":716530,"description":"Practice Notes","time_slot":"2016-05-23T22:20:00Z","recorded_at":"2016-06-04T19:08:22Z","user_id":61188,"project_id":112761}}', true);

        $this->stub->expects($this->any())
            ->method('find_note')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('note', $this->stub->find_note(716530));
    }
}

