<?php

namespace App\GraphQL\Resolver;

use App\Repository\GymRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class GymResolver implements QueryInterface
{
    public function __construct(private readonly GymRepository $gymRepository) {}

    public function __invoke(Argument $args): array
    {
        if ($term = $args->offsetGet('term')) {
            return $this->gymRepository->findByName($term);
        }

        return $this->gymRepository->findAll();
    }

}
