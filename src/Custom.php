<?php

namespace Hubstaff;

final class Custom extends AbstractResource
{
    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $url
     * @param array $parameters
     *
     * @return array
     */
    public function customReport($startDate, $endDate, $url, array $parameters = [])
    {
        $parameters = $this->buildParameters($parameters);
        $parameters['start_date'] = $startDate;
        $parameters['end_date'] = $endDate;

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
