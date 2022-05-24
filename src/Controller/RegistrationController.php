<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Form\RegistrationFormType;
use ClownMeister\BohemiaApi\Handler\RegistrationHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RegistrationController extends AbstractController
{
    public function __construct(private RegistrationHandler $handler)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handler->handle($user, $form);

            return $this->redirectToRoute('app_register_success');
        }

        return $this->render('pages/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
