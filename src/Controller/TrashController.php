<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Handler\CheckForExpiredArchiveHandler;
use ClownMeister\BohemiaApi\Handler\GetTrashEntitiesHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TrashController extends AbstractController
{
    public function __construct(
        private GetTrashEntitiesHandler $getTrashEntitiesHandler,
        private CheckForExpiredArchiveHandler $checkForExpiredArchiveHandler
    ) {
    }

    #[Route('/trash', name: 'app_trash')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRASH_VIEW');

        $this->checkForExpiredArchiveHandler->handle();
        $entities = $this->getTrashEntitiesHandler->handle();

        return $this->render('pages/trash_bin.html.twig', [
            'entities' => $entities,
        ]);
    }
}
