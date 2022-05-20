<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Exception;

use Throwable;

final class BadRequestException extends RuntimeException
{
    public function __construct(string $message = self::BAD_REQUEST,
        int $code = self::HTTP_BAD_REQUEST,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
