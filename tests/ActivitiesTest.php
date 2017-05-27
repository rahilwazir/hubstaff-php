<?php

namespace Hubstaff;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Hubstaff\Activities
 */
final class ActivitiesTest extends PHPUnit_Framework_TestCase
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
        $authToken  = uniqid('authToken', true);
        $appToken   = uniqid('appToken', true);
        $startTime  = uniqid('startTime', true);
        $endTime    = uniqid('endTime', true);
        $url        = uniqid('url', true);
        $offset     = uniqid('offsset', true);

        $optionName = key($options);
        $parameters = [
            $optionName  => '',
            'Auth-Token' => 'header',
            'App-token'  => 'header',
            'start_time' => '',
            'stop_time'  => '',
            'offset'     => '',
        ];

        $fields = array_merge(
            [
                'Auth-Token' => $authToken,
                'start_time' => $startTime,
                'stop_time'  => $endTime,
                'App-token'  => $appToken,
                'offset'     => $offset,
            ],
            $options
        );

        $this->client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $custom = new Activities($this->client, $this->decoder);
        $custom->getActivities($authToken, $appToken, $startTime, $endTime, $offset, $options, $url);
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
            [
                [
                    'users' => uniqid('users', true),
                ],
            ],
        ];
    }

    /** @test */
    public function activities()
    {
        $expected = json_encode(['activities' => []]);
        $startTime = '2016-03-14';
        $stopTime = '2016-03-20';

        $this->client->expects(self::once())->method('send')->will(self::returnValue($expected));

        $this->decoder->expects(self::once())->method('decode')
            ->will(self::returnValue(json_decode($expected, true)));
        $this->decoder->expects(self::once())->method('decode');

        $activities = new Activities($this->client, $this->decoder);

        $actual = $activities->getActivities(
            'auth_token',
            'app_token',
            $startTime,
            $stopTime,
            'offset',
            'options',
            'url'
        );

        self::assertEquals(json_decode($expected, true), $actual);
    }
}