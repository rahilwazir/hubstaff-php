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
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->decoder = $this->createMock(DecodeDataInterface::class);
    }

    /**
     * @test
     * @dataProvider provider_valid_options
     */
    public function it_should_configure_field_and_parameters(array $options)
    {
        $authToken = uniqid('authToken', true);
        $appToken = uniqid('appToken', true);
        $startDate = uniqid('startDate', true);
        $endDate = uniqid('endToken', true);
        $url = uniqid('url', true);

        $optionName = key($options);
        $parameters = [
            $optionName => '',
            'Auth-Token'    => 'header',
            'App-token'     => 'header',
            'start_date'    => '',
            'end_date'      => '',
        ];

        $fields = array_merge(
            [
                'Auth-Token'    => $authToken,
                'start_date'    => $startDate,
                'end_date'      => $endDate,
                'App-token'     => $appToken,
            ],
            $options
        );

        $this->client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $custom = new Custom($this->client, $this->decoder);
        $custom->customReport($authToken, $appToken, $startDate, $endDate, $options, $url);
    }

    public function provider_valid_options()
    {
        return [
            [
                [
                    'organizations' => uniqid('organization', true),
                ],
            ],
            [
                [
                    'projects' => uniqid('projects', true),
                ],
            ],
        ];
    }

    /**
     * @todo move it to abstract resource
     */
    public function test_custom_date_team()
    {
        $expected = '{"organizations":[{"id":27572,"name":"Hook Engine","duration":7874,"dates":[{"date":"2016-05-23","duration":7874,"users":[{"id":61188,"name":"Raymond Cudjoe","duration":7874,"projects":[{"id":112761,"name":"Build Ruby Gem","duration":7874}]}]}]}]}';

        $this->client->expects(self::once())->method('send')->will(self::returnValue($expected));

        $this->decoder->expects(self::once())->method('decode')->will(self::returnValue(json_decode($expected, true)));

        $custom = new Custom($this->client, $this->decoder);

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
