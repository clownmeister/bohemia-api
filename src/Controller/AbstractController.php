<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Exception\BadRequestException;
use JsonSchema\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    protected const HEADER_CONTENT_TYPE = 'content-type';

    protected const CONTENT_TYPE_APPLICATION_JSON = 'application/json';

    protected const ENCODE_TYPE_JSON = 'json';

    protected function validateSchema(string $json, string $schema): array
    {
        $data = json_decode($json);
        $validator = new Validator();
        $validator->validate($data, (object)['$ref' => 'file://' . realpath($schema)]);

        if ($validator->isValid()) {
            return (array)$data;
        }

        $message = "BAD_REQUEST:\n";

        foreach ($validator->getErrors() as $error) {
            $message .= sprintf("[%s] %s\n", $error['property'], $error['message']);
        }

        throw new BadRequestException($message);
    }
}
