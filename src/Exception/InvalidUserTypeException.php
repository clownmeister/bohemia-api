<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Exception;

use Throwable;

class InvalidUserTypeException extends RuntimeException
{
    public function __construct(string $message = self::INVALID_USER_TYPE, int $code = self::HTTP_INTERNAL_SERVER_ERROR,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
