# Hubstaff PHP Client

A PHP toolkit for Hubstaff API.

## Installation

Include the ```hubstaff.php``` file in your project

## Usage

Calls for Hubstuff API v1 are relative to the base url https://api.hubstaff.com/v1/

API actions are available as methods on the client object. Currently, the Hubstaff client has the following methods:

| Action               	                   | Method             					                             |
|:-----------------------------------------|:----------------------------------------------------------|
| **Users**                                |                   					                               |
| List users          	                   | `#users($organizationMemberships = 0, $projectMemberships = 0, $offset = 0)`              |
| Find a user          	                   | `#findUser($id)`                                     |
| Find a users organizations    	         | `#findUserOrgs($id, $offset = 0)`                        |
| Find a users projects                    | `#findUserProjects($id, $offset = 0)`                    |
| **Organizations**                        |                   					                               |
| List organizations                       | `#organizations($offset = 0)`                                  |
| Find a organization                      | `#findOrganization($id)`                              |
| Find a organization projects 	           | `#findOrgProjects($id, $offset = 0)`                      |
| Find a organization members              | `#findOrgMembers($id, $offset = 0)`                       |
| **Projects**                             |                   					                               |
| List projects                            | `#projects($status = '', $offset = 0)`                               |
| Find a project                           | `#findProject($id)`                               |
| Find a project members                   | `#findProjectMembers($id, $offset = 0)`               |
| **Activities**                           |                   					                               |
| List activities                          | `#activities($startTime, $stopTime, $offset = 0, array $options = [])`  |
| **Screenshots**                          |                    					                             | 
| List Screenshots                         | `#screenshots($startTime, $stopTime, $offset = 0, array $options = [])` |
| **Notes**                                |                   					                               |
| List notes                               | `#notes($startTime, $stopTime, $offset = 0, array $options = [])`       |
| Find a note                              | `#findNote($id)`                                     |
| **Weekly Reports**                       |                   					                               |
| List weekly team report                  | `#weeklyTeam(array $options = [])`                                |
| List weekly individual report            | `#weeklyMy(array $options = [])`                                  |
| **Custom Reports**                       |                   					                               |
| List custom team report by date          | `#customDateTeam($startDate, $endDate, array $options = [])`     |
| List custom individual report by date    | `#customDateMy($startDate, $endDate, array $options = [])`       |
| List custom team report by member        | `#customMemberTeam($startDate, $endDate, array $options = [])`   |
| List custom individual report by member  | `#customMemberMy($startDate, $endDate, array $options = [])`     |
| List custom team report by project       | `#customProjectTeam($startDate, $endDate, array $options = [])`  |
| List custom individual report by project | `#customProjectMy($startDate, $endDate, array $options = [])`    |



## Usage Examples

### Authentication

First, grab your personal ``APP_TOKEN`` found in [your account settings](https://developer.hubstaff.com/) and initialize a new client with your ``APP_TOKEN``.

After that, you'll authenticate the client and start exporting data from your account.

```php
require __DIR__ . '/vendor/autoload.php'; 

$appToken = "< your hubstaff app token >";
$email = "< your hubstaff account email address >";
$password = "< your hubstaff account password >";

$hubstaffClient = new Hubstaff\HubStaffClient();
$hubstaffClient->setAppToken($appToken); 
$hubstaffClient->auth(email,password);

$authToken = $hubstaff->getAuthToken();

```
### You can list all users for a specific account, and get the details about the organization, and the projects they've worked on.

```php
$hubstaffClient->users(1,1,0);

//=>
{
  "users": [
    {
      "id": 61188,
      "name": "Raymond Cudjoe",
      "last_activity": "2016-05-24T01:25:21Z",
      "email": "rkcudjoe@hookengine.com",
      "organizations": [
        {
          "id": 27572,
          "name": "Hook Engine",
          "last_activity": "2016-05-24T01:25:21Z"
        }
      ],
      "projects": [
        {
          "id": 112761,
          "name": "Build Ruby Gem",
          "last_activity": "2016-05-24T01:25:21Z",
          "status": "Active"
        },
        {
          "id": 120320,
          "name": "Hubstaff API tutorial",
          "last_activity": null,
          "status": "Active"
        }
      ]
    }
  ]
}

```

### You can find specific users by their``user_id``.

```php
$hubstaffClient->findUser(61188);

//=>
{
  "user": {
    "id": 61188,
    "name": "Raymond Cudjoe",
    "last_activity": "2016-05-24T01:25:21Z",
    "email": "rkcudjoe@hookengine.com"
  }
}
```

### You can list all active projects.

```php
$hubstaffClient->projects();

//=>
{
  "projects": [
    {
      "id": 112761,
      "name": "Build Ruby Gem",
      "last_activity": "2016-05-24T01:25:21Z",
      "status": "Active",
      "description": null
    },
    {
      "id": 120320,
      "name": "Hubstaff API tutorial",
      "last_activity": null,
      "status": "Active",
      "description": null
    }
  ]
}

```

### Retrieve screenshots for a specific project, within a specific timeframe.

```php
$hubstaffClient->screenshots("2016-05-22", "2016-05-24", ["projects"=>"112761"]);

//=>
{
  "screenshots": [
    {
      "id": 173200938,
      "url": "https://hubstaff-production.s3.amazonaws.com/screenshots/61188/2016/21/112761/c0ee59a20ef67f9537057e50fcd2132f515cc45e/0.jpg",
      "time_slot": "2016-05-23T22:00:00Z",
      "recorded_at": "2016-05-23T22:08:36Z",
      "user_id": 61188,
      "project_id": 112761,
      "offset_x": 0,
      "offset_y": 0,
      "width": 1440,
      "height": 900,
      "screen": 0
    },
    {
      "id": 173200946,
      "url": "https://hubstaff-production.s3.amazonaws.com/screenshots/61188/2016/21/112761/07411361cb290b3b6f1990ae543f2d8b4e1eb463/0.jpg",
      "time_slot": "2016-05-23T22:10:00Z",
      "recorded_at": "2016-05-23T22:11:15Z",
      "user_id": 61188,
      "project_id": 112761,
      "offset_x": 0,
      "offset_y": 0,
      "width": 1440,
      "height": 900,
      "screen": 0
    },
    {
      "id": 173202151,
      "url": "https://hubstaff-production.s3.amazonaws.com/screenshots/61188/2016/21/112761/3012270d9192734d93d861ed0eb9de66d68721ca/0.jpg",
      "time_slot": "2016-05-23T22:20:00Z",
      "recorded_at": "2016-05-23T22:23:05Z",
      "user_id": 61188,
      "project_id": 112761,
      "offset_x": 0,
      "offset_y": 0,
      "width": 1440,
      "height": 900,
      "screen": 0
    }
  ]
}
```

### Run tests

In order to run tests you need to get development dependencies using composer:

```php
composer install --prefer-source
``` 

And run all tests

```php
./vendor/bin/phpunit tests
```
OR execute a specific tests using filter option of phpunit. 

```php 
./vendor/bin/phpunit tests --filter testName

```