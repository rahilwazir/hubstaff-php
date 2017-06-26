<?php

namespace Hubstaff;

final class Users extends AbstractResource
{
    /**
     * @param bool $organizationMemberships
     * @param bool $projectMemberships
     * @param int $offset
     * @return array
     */
    public function getUsers($organizationMemberships = false, $projectMemberships = false, $offset = 0)
    {
        $parameters['organization_memberships'] = $organizationMemberships;
        $parameters['project_memberships'] = $projectMemberships;
        $parameters['offset'] = $offset;

        return $this->abstractResourceCall('GET', '/v1/users', $parameters);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findUser($id)
    {
        $url = sprintf('/v1/users/%d', $id);
        return $this->abstractResourceCall('GET', $url);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findUserOrgs($id, $offset = 0)
    {
        $parameters['offset'] = $offset;
        $url = sprintf('/v1/users/%d/organizations', $id);
        return $this->abstractResourceCall('GET', $url, $parameters);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findUserProjects($id, $offset = 0)
    {
        $parameters['offset'] = $offset;
        $url = sprintf('/v1/users/%d/projects', $id);
        return $this->abstractResourceCall('GET', $url, $parameters);
    }
}
