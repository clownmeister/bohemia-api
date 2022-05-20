<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Controller\Api;

use ClownMeister\BohemiaApi\Controller\AbstractController;
use ClownMeister\BohemiaApi\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostRegisterUser extends AbstractController
{
    public function __construct(
        private UserRepository $repository,
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/user', name: 'api_user_register', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $data = $this->validateSchema($request->getContent(), __DIR__ . '/schema/user/register.json');
    }
}
