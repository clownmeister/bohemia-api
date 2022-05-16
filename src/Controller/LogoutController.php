<?php
declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'app_logout')]
    public function register(): Response
    {
        return $this->redirectToRoute('app_login');
    }
}
