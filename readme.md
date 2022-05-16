# Readme

## Requirements for local development

1) Docker
  * Should be fine on every OS but on Windows use only WSL2
2) Make
  * Should be easy to install on every unix OS including WSL

## Installation

1) Type `make env` and configure your .env file accordingly. (you should only be missing some secrets)
2) Set up your `hosts` file according to your `.env` file. (for example `api.bohemia.docker` -> `127.0.0.102`)
3) Type `make`.
4) Done.

* Access **Backoffice** at <http://api.bohemia.docker/admin/>
* Access **API** at <http://api.bohemia.docker/api/v1>
* Access **PHPMyAdmin** at <http://api.bohemia.docker:81>
* Access **Mailhog** at <http://api.bohemia.docker:82>
* Access **Status** at <http://api.bohemia.docker/status>

## Login

Login to backoffice with default user:

| User  | Pass   |
|-------|--------|
| admin | 123456 |

You can register new user if you want, but you need to set up roles via admin. After registration run `make send-mail`
to send queued emails with confirmation link.

In the email you will also find your new username.

You will be able to get the email from <http://api.bohemia.docker:82>.

## Email

Run `make send-mail` to consume the queue.

Catch the emails at <http://api.bohemia.docker:82>

## Commands:

Execute only in root of the project

| Command            | Description                                                                            |
|--------------------|----------------------------------------------------------------------------------------|
| `make`             | Easy start up. Starts docker, installs, builds.                                        |
| `make env`         | Copies .env file. In some cases fills out some things.                                 |
| `make up`          | Starts/Restarts containers.                                                            |
| `make install`     | Installs project packages and generates JWT keys. Also runs migrations. Builds assets. |
| `make udpate`      | Runs composer update.                                                                  |
| `make vendor`      | Clears vendor.                                                                         |
| `make cache-clear` | Clears symfony cache.                                                                  |
| `make build`       | Builds assets into build folder.                                                       |
| `make watch`       | Runs asset watcher.                                                                    |
| `make test`        | Runs all tests.                                                                        |
| `make phpcs`       | Runs PHP code sniffer.                                                                 |
| `make fix`         | Fixes all fixable code style issues from PHPCS.                                        |
| `make phpstan`     | Runs PHPStan.                                                                          |
| `make diff`        | Creates ORM migration.                                                                 |
| `make migrate`     | Migrates to latest migration.                                                          |
| `make send-mail`   | Send all mails from queue. Needed for registration.                                    |

## Dev notes & todo:

### Features:

* Register / Login recaptcha

### Design

* Api (tba - wip)
  * GET/POST:/api/v1/session/new (sso/auth?)
  * POST:/api/v1/session (Login)
  * DELETE:/api/v1/session (Logout)
  * GET:/api/v1/users (get user data)
  * GET:/api/v1/posts (get post list)
  * GET:/api/v1/posts/:postId (get post)
* Backend
  * Login page
  * User edit/create/enable/disable (create surname + firstname abbreviation)
  * Roles edit/create
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
* post:archive

#### Admin

* comment:remove
* comment:add
* comment:restore
* post:edit
* post:add
* post:archive
* post:remove
* post:publish
* post:restore
* user:add
* user:remove
* user:enable
* user:disable
* role:view
* role:add
* role:remove
* role:edit

### Tech-debt & notes

* Repository remove "remove" method
* Link tables missing
* Move unnecessary data out of User table
* Weird entity encapsulation. No time to investigate.
* No time for SOLID :(
* Emails need editor. Used https://dashboard.unlayer.com/ for POC.
