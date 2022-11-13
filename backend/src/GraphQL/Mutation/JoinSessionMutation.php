<?php

namespace App\GraphQL\Mutation;

use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class JoinSessionMutation implements MutationInterface, AliasedInterface
{
    public function __construct(
        private readonly SessionRepository $sessionRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function joinSession(Argument $args, UserInterface $user): array
    {
        $sessionId = $args->offsetGet('input')['sessionId'];
        $session = $this->sessionRepository->find($sessionId);

        if (null === $session) {
            throw new UserError('This session does not exist.');
        }

        $session->addMember($user);
        $this->entityManager->flush();

        return [
            'session' => $session
        ];
    }

    public static function getAliases(): array
    {
        return [
            'joinSession' => 'join_session'
        ];
    }
}
