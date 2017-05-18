<?php

namespace Hubstaff;

use PHPUnit_Framework_TestCase;

final class ActivitiesTest extends PHPUnit_Framework_TestCase
{
    public function test_activities()
    {
        $expected  = ['activities' => []];
        $startTime = '2016-03-14';
        $stopTime  = '2016-03-20';

        /* @var $client \PHPUnit_Framework_MockObject_MockObject|Client */
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $client->expects(self::any())->method('activities')->will(self::returnValue($expected));

        $options = [
            'users'         => '61188',
            'projects'      => '112761',
            'organizations' => '27572',
        ];

        self::assertArrayHasKey(
            'activities',
            $client->activities($startTime, $stopTime, $options, 0)
        );
    }
}
