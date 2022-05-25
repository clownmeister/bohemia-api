<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Security;

use ClownMeister\BohemiaApi\Entity\User;
use ClownMeister\BohemiaApi\Exception\InvalidUserTypeException;
use ClownMeister\BohemiaApi\Exception\ServiceUnavailableException;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

final class UsernameGenerator
{
    public function __construct(private EntityManagerInterface $manager, private SluggerInterface $slugger)
    {
    }

    public function generate(UserInterface $user): string
    {
        if (!$user instanceof User) {
            throw new InvalidUserTypeException();
        }

        $firstname = $this->cleanString(substr($user->getFirstname(), 0, 3));
        $lastname = $this->cleanString($user->getLastname());

        $combination = $this->slugger->slug(sprintf('%s%s', $lastname, $firstname))->toString();
        $iterator = $this->getUniqueIterator($combination);

        return sprintf('%s%s', $combination, $iterator === 0 ? '' : (string)$iterator);
    }

    private function cleanString(string $entry): string
    {
        return strtolower(str_replace(' ', '', $entry));
    }

    private function getUniqueIterator(string $username): int
    {
        try {
            $result = $this->manager->getConnection()->prepare(
                "SELECT COUNT(`id`) AS total FROM user 
                WHERE username REGEXP CONCAT('^', :username, '($|([0-9]+$))')"
            )->executeQuery([
                'username' => $username
            ])->fetchAssociative();
        } catch (Exception $exception) {
            throw new ServiceUnavailableException(previous: $exception);
        }

        if (is_bool($result)) {
            throw new ServiceUnavailableException();
        }

        return $result['total'];
    }
}
