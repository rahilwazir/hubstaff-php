<?php

namespace HubstaffTest;

use Hubstaff\Custom;
use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\helper\ClientInterface;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Hubstaff\Custom
 */
final class CustomTest extends PHPUnit_Framework_TestCase
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
     * @dataProvider data_collection_custom_provider
     */
    public function it_can_return_a_custom_report_grouped_by_date_for_a_given_date_range($url, $startDate, $endDate, $parameters)
    {
        $method = 'GET';

        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];

        $expectedParams = $this->buildExpectedParameters($startDate, $endDate, $parameters);

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $expectedParams)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $custom = new Custom($this->client, $this->decoder);
        $custom->customReport($startDate, $endDate, $url, $parameters);
    }

    public function data_collection_custom_provider()
    {
        foreach ($this->listOfUrl() as $url) {
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
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
            $showTasks          = random_int(0, 1);
            $showNotes          = random_int(0, 1);
            $showActivity       = random_int(0, 1);
            $includeArchived    = random_int(0, 1);

            yield [$url, $startDate, $endDate, []];
            yield [$url, $startDate, $endDate, ['show_tasks' => $showTasks]];
            yield [$url, $startDate, $endDate, ['show_notes' => $showNotes]];
            yield [$url, $startDate, $endDate, ['show_activity' => $showActivity]];
            yield [$url, $startDate, $endDate, ['include_archived' => $includeArchived]];
            yield [$url, $startDate, $endDate, ['organizations' => []]];
            yield [$url, $startDate, $endDate, ['users' => []]];
            yield [$url, $startDate, $endDate, ['projects' => []]];
            yield [$url, $startDate, $endDate, ['organizations' => $organizations]];
            yield [$url, $startDate, $endDate, ['projects' => $projects]];
            yield [$url, $startDate, $endDate, ['users' => $users]];
            yield [
                $url,
                $startDate,
                $endDate,
                [
                    'show_tasks'       => $showTasks,
                    'show_notes'       => $showNotes,
                    'show_activity'    => $showActivity,
                    'include_archived' => $includeArchived,
                    'projects'         => $projects,
                    'organizations'    => $organizations,
                    'users'            => $users,
                ],
            ];
        }
    }

    private function listOfUrl()
    {
        yield '/v1/custom/by_date/team';
        yield '/v1/custom/by_date/my';
        yield '/v1/custom/by_member/team';
        yield '/v1/custom/by_member/my';
        yield '/v1/custom/by_project/team';
        yield '/v1/custom/by_project/my';
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $parameters
     *
     * @return array
     * @internal array $expectedParams
     */
    private function buildExpectedParameters($startDate, $endDate, $parameters)
    {
        $expectedParams = [
            'start_date' => $startDate,
            'end_date'   => $endDate,
        ];

        if (isset($parameters['organizations'])) {
            $expectedParams['organizations'] = implode(',', $parameters['organizations']);
        }
        if (isset($parameters['projects'])) {
            $expectedParams['projects'] = implode(',', $parameters['projects']);
        }
        if (isset($parameters['users'])) {
            $expectedParams['users'] = implode(',', $parameters['users']);
        }
        if (isset($parameters['show_tasks'])) {
            $expectedParams['show_tasks'] = $parameters['show_tasks'];
        }
        if (isset($parameters['show_notes'])) {
            $expectedParams['show_notes'] = $parameters['show_notes'];
        }
        if (isset($parameters['show_activity'])) {
            $expectedParams['show_activity'] = $parameters['show_activity'];
        }
        if (isset($parameters['include_archived'])) {
            $expectedParams['include_archived'] = $parameters['include_archived'];
        }

        return $expectedParams;
    }
}
