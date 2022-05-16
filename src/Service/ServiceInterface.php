<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Service;

interface ServiceInterface
{
    /**
     * @return mixed
     */
    public function call();
}
