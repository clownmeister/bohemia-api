<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class StatusController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @Route("/status", name="app_status")
     */
    public function index(): Response
    {
        try {
            $mysql = $this->entityManager->getConnection()->connect();
        } catch (Exception $e) {
            $mysql = false;
        }

        return new Response(
            json_encode([
                'mysql' => $mysql
            ]),
            Response::HTTP_OK,
            [self::HEADER_CONTENT_TYPE => self::CONTENT_TYPE_APPLICATION_JSON]
        );
    }
}
