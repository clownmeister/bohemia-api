<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Service;

interface ServiceInterface
{
    public function call(): mixed;
}
