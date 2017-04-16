<?php

class ProjectsTest extends \PHPUnit_Framework_TestCase
{
    private $stub;

    public function __construct()
    {
        parent::__construct();
        $this->stub = $this->getMockBuilder('Hubstaff\Client')->disableOriginalConstructor()->getMock();
    }

    public function test_projects()
    {
        $expected = json_decode('{ "projects": [ { "id": 112761, "name": "Build Ruby Gem", "last_activity": "2016-05-24T01:25:21Z", "status": "Active", "description": null }, { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } ] }', true);
        $this->stub->expects($this->any())
            ->method('projects')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('projects', $this->stub->projects());
    }

    public function test_find_project()
    {
        $expected = json_decode('{ "project": { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } }', true);
        $this->stub->expects($this->any())
            ->method('find_project')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('project', $this->stub->find_project(120320));
    }

    public function test_find_project_members()
    {
        $expected = json_decode('{ "users": [ { "id": 61188, "name": "Raymond Cudjoe", "last_activity": "2016-05-24T01:25:21Z", "email": "rkcudjoe@hookengine.com", "pay_rate": "No rate set" } ] }', true);
        $this->stub->expects($this->any())
            ->method('find_project_members')
            ->will($this->returnValue($expected));
        $this->assertArrayHasKey('users', $this->stub->find_project_members(61188));
    }
}