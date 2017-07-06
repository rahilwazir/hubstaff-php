<?php

namespace HubstaffTest\Decoder;

use Hubstaff\Decoder\JsonDecoder;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \Hubstaff\Decoder\JsonDecoder
 */
final class JsonDecoderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideValidJsonData
     *
     * @param mixed $expected
     * @param string $json
     *
     * @return void
     */
    public function test_json_decoder_will_can_decode_a_json($expected, $json)
    {
        $decoder = new JsonDecoder();

        self::assertSame($expected, $decoder->decode($json));
    }

    public function provideValidJsonData()
    {
        return [
            'null into json' => [
                null,
                json_encode(null),
            ],
            'array into json' => [
                ['name' => 'John'],
                json_encode(['name' => 'John']),
            ],
            'object into json' => [
                [],
                json_encode(new stdClass()),
            ],
            'number into json' => [
                $number = random_int(0, 123),
                json_encode($number),
            ],
        ];
    }
}
