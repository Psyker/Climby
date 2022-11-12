<?php

namespace App\GraphQL\Mutation;

use App\Entity\Session;
use App\Repository\GymRepository;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CreateSessionMutation implements MutationInterface, AliasedInterface
{
    public function __construct(
        private readonly GymRepository $gymRepository,
        private readonly SessionRepository $sessionRepository,
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function createSession(Argument $args): array
    {
        $inputArgs = $args->getArrayCopy()['input'];
        $gym = $this->gymRepository->find($inputArgs['gymId']);

        if (null === $gym) {
            throw new UserError('This gym does not exist.');
        }

        $session = new Session();
        $session->setName($inputArgs['name'])
            ->setStartAt($inputArgs['startAt'])
            ->setDescription($inputArgs['description'])
            ->setEndAt($inputArgs['endAt'])
            ->setDiscipline($inputArgs['discipline'])
            ->setType($inputArgs['locationType'])
            ->setSeats($inputArgs['seats'])
            ->setGym($gym)
            ->setGrade($inputArgs['grade'])
            ->setPublic($inputArgs['public']);

        $this->entityManager->persist($session);
        $this->entityManager->flush();

        $createdSession = $this->sessionRepository->find($session->getId());

        return [
            'session' => $createdSession
        ];
    }

    public static function getAliases(): array
    {
        return [
            'createSession' => 'create_session'
        ];
    }
}
