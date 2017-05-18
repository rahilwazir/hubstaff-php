<?php

namespace Hubstaff;

class OrganizationsTest extends \PHPUnit_Framework_TestCase
{
    private $stub;

    public function __construct()
    {
        parent::__construct();
        $this->stub = $this->getMockBuilder('Hubstaff\Client')->disableOriginalConstructor()->getMock();
    }

    public function test_organizations()
    {
        $expected = json_decode('{ "organizations": [ { "id": 27572, "name": "Hook Engine", "last_activity": "2016-05-24T01:25:21Z" } ] }', true);
        $this->stub->expects($this->any())
            ->method('organizations')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organizations', $this->stub->organizations());
    }

    public function test_find_organization()
    {
        $expected = json_decode('{ "organization": { "id": 27572, "name": "Hook Engine", "last_activity": "2016-05-24T01:25:21Z" } } ', true);
        $this->stub->expects($this->any())
            ->method('findOrganization')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('organization', $this->stub->findOrganization(27572));

    }

    public function test_find_org_projects()
    {
        $expected = json_decode('{ "projects": [ { "id": 112761, "name": "Build Ruby Gem", "last_activity": "2016-05-24T01:25:21Z", "status": "Active", "description": null }, { "id": 120320, "name": "Hubstaff API tutorial", "last_activity": null, "status": "Active", "description": null } ] }', true);

        $this->stub->expects($this->any())
            ->method('findOrgProjects')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('projects', $this->stub->findOrgProjects(27572));
    }

    public function test_find_org_members()
    {
        $expected = json_decode('{ "users": [ { "id": 61188, "name": "Raymond Cudjoe", "last_activity": "2016-05-24T01:25:21Z", "email": "rkcudjoe@hookengine.com", "pay_rate": "No rate set" } ] }', true);
        $this->stub->expects($this->any())
            ->method('findOrgMembers')
            ->will($this->returnValue($expected));

        $this->assertArrayHasKey('users', $this->stub->findOrgMembers(27572));
    }
}

