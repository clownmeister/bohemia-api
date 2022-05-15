<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Exception;

use Symfony\Component\Config\Definition\Exception\Exception;

abstract class AbstractException extends Exception
{
    protected const HTTP_OK = 200;
    protected const HTTP_PERMANENT_REDIRECT = 301;
    protected const HTTP_TEMPORARY_REDIRECT = 302;
    protected const HTTP_NOT_FOUND = 404;
    protected const HTTP_INTERNAL_SERVER_ERROR = 500;

    protected const INVALID_USER_TYPE = 'INVALID_USER_TYPE';
}
