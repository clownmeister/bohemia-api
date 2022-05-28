<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Exception;

use Throwable;

final class DuplicateUserException extends RuntimeException
{
    public function __construct(
        string $message = self::DUPLICATE_USER,
        int $code = self::HTTP_INTERNAL_SERVER_ERROR,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
