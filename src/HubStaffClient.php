<?php

namespace Hubstaff;

final class HubStaffClient extends AbstractResource
{
    /**
     * @return string
     */
    public function getAppToken()
    {
        return $this->appToken;
    }

    /**
     * @param string $appToken
     */
    public function setAppToken($appToken)
    {
        $this->appToken = $appToken;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
    }

    /**
     * @param string $email
     * @param string $password
     */
    public function auth($email, $password)
    {
        $auth = new Auth($this->client, $this->decoder);
        $auth->appToken = $this->getAppToken();
        $authToken = $auth->auth($email, $password);
        $this->setAuthToken($authToken['auth_token']);
    }

    /**
     * @param int $organizationMemberships
     * @param int $projectMemberships
     * @param int $offset
     *
     * @return array
     */
    public function users($organizationMemberships = 0, $projectMemberships = 0, $offset = 0)
    {
        $users = new Users($this->client, $this->decoder);
        return $users->getUsers($organizationMemberships, $projectMemberships, $offset);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findUser($id)
    {
        $users = new Users($this->client, $this->decoder);
        return $users->findUser($id);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findUserOrgs($id, $offset = 0)
    {
        $users = new Users($this->client, $this->decoder);
        return $users->findUserOrgs($id, $offset);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findUserProjects($id, $offset = 0)
    {
        $users = new Users($this->client, $this->decoder);
        return $users->findUserProjects($id, $offset);
    }

    /**
     * @param int $offset
     * @return array
     */
    public function organizations($offset = 0)
    {
        $organizations = new Organizations($this->client, $this->decoder);
        return $organizations->getOrganizations($offset);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findOrganization($id)
    {
        $organizations = new Organizations($this->client, $this->decoder);
        return $organizations->findOrganization($id);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findOrgProjects($id, $offset = 0)
    {
        $organizations = new Organizations($this->client, $this->decoder);
        return $organizations->findOrgProjects($id, $offset);
    }

    /**
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function findOrgMembers($id, $offset = 0)
    {
        $organizations = new Organizations($this->client, $this->decoder);
        return $organizations->findOrgMembers($id, $offset);
    }

    /**
     * @param string $status
     * @param int $offset
     *
     * @return array
     */
    public function projects($status = '', $offset = 0)
    {
        $projects = new Projects($this->client, $this->decoder);
        return $projects->getProjects($status, $offset);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findProject($id)
    {
        $projects = new Projects($this->client, $this->decoder);
        return $projects->findProject($id);
    }

    /**
     * @param int $id
     * @param int $offset
     *
     * @return array
     */
    public function findProjectMembers($id, $offset = 0)
    {
        $projects = new Projects($this->client, $this->decoder);
        return $projects->findProjectMembers($id, $offset);
    }

    /**
     * @param string $startTime
     * @param string $stopTime
     * @param int $offset
     * @param array $options
     *
     * @return array
     */
    public function activities($startTime, $stopTime, $offset = 0, array $options = [])
    {
        $activities = new Activities($this->client, $this->decoder);
        return $activities->getActivities($startTime, $stopTime, $options, $offset);
    }

    /**
     * @param string $startTime
     * @param string $stopTime
     * @param int $offset
     * @param array $options
     *
     * @return array
     */
    public function screenshots($startTime, $stopTime, $offset = 0, array $options = [])
    {
        $screenshots = new Screenshots($this->client, $this->decoder);
        return $screenshots->getScreenshots($startTime, $stopTime, $options, $offset);
    }

    /**
     * @param string $startTime
     * @param string $stopTime
     * @param int $offset
     * @param array $options
     *
     * @return array
     */
    public function notes($startTime, $stopTime, $offset = 0, array $options = [])
    {
        $notes = new Notes($this->client, $this->decoder);
        return $notes->getNotes($startTime, $stopTime, $options, $offset);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function findNote($id)
    {
        $projects = new Notes($this->client, $this->decoder);
        return $projects->findNote($id);
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function weeklyTeam(array $options = [])
    {
        $weekly = new Weekly($this->client, $this->decoder);
        return $weekly->weeklyTeam($options);
    }

    /**
     * @param array $options
     * @return array
     */
    public function weeklyMy(array $options = [])
    {
        $weekly = new Weekly($this->client, $this->decoder);
        return $weekly->weeklyMy($options);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $options
     *
     * @return array
     */
    public function customDateTeam($startDate, $endDate, array $options = [])
    {
        $custom = new Custom($this->client, $this->decoder);
        return $custom->customReport($startDate, $endDate, '/v1/custom/by_date/team', $options);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $options
     *
     * @return array
     */
    public function customDateMy($startDate, $endDate, array $options = [])
    {
        $custom = new Custom($this->client, $this->decoder);
        return $custom->customReport($startDate, $endDate, '/v1/custom/by_date/my', $options);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $options
     *
     * @return array
     */
    public function customMemberTeam($startDate, $endDate, array $options = [])
    {
        $custom = new Custom($this->client, $this->decoder);
        return $custom->customReport($startDate, $endDate, '/v1/custom/by_member/team', $options);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $options
     *
     * @return array
     */
    public function customMemberMy($startDate, $endDate, array $options = [])
    {
        $custom = new Custom($this->client, $this->decoder);
        return $custom->customReport($startDate, $endDate, '/v1/custom/by_member/my', $options);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $options
     *
     * @return array
     */
    public function customProjectTeam($startDate, $endDate, array $options = [])
    {
        $custom = new Custom($this->client, $this->decoder);
        return $custom->customReport($startDate, $endDate, '/v1/custom/by_project/team', $options);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $options
     *
     * @return array
     */
    public function customProjectMy($startDate, $endDate, array $options = [])
    {
        $custom = new Custom($this->client, $this->decoder);
        return $custom->customReport($startDate, $endDate, '/v1/custom/by_project/my', $options);
    }
}
