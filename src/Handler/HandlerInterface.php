<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Handler;

interface HandlerInterface
{
    /**
     * @return mixed
     */
    public function handle();
}
