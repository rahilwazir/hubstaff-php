<?php

namespace Hubstaff;

final class Screenshots extends AbstractResource
{
    /**
     * @param string $startTime
     * @param string $stopTime
     * @param array $parameters
     * @param int $offset
     *
     * @return array
     */
    public function getScreenshots($startTime, $stopTime, array $parameters = [], $offset = 0)
    {
        $parameters = $this->buildParameters($parameters);
        $parameters['start_time'] = $startTime;
        $parameters['stop_time'] = $stopTime;
        $parameters['offset'] = $offset;

        $url    = '/v1/screenshots';

        return $this->abstractResourceCall('GET', $url, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    private function buildParameters($parameters)
    {
        if (!count($parameters)) {
            return [];
        }

        foreach ($parameters as $key => $value) {
            $parameters[$key] = implode(',', $value);
        }

        return $parameters;
    }
}
