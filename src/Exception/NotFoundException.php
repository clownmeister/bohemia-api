<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Exception;

use Throwable;

final class NotFoundException extends RuntimeException
{
    public function __construct(
        string $message = self::NOT_FOUND,
        int $code = self::HTTP_NOT_FOUND,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
