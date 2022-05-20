<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Controller;


use ClownMeister\BohemiaApi\Exception\InvalidEntityTypeException;
use ClownMeister\BohemiaApi\Handler\RestoreCommentHandler;
use ClownMeister\BohemiaApi\Handler\RestorePostHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RestoreEntityController extends AbstractController
{
    public function __construct(private RestorePostHandler $postHandler, private RestoreCommentHandler $commentHandler)
    {
    }

    #[Route('/restore-entity', name: 'app_restore_entity', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TRASH_VIEW');

        $id = $request->request->get('id');
        $type = $request->request->get('type');
        $user = $this->getUser();

        switch ($type) {
            case 'post':
                $this->postHandler->handle($id, $user);
                break;
            case 'comment':
                $this->commentHandler->handle($id, $user);
                break;
            default:
                throw new InvalidEntityTypeException();
        }

        $this->addFlash('success', 'Successfully restored entity');
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }
}
