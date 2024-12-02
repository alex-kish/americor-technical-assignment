<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Bus;

use App\Core\Application\Query\QueryBusInterface;
use App\Core\Application\Query\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(private readonly MessageBusInterface $queryBus)
    {
    }

    public function execute(QueryInterface $query): mixed
    {
        return $this->handle($query);
    }
}
