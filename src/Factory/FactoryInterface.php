<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Factory;

interface FactoryInterface
{
    public function create(mixed $data): mixed;
}
