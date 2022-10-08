<?php

namespace App\GraphQL\Mutation;

use App\Repository\GymRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CreateSessionMutation implements MutationInterface, AliasedInterface
{
    private GymRepository $gymRepository;

    public function __construct(GymRepository $gymRepository)
    {

        $this->gymRepository = $gymRepository;
    }

    public function createSession(Argument $args): array
    {
        $rawArgs = $args->getArrayCopy();
    }

    public static function getAliases(): array
    {
        return [
            'createSession' => 'create_session'
        ];
    }
}
