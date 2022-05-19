<?php
declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

final class LoginController extends AbstractController
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('pages/login.html.twig');
    }
}
