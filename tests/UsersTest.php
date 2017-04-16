<?php

namespace Hubstaff;

class UsersTest extends \PHPUnit_Framework_TestCase
{
    private $stub;

    public function __construct()
    {
        parent::__construct();
        $this->stub = $this->getMockBuilder('Hubstaff\Client')->disableOriginalConstructor()->getMock();
    }

    public function test_users()
    {
        $expected = json_decode('{"users": [ {"id": 61188, "name": "Raymond Cudjoe","last_activity": "2016-05-24T01:25:21Z","email": "rkcudjoe@hookengine.com"}]}', true);
        $this->stub->expects($this->any())
            ->method('users')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("users", $this->stub->users());
    }

    public function test_find_user()
    {
        $expected = json_decode('{"user": {"id": 61188,"name": "Raymond Cudjoe","last_activity": "2016-05-24T01:25:21Z","email": "rkcudjoe@hookengine.com"}}', true);
        $this->stub->expects($this->any())
            ->method('find_user')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("user", $this->stub->find_user(61188));

    }

    public function test_find_user_projects()
    {
        $expected = json_decode('{ "projects": [ { "id": 112761, "name": "Build Ruby Gem", "last_activity": "2016-05-24T01:25:21Z", "status": "Active", "description": null }, { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } ] }', true);
        $this->stub->expects($this->any())
            ->method('find_user_projects')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("projects", $this->stub->find_user_projects(61188));
    }

    public function testFind_user_orgs()
    {
        $expected = json_decode('{ "organizations": [ { "id": 27572, "name": "Hook Engine", "last_activity": "2016-05-24T01:25:21Z" } ] } ', true);
        $this->stub->expects($this->any())
            ->method('find_user_orgs')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey("organizations", $this->stub->find_user_orgs(61188));
    }
}

