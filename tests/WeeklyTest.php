<?php

namespace HubstaffTest;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;
use Hubstaff\Weekly;

/**
 * Class WeeklyTest
 * @covers \Hubstaff\Weekly
 */
class WeeklyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClientInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

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
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->decoder = $this->createMock(DecodeDataInterface::class);
    }

    /**
     * @test
     * @dataProvider data_collection_weekly_provider
     */
    public function it_cant_return_weekly_team_report_for_a_given_week($parameters)
    {
        $method = 'GET';
        $url    = '/v1/weekly/team';
        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];


        $expectedParams = [];

        if (isset($parameters['date'])) {
            $expectedParams['date'] =  $parameters['date'];
        }
        if (isset($parameters['organizations'])) {
            $expectedParams['organizations'] = implode(',', $parameters['organizations']);
        }
        if (isset($parameters['projects'])) {
            $expectedParams['projects'] = implode(',', $parameters['projects']);
        }
        if (isset($parameters['users'])) {
            $expectedParams['users'] = implode(',', $parameters['users']);
        }

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $expectedParams)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $this->decoder->expects(self::once())->method('decode');
        $notes = new Weekly($this->client, $this->decoder);
        $notes->weeklyTeam($parameters);
    }

    /**
     * @test
     * @dataProvider data_collection_weekly_provider
     */
    public function it_cant_return_weekly_my_report_for_a_given_week($parameters)
    {
        $method = 'GET';
        $url    = '/v1/weekly/my';
        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];

        $expectedParams = [];

        if (isset($parameters['date'])) {
            $expectedParams['date'] =  $parameters['date'];
        }
        if (isset($parameters['organizations'])) {
            $expectedParams['organizations'] = implode(',', $parameters['organizations']);
        }
        if (isset($parameters['projects'])) {
            $expectedParams['projects'] = implode(',', $parameters['projects']);
        }
        if (isset($parameters['users'])) {
            $expectedParams['users'] = implode(',', $parameters['users']);
        }

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $expectedParams)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $this->decoder->expects(self::once())->method('decode');
        $notes = new Weekly($this->client, $this->decoder);
        $notes->weeklyMy($parameters);
    }

    public function data_collection_weekly_provider()
    {
        $date = date('Y-m-d');
        $users = [
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
        ];
        $organizations = [
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
        ];
        $projects = [
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
        ];

        yield [[]];
        yield [['date' => $date]];
        yield [['organizations' => []]];
        yield [['users' => []]];
        yield [['projects' => []]];
        yield [['organizations' => $organizations]];
        yield [['projects' => $projects]];
        yield [['users' => $users]];
        yield [
            [
                'date'          => $date,
                'projects'      => $projects,
                'organizations' => $organizations,
                'users'         => $users,
            ],
        ];
    }
}

