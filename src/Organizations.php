<?php

namespace Hubstaff;

final class Organizations extends AbstractResource
{
    /**
     * @param int $offset
     * @return array
     */
    public function getOrganizations($offset = 0)
    {
        $parameters['offset'] = $offset;

        return $this->abstractResourceCall('GET', '/v1/organizations', $parameters);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findOrganization($id)
    {
        $url = sprintf('/v1/organizations/%s', $id);

        return $this->abstractResourceCall('GET', $url);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findOrgProjects($id, $offset = 0)
    {
        $parameters['offset'] = $offset;
        $url        = sprintf('/v1/organizations/%s/projects', $id);

        return $this->abstractResourceCall('GET', $url, $parameters);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findOrgMembers($id, $offset = 0)
    {
        $parameters['offset'] = $offset;
        $url        = sprintf('/v1/organizations/%s/members', $id);

        return $this->abstractResourceCall('GET', $url, $parameters);
    }
}