<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RegistrationSuccessController extends AbstractController
{
    #[Route('/registration-success', name: 'app_register_success')]
    public function index(): Response
    {
        return $this->render('pages/register_confirmation.html.twig');
    }
}
