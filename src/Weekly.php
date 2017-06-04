<?php

namespace Hubstaff;

final class Weekly extends AbstractResource
{
    /**
     * @param array $parameters
     *
     * @return array
     */
    public function weeklyTeam(array $parameters = [])
    {
        $parameters = $this->buildParameters($parameters);

        $url    = '/v1/weekly/team';

        return $this->abstractResourceCall('GET', $url, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    public function weeklyMy(array $parameters = [])
    {
        $parameters = $this->buildParameters($parameters);

        $url    = '/v1/weekly/my';

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
            if (is_array($value)) {
                $parameters[ $key ] = implode(',', $value);
                continue;
            }

            $parameters[ $key ] = $value;
        }

        return $parameters;
    }
}

