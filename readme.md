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

| Command                 | Description                                                                            |
|-------------------------|----------------------------------------------------------------------------------------|
| `make`                  | Easy start up. Starts docker, installs, builds.                                        |
| `make env`              | Copies .env file. In some cases fills out some things.                                 |
| `make up`               | Starts/Restarts containers.                                                            |
| `make install`          | Installs project packages and generates JWT keys. Also runs migrations. Builds assets. |
| `make composer-install` | Installs composer.                                                                     |
| `make composer-update`  | Updates composer.                                                                      |
| `make udpate`           | Runs composer update.                                                                  |
| `make vendor`           | Clears vendor.                                                                         |
| `make cache-clear`      | Clears symfony cache.                                                                  |
| `make build`            | Builds assets into build folder.                                                       |
| `make watch`            | Runs asset watcher.                                                                    |
| `make test`             | Runs all tests.                                                                        |
| `make phpcs`            | Runs PHP code sniffer.                                                                 |
| `make fix`              | Fixes all fixable code style issues from PHPCS.                                        |
| `make phpstan`          | Runs PHPStan.                                                                          |
| `make diff`             | Creates ORM migration.                                                                 |
| `make migrate`          | Migrates to latest migration.                                                          |
| `make migration`        | Creates blank migration.                                                               |
| `make drop`             | Drops db and clears migration history.                                                 |
| `make validate`         | Validates db schema against mapper.                                                    |
| `make send-mail`        | Send all mails from queue. Needed for registration.                                    |

## Dev notes & todo:

### Todo:

* login
* logout
* register api
* add comment endpoint
* edit comment endpoint
* remove comment endpoint

### Tech-debt & notes

* Service token to avoid exposing api
* Refresh token
* Don't send raw html in posts
* Edit post html white text (only dark theme). Need to include css entrypoint in CRUD controllers.
