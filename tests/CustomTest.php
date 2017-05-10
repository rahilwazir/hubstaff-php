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
    public function test_custom_report_organizations()
    {
        $organizations = uniqid('organization', true);
        $authToken = uniqid('authToken', true);
        $appToken = uniqid('appToken', true);
        $startDate = uniqid('startDate', true);
        $endDate = uniqid('endToken', true);
        $url = uniqid('url', true);

        $options = [
            'organizations' => $organizations,
        ];

        $parameters = [
            'organizations' => '',
            'Auth-Token'    => 'header',
            'App-token'     => 'header',
            'start_date'    => '',
            'end_date'      => '',
        ];

        $fields = [
            'Auth-Token'    => $authToken,
            'start_date'    => $startDate,
            'end_date'      => $endDate,
            'organizations' => $organizations,
            'App-token'     => $appToken,
        ];

        /* @var $client ClientInterface|\PHPUnit_Framework_MockObject_MockObject */
        $client = $this->createMock(ClientInterface::class);
        $client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        /* @var $decoder DecodeDataInterface|\PHPUnit_Framework_MockObject_MockObject */
        $decoder = $this->createMock(DecodeDataInterface::class);
        $decoder->expects(self::once())->method('decode');

        $custom = new Custom($client, $decoder);
        $custom->customReport($authToken, $appToken, $startDate, $endDate, $options, $url);
    }

    /**
     * @test
     */
    public function it_should_pass_configured_field_and_parameters_for_project_options()
    {
        $projects = uniqid('projects', true);
        $authToken = uniqid('authToken', true);
        $appToken = uniqid('appToken', true);
        $startDate = uniqid('startDate', true);
        $endDate = uniqid('endToken', true);
        $url = uniqid('url', true);

        $options = [
            'projects' => $projects,
        ];

        $parameters = [
            'projects'   => '',
            'Auth-Token' => 'header',
            'App-token'  => 'header',
            'start_date' => '',
            'end_date'   => '',
        ];

        $fields = [
            'Auth-Token' => $authToken,
            'start_date' => $startDate,
            'end_date'   => $endDate,
            'projects'   => $projects,
            'App-token'  => $appToken,
        ];

        /* @var $client ClientInterface|\PHPUnit_Framework_MockObject_MockObject */
        $client = $this->createMock(ClientInterface::class);
        $client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        /* @var $decoder DecodeDataInterface|\PHPUnit_Framework_MockObject_MockObject */
        $decoder = $this->createMock(DecodeDataInterface::class);
        $decoder->expects(self::once())->method('decode');

        $custom = new Custom($client, $decoder);
        $custom->customReport($authToken, $appToken, $startDate, $endDate, $options, $url);
    }


    /**
     * @todo move it to abstract resource
     */
    public function test_custom_date_team()
    {
        $expected = '{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}';

        /* @var $client ClientInterface|\PHPUnit_Framework_MockObject_MockObject */
        $client = $this->createMock(ClientInterface::class);
        $client->expects(self::once())->method('send')->will(self::returnValue($expected));

        /* @var $decoder DecodeDataInterface|\PHPUnit_Framework_MockObject_MockObject */
        $decoder = $this->createMock(DecodeDataInterface::class);
        $decoder->expects(self::once())->method('decode')->will(self::returnValue(json_decode($expected, true)));

        $custom = new Custom($client, $decoder);

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
}
