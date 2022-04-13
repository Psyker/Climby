<?php

namespace App\GraphQL\Resolver;

use App\Repository\SessionRepository;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class SessionResolver implements QueryInterface
{

    public function __construct(private readonly SessionRepository $sessionRepository) {}

    public function __invoke(): array
    {
        return $this->sessionRepository->findAll();
    }

}
