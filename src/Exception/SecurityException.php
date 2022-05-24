<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Exception;

use Throwable;

final class SecurityException extends RuntimeException
{
    public function __construct(
        string $message = self::SECURITY_EXCEPTION,
        int $code = self::HTTP_INTERNAL_SERVER_ERROR,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
