<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Handler;

use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Security\EmailVerifier;
use ClownMeister\BohemiaApi\Security\UsernameGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegistrationHandler
{
    public function __construct(
        private EmailVerifier $emailVerifier,
        private UsernameGenerator $usernameGenerator,
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function handle(User $user, FormInterface $form): void
    {
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            )
        );

        $user->setUsername($this->usernameGenerator->generate($user));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->emailVerifier->sendEmailConfirmation(
            'app_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('mailer@api.bohemia.com', 'Mailer'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('email/confirmation_email.html.twig')
        );
    }
}
