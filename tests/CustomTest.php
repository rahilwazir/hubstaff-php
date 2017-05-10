<?php

namespace Hubstaff;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\helper\RequestInterface;
use PHPUnit_Framework_TestCase;

final class CustomTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Client
     */
    private $stub;
    private $options = [];
    private $start_date = '2016-05-23';
    private $end_date = '2016-05-25';

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->options['users'] = '61188';
        $this->options['projects'] = '112761';
        $this->options['organizations'] = '27572';
        $this->options['show_tasks'] = '1';
        $this->options['show_notes'] = '1';
        $this->options['show_activity'] = '1';
        $this->options['include_archived'] = '1';


        $this->stub = $this->getMockBuilder('Hubstaff\Client')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @todo move it to abstract resource
     */
    public function test_custom_date_team()
    {
        $expected = '{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}';

        /* @var $client RequestInterface|\PHPUnit_Framework_MockObject_MockObject */
        $client = $this->getMock(RequestInterface::class);
        $client->expects(self::once())->method('send')->will(self::returnValue($expected));

        /* @var $decoder DecodeDataInterface|\PHPUnit_Framework_MockObject_MockObject */
        $decoder = $this->getMock(DecodeDataInterface::class);
        $decoder->expects(self::once())->method('decode')->will(self::returnValue(json_decode($expected, true)));

        $custom  = new Custom($client, $decoder);

        $actual = $custom->customReport(
            'auth_token',
            'app_token',
            'start_date',
            'end_date',
            'options',
            'url'
        );

        self::assertEquals(json_decode($expected, true), $actual);
    }

    public function test_custom_date_my()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('customDateMy')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->customDateMy($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_member_team()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('customMemberTeam')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->customMemberTeam($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_member_my()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('customMemberMy')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->customMemberMy($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_project_team()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('customProjectTeam')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->customProjectTeam($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_project_my()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('customProjectMy')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->customProjectMy($this->start_date, $this->end_date, $this->options));
    }
}
