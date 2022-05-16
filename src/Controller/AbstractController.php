<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    protected const HEADER_CONTENT_TYPE = 'content-type';

    protected const CONTENT_TYPE_APPLICATION_JSON = 'application/json';
}
