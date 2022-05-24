<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Security;

use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use ClownMeister\BohemiaApi\Exception\MailerTransportException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

final class EmailVerifier
{
    public function __construct(
        private VerifyEmailHelperInterface $helper,
        private MailerInterface $mailer,
        private EntityManagerInterface $manager
    ) {
    }

    public function sendEmailConfirmation(string $verifyEmailRouteName, UserInterface $user, TemplatedEmail $email): void
    {
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        $signatureComponents = $this->helper->generateSignature(
            $verifyEmailRouteName,
            $user->getId(),
            $user->getEmail(),
            ['id' => $user->getId()]
        );

        $context = $email->getContext();
        $context['signedUrl'] = $signatureComponents->getSignedUrl();
        $context['username'] = $user->getUserIdentifier();
        $context['expiresAtMessageKey'] = $signatureComponents->getExpirationMessageKey();
        $context['expiresAtMessageData'] = $signatureComponents->getExpirationMessageData();

        $email->context($context);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $transportException) {
            throw new MailerTransportException(previous: $transportException);
        }
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    public function handleEmailConfirmation(Request $request, UserInterface $user): void
    {
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        $this->helper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());

        $user->setIsVerified(true);

        $this->manager->persist($user);
        $this->manager->flush();
    }
}
