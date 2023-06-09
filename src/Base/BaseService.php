<?php

namespace Untek\Model\Service\Base;

use Untek\Model\Shared\Interfaces\GetEntityClassInterface;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Core\EventDispatcher\Traits\EventDispatcherTrait;
use Untek\Model\Repository\Traits\RepositoryAwareTrait;
use Untek\Model\Service\Interfaces\CreateEntityInterface;

abstract class BaseService implements GetEntityClassInterface, CreateEntityInterface
{

    use EventDispatcherTrait;
    use EntityManagerAwareTrait;
    use RepositoryAwareTrait;

    public function getEntityClass(): string
    {
        return $this->getRepository()->getEntityClass();
    }

    public function createEntity(array $attributes = [])
    {
        $entityClass = $this->getEntityClass();
        return $this
            ->getEntityManager()
            ->createEntity($entityClass, $attributes);
    }
}