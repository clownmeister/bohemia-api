<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Exception;

use Throwable;

final class MailerTransportException extends RuntimeException
{
    public function __construct(
        string $message = self::MAIL_SERVICE_UNAVAILABLE,
        int $code = self::HTTP_INTERNAL_SERVER_ERROR,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
