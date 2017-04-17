<?php

namespace Hubstaff;

class Client
{
    /**
     * @var null
     */
    private $app_token = null;
    /**
     * @var null
     */
    private $auth_token = null;


    /**
     * Client constructor.
     * @param $app_token
     */
    public function __construct($app_token)
    {
        $this->app_token = $app_token;
    }

    /**
     * @return null
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    /**
     * @param $auth_token
     */
    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function auth($email, $password)
    {
        $auth = new Auth;
        $auth_token = $auth->auth($this->app_token, $email, $password, BASE_URL . AUTH);
        if (isset($auth_token["error"])) {
            return $auth_token["error"];
        }
        $this->setAuthToken($auth_token["auth_token"]);
    }

    /**
     * @param int $organization_memberships
     * @param int $project_memberships
     * @param int $offset
     * @return mixed
     */
    public function users($organization_memberships = 0, $project_memberships = 0, $offset = 0)
    {
        $users = new Users;
        return $users->getUsers($this->auth_token, $this->app_token, $organization_memberships, $project_memberships, $offset, BASE_URL . USERS);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find_user($id)
    {
        $users = new Users;
        return $users->findUser($this->auth_token, $this->app_token, sprintf(BASE_URL . FIND_USER, $id));
    }

    /**
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function findUserOrgs($id, $offset = 0)
    {
        $users = new Users;
        return $users->findUserOrgs($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL . FIND_USER_ORG, $id));
    }

    /**
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function findUserProjects($id, $offset = 0)
    {
        $users = new Users;
        return $users->findUserProjects($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL . FIND_USER_PROJ, $id));
    }

    /**
     * @param int $offset
     * @return mixed
     */
    public function organizations($offset = 0)
    {
        $organizations = new Organizations;
        return $organizations->getOrganizations($this->auth_token, $this->app_token, $offset, BASE_URL . ORGS);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrganization($id)
    {
        $organizations = new Organizations;
        return $organizations->findOrganization($this->auth_token, $this->app_token, sprintf(BASE_URL . FIND_ORG, $id));
    }

    /**
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function findOrgProjects($id, $offset = 0)
    {
        $organizations = new Organizations;
        return $organizations->findOrgProjects($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL . FIND_ORG_PROJ, $id));
    }

    /**
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function findOrgMembers($id, $offset = 0)
    {
        $organizations = new Organizations;
        return $organizations->findOrgMembers($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL . FIND_ORG_MEMBERS, $id));
    }

    /**
     * @param string $active
     * @param int $offset
     * @return mixed
     */
    public function projects($active = '', $offset = 0)
    {
        $projects = new Projects;
        return $projects->getProjects($this->auth_token, $this->app_token, $active, $offset, BASE_URL . PROJS);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findProject($id)
    {
        $projects = new Projects;
        return $projects->findProject($this->auth_token, $this->app_token, sprintf(BASE_URL . FIND_PROJ, $id));
    }

    /**
     * @param $id
     * @param int $offset
     */
    public function findProjectMembers($id, $offset = 0)
    {
        $projects = new Projects;
        $projects->findProjectMembers($this->auth_token, $this->app_token, $offset, sprintf(BASE_URL . FIND_PROJ_MEMBERS, $id));
    }

    /**
     * @param $start_time
     * @param $stop_time
     * @param int $offset
     * @param array $options
     * @return mixed
     */
    public function activities($start_time, $stop_time, $offset = 0, $options = [])
    {
        $activities = new Activities;
        return $activities->getActivities($this->auth_token, $this->app_token, $start_time, $stop_time, $offset, $options, BASE_URL . ACTIVITIES);
    }

    /**
     * @param $start_time
     * @param $stop_time
     * @param int $offset
     * @param array $options
     * @return mixed
     */
    public function screenshots($start_time, $stop_time, $offset = 0, $options = [])
    {
        $screenshots = new Screenshots;
        return $screenshots->getScreenshots($this->auth_token, $this->app_token, $start_time, $stop_time, $offset, $options, BASE_URL . SCREENSHOTS);
    }

    /**
     * @param $start_time
     * @param $stop_time
     * @param int $offset
     * @param array $options
     * @return mixed
     */
    public function notes($start_time, $stop_time, $offset = 0, $options = [])
    {
        $notes = new Notes;
        return $notes->getNotes($this->auth_token, $this->app_token, $start_time, $stop_time, $offset, $options, BASE_URL . NOTES);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findNote($id)
    {
        $projects = new Notes;
        return $projects->findNote($this->auth_token, $this->app_token, sprintf(BASE_URL . FIND_NOTE, $id));
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function weeklyTeam($options = [])
    {
        $weekly = new Weekly;
        return $weekly->weeklyTeam($this->auth_token, $this->app_token, $options, BASE_URL . WEEKLY_TEAM);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function weeklyMy($options = [])
    {
        $weekly = new Weekly;
        return $weekly->weeklyMy($this->auth_token, $this->app_token, $options, BASE_URL . WEEKLY_MY);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param array $options
     * @return mixed
     */
    public function customDateTeam($start_date, $end_date, $options = [])
    {
        $custom = new Custom;
        return $custom->customReport($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL . CUSTOM_DATE_TEAM);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param array $options
     * @return mixed
     */
    public function customDateMy($start_date, $end_date, $options = [])
    {
        $custom = new Custom;
        return $custom->customReport($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL . CUSTOM_DATE_MY);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param array $options
     * @return mixed
     */
    public function customMemberTeam($start_date, $end_date, $options = [])
    {
        $custom = new Custom;
        return $custom->customReport($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL . CUSTOM_MEMBER_TEAM);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param array $options
     * @return mixed
     */
    public function customMemberMy($start_date, $end_date, $options = [])
    {
        $custom = new Custom;
        return $custom->customReport($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL . CUSTOM_MEMBER_MY);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param array $options
     * @return mixed
     */
    public function customProjectTeam($start_date, $end_date, $options = [])
    {
        $custom = new Custom;
        return $custom->customReport($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL . CUSTOM_PROJECT_TEAM);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param array $options
     * @return mixed
     */
    public function customProjectMy($start_date, $end_date, $options = [])
    {
        $custom = new Custom;
        return $custom->customReport($this->auth_token, $this->app_token, $start_date, $end_date, $options, BASE_URL . CUSTOM_PROJECT_MY);
    }
}
