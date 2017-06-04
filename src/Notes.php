<?php

namespace Hubstaff;

final class Notes extends AbstractResource
{
    /**
     * @param string $startTime
     * @param string $stopTime
     * @param array $parameters
     * @param int $offset
     *
     * @return array
     */
    public function getNotes($startTime, $stopTime, array $parameters = [], $offset = 0)
    {
        $parameters = $this->buildParameters($parameters);
        $parameters['start_time'] = $startTime;
        $parameters['stop_time'] = $stopTime;
        $parameters['offset'] = $offset;

        $url = '/v1/screenshots';

        return $this->abstractResourceCall('GET', $url, $parameters);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function findNote($id)
    {
        $url    = strtr('/v1/notes/{id}', '{id}', $id);

        return $this->abstractResourceCall('GET', $url);
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
