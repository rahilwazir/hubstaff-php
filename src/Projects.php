<?php

namespace Hubstaff;

final class Projects extends AbstractResource
{
    /**
     * @param string $status
     * @param int $offset
     * @return array
     */
    public function getProjects($status, $offset = 0)
    {
        $parameters['offset'] = $offset;

        if (!empty($status)) {
            $parameters['status'] = $status;
        }

        return $this->abstractResourceCall('GET', '/v1/projects', $parameters);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findProject($id)
    {
        $url = sprintf('/v1/projects/%s', $id);

        return $this->abstractResourceCall('GET', $url);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findProjectMembers($id, $offset = 0)
    {
        $url = sprintf('/v1/projects/%s/members', $id);
        $parameters['offset'] = $offset;

        return $this->abstractResourceCall('GET', $url, $parameters);
    }
}
