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
| List users          	                   | `#users(org_member, project_member, offset)`              |
| Find a user          	                   | `#find_user(user_id)`                                     |
| Find a users organizations    	         | `#find_user_orgs(user_id, offset)`                        |
| Find a users projects                    | `#find_user_projects(user_id, offset)`                    |
| **Organizations**                        |                   					                               |
| List organizations                       | `#organizations(offset)`                                  |
| Find a organization                      | `#find_organization(org_id)`                              |
| Find a organization projects 	           | `#find_org_projects(org_id, offset)`                      |
| Find a organization members              | `#find_org_members(org_id, offset)`                       |
| **Projects**                             |                   					                               |
| List projects                            | `#projects(active, offset)`                               |
| Find a project                           | `#find_project(project_id)`                               |
| Find a project members                   | `#find_project_members(project_id, offset)`               |
| **Activities**                           |                   					                               |
| List activities                          | `#activities(start_time, stop_time, offset, options={})`  |
| **Screenshots**                          |                    					                             | 
| List Screenshots                         | `#screenshots(start_time, stop_time, offset, options={})` |
| **Notes**                                |                   					                               |
| List notes                               | `#notes(start_time, stop_time, offset, options={})`       |
| Find a note                              | `#find_note(note_id)`                                     |
| **Weekly Reports**                       |                   					                               |
| List weekly team report                  | `#weekly_team(options={})`                                |
| List weekly individual report            | `#weekly_my(options={})`                                  |
| **Custom Reports**                       |                   					                               |
| List custom team report by date          | `#custom_date_team(start_date, end_date, options={})`     |
| List custom individual report by date    | `#custom_date_my(start_date, end_date, options={})`       |
| List custom team report by member        | `#custom_member_team(start_date, end_date, options={})`   |
| List custom individual report by member  | `#custom_member_my(start_date, end_date, options={})`     |
| List custom team report by project       | `#custom_project_team(start_date, end_date, options={})`  |
| List custom individual report by project | `#custom_project_my(start_date, end_date, options={})`    |



## Usage Examples

### Authentication

First, grab your personal ``APP_TOKEN`` found in [your account settings](https://developer.hubstaff.com/) and initialize a new client with your ``APP_TOKEN``.

After that, you'll authenticate the client and start exporting data from your account.

```php
include("hubstaff.php");

$app_token = "< your hubstaff app token >";
$email = "< your hubstaff account email address >";
$password = "< your hubstaff account password >";

$hubstaff = new hubstaff\Client($app_token);

$hubstaff->auth(email,password);

$auth_token = $hubstaff->get_auth_token();

//=>
"< hubstaff auth_token >"
```
### You can list all users for a specific account, and get the details about the organization, and the projects they've worked on.

```php
$hubstaff->users(1,1,0);

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
$hubstaff->find_user(61188);

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
$hubstaff->projects();

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
$hubstaff->screenshots("2016-05-22", "2016-05-24", array("projects"=>"112761"));

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

In order to run user tests you need to get development dependencies using composer:
```php
composer install --dev
``` 
and run
```php
phpunit ./users
```
