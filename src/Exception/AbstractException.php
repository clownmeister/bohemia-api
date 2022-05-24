<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Exception;

use Symfony\Component\Config\Definition\Exception\Exception;

abstract class AbstractException extends Exception
{
    protected const HTTP_OK = 200;
    protected const HTTP_PERMANENT_REDIRECT = 301;
    protected const HTTP_TEMPORARY_REDIRECT = 302;
    protected const HTTP_BAD_REQUEST = 400;
    protected const HTTP_NOT_FOUND = 404;
    protected const HTTP_INTERNAL_SERVER_ERROR = 500;

    protected const BAD_REQUEST = 'BAD_REQUEST';

    protected const INVALID_USER_TYPE = 'INVALID_USER_TYPE';
    protected const INVALID_ENTITY_TYPE = 'INVALID_ENTITY_TYPE';
    protected const FACTORY_INVALID_ENTITY_TYPE_SUPPLIED = 'FACTORY_INVALID_ENTITY_TYPE_SUPPLIED';
    protected const DUPLICATE_USER = 'DUPLICATE_USER';

    protected const MAIL_SERVICE_UNAVAILABLE = 'MAIL_SERVICE_UNAVAILABLE';

    protected const SERVICE_UNAVAILABLE = 'SERVICE_UNAVAILABLE';

    protected const SECURITY_EXCEPTION = 'SECURITY_EXCEPTION';
}
