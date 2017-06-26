<?php

namespace HubstaffTest;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;
use Hubstaff\HubStaffClient;

/**
 * Class HubStaffClientTest
 * @covers \Hubstaff\HubStaffClient
 */
class HubStaffClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClientInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $httpClient;

    /**
     * @var DecodeDataInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $decoder;

    /**
     * @var string
     */
    private $appToken = 'string';

    /**
     * @var string
     */
    private $authToken = 'string';

    /**
     * @var HubStaffClient
     */
    private $hubStaffClient;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->decoder = $this->createMock(DecodeDataInterface::class);
        $this->hubStaffClient = new HubStaffClient($this->httpClient, $this->decoder, $this->appToken);
    }
    /**
     * @test
     */
    public function it_can_possible_authenticate_and_get_a_token()
    {
        $email = 'a@a.com';
        $password = uniqid('password', true);
        $this->authToken = uniqid('authToken', true);

        $this->httpClient->expects(self::once())->method('send');

        $this->decoder->expects(self::once())
            ->method('decode')
            ->will(self::returnValue(['auth_token' => $this->authToken]));

        $this->hubStaffClient->auth($email, $password);

        self::assertEquals($this->authToken, $this->hubStaffClient->getAuthToken());
    }

    /**
     * @test
     */
    public function it_can_list_users()
    {
        $organizationMemberships = 0;
        $projectMemberships = 0;
        $offset = 0;

        $this->hubStaffClient->users($organizationMemberships, $projectMemberships, $offset);
    }

    /**
     * @test
     */
    public function it_can_find_user()
    {
        $id = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->findUser($id);
    }

    /**
     * @test
     */
    public function it_can_find_user_orgs()
    {
        $id = random_int(1, PHP_INT_MAX);
        $offset = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->findUserOrgs($id, $offset);
    }

    /**
     * @test
     */
    public function it_can_find_user_projects()
    {
        $id = random_int(1, PHP_INT_MAX);
        $offset = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->findUserProjects($id, $offset);
    }

    /**
     * @test
     */
    public function it_can_list_organizations()
    {
        $offset = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->organizations($offset);
    }

    /**
     * @test
     */
    public function it_can_find_organization()
    {
        $id = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->findOrganization($id);
    }

    /**
     * @test
     */
    public function it_cant_find_org_projects()
    {
        $id     = random_int(1, PHP_INT_MAX);
        $offset = random_int(1, PHP_INT_MAX);

        $this->hubStaffClient->findOrgProjects($id, $offset);
    }

    /**
     * @test
     */
    public function it_cant_find_org_members()
    {
        $id     = random_int(1, PHP_INT_MAX);
        $offset = random_int(1, PHP_INT_MAX);

        $this->hubStaffClient->findOrgMembers($id, $offset);
    }

    /**
     * @test
     */
    public function it_can_list_projects()
    {
        $status = 'active';
        $offset = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->projects($status, $offset);
    }

    /**
     * @test
     */
    public function it_can_find_project()
    {
        $id = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->findProject($id);
    }

    /**
     * @test
     */
    public function it_can_find_project_members()
    {
        $id = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->findProject($id);
    }

    /**
     * @test
     * @dataProvider data_provider
     */
    public function it_can_list_activities($startTime, $stopTime, $options, $offset)
    {
        $this->hubStaffClient->activities($startTime, $stopTime, $options, $offset);
    }



    /**
     * @test
     * @dataProvider data_provider
     */
    public function it_can_list_screenshots($startTime, $stopTime, $options, $offset)
    {
        $this->hubStaffClient->screenshots($startTime, $stopTime, $options, $offset);
    }

    /**
     * @test
     * @dataProvider data_provider
     */
    public function it_can_list_notes($startTime, $stopTime, $offset, $options)
    {
        $this->hubStaffClient->notes($startTime, $stopTime, $offset, $options);
    }

    public function data_provider()
    {
        $options = [
            'organizations' => [],
            'projects' => [],
            'users' => [],
        ];
        $offset = random_int(1, PHP_INT_MAX);

        yield [date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $offset, $options];
        yield [date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $offset, $options];
        yield [date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $offset, $options];
    }

    /**
     * @test
     */
    public function it_can_find_note()
    {
        $id = random_int(1, PHP_INT_MAX);
        $this->hubStaffClient->findNote($id);
    }

    /**
     * @test
     * @dataProvider options_provider
     */
    public function it_can_list_weekly_team($options)
    {
        $this->hubStaffClient->weeklyTeam($options);
    }

    /**
     * @test
     * @dataProvider options_provider
     */
    public function it_can_list_weekly_my($options)
    {
        $this->hubStaffClient->weeklyMy($options);
    }

    public function options_provider()
    {
        yield [[]];
        yield [['organizations' => uniqid('organizations', true)]];
        yield [['projects' => uniqid('projects', true)]];
        yield [['users' => uniqid('users', true)]];
    }

    /**
     * @test
     */
    public function it_can_custom_report()
    {
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d');
        $options = [
            'show_tasks'       => [],
            'show_notes'       => [],
            'show_activity'    => [],
            'include_archived' => [],
            'projects'         => [],
            'organizations'    => [],
            'users'            => [],
        ];

        $this->hubStaffClient->customDateTeam($startDate, $endDate, $options);
        $this->hubStaffClient->customDateMy($startDate, $endDate, $options);
        $this->hubStaffClient->customMemberTeam($startDate, $endDate, $options);
        $this->hubStaffClient->customMemberMy($startDate, $endDate, $options);
        $this->hubStaffClient->customProjectTeam($startDate, $endDate, $options);
        $this->hubStaffClient->customProjectMy($startDate, $endDate, $options);
    }
}
