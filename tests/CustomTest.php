<?php
namespace Hubstaff;

class CustomTest extends \PHPUnit_Framework_TestCase
{
    private $stub;
    private $options = [];
    private $start_date = "2016-05-23";
    private $end_date = "2016-05-25";

    public function __construct()
    {
        parent::__construct();
        $this->options["users"] = "61188";
        $this->options["projects"] = "112761";
        $this->options["organizations"] = "27572";
        $this->options["show_tasks"] = "1";
        $this->options["show_notes"] = "1";
        $this->options["show_activity"] = "1";
        $this->options["include_archived"] = "1";


        $this->stub = $this->getMockBuilder('Hubstaff\Client')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function test_custom_date_team()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('custom_date_team')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("organizations", $this->stub->custom_date_team($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_date_my()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('custom_date_my')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("organizations", $this->stub->custom_date_my($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_member_team()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('custom_member_team')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("organizations", $this->stub->custom_member_team($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_member_my()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('custom_member_my')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("organizations", $this->stub->custom_member_my($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_project_team()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('custom_project_team')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("organizations", $this->stub->custom_project_team($this->start_date, $this->end_date, $this->options));
    }

    public function test_custom_project_my()
    {
        $expected = json_decode('{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}', true);
        $this->stub->expects($this->any())
            ->method('custom_project_my')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("organizations", $this->stub->custom_project_my($this->start_date, $this->end_date, $this->options));
    }
}