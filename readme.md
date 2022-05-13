# Readme

## Requirements for local development

1) Docker
2) Make

## Installation

1)

## Design:

### Features:

* Register / Login recaptcha

### Design

* Api
  * GET/POST:/api/v1/session/new (Login)
  * POST:/api/v1/session (Login)
  * DELETE:/api/v1/session (Logout)
  * GET:/api/v1/users (get user data)
  * GET:/api/v1/posts (get post list)
  * GET:/api/v1/posts/:postId (get post)
  * DELETE:/api/v1/posts/:postId (delete post)
* Backend
  * Login page
  * User edit/create/enable/disable (create surname + firstname abbreviation)
  * Roles edit/create
  * Permissions edit/create
  * Posts edit/create

### Permissions

* comment:remove
* comment:add
* comment:restore
* post:edit
* post:add
* post:remove
* post:publish
* post:restore
* user:add
* user:remove
* user:enable
* user:disable
* permission:view
* permission:add
* permission:remove
* role:view
* role:add
* role:remove
* role:edit

### Default roles & permissions:

#### User (No access to backend)

* comment:add

#### Moderator

* comment:add
* post:add
* post:publish

#### Admin

* comment:remove
* comment:add
* comment:restore
* post:edit
* post:add
* post:remove
* post:publish
* post:restore
* user:add
* user:remove
* user:enable
* user:disable
* permission:view
* permission:add
* permission:remove
* role:view
* role:add
* role:remove
* role:edit
