<?php

namespace ClownMeister\BohemiaApi\Factory;

interface FactoryInterface
{
    public function create(mixed $data): mixed;
}
