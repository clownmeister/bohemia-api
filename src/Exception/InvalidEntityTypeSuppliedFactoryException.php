<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Exception;

use Throwable;


final class InvalidEntityTypeSuppliedFactoryException extends RuntimeException
{
    public function __construct(string $message = self::FACTORY_INVALID_ENTITY_TYPE_SUPPLIED,
        int $code = self::HTTP_INTERNAL_SERVER_ERROR,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
