<?php

namespace Untek\Model\Service\Base;

use Untek\Model\Shared\Enums\EventEnum;
use Untek\Model\Shared\Events\QueryEvent;
use Untek\Model\Shared\Traits\DispatchEventTrait;
use Untek\Model\Shared\Traits\ForgeQueryTrait;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Model\Query\Entities\Query;
use Untek\Model\QueryFilter\Interfaces\ForgeQueryByFilterInterface;
use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Model\Service\Interfaces\CrudServiceInterface;
use Untek\Model\Service\Traits\CrudServiceCreateTrait;
use Untek\Model\Service\Traits\CrudServiceDeleteTrait;
use Untek\Model\Service\Traits\CrudServiceFindAllTrait;
use Untek\Model\Service\Traits\CrudServiceFindOneTrait;
use Untek\Model\Service\Traits\CrudServiceUpdateTrait;
use Untek\Model\Validator\Helpers\ValidationHelper;

/**
 * @method CrudRepositoryInterface getRepository()
 */
abstract class BaseCrudService extends BaseService implements CrudServiceInterface, ForgeQueryByFilterInterface
{

    use DispatchEventTrait;
    use ForgeQueryTrait;

    use CrudServiceCreateTrait;
    use CrudServiceDeleteTrait;
    use CrudServiceFindAllTrait;
    use CrudServiceFindOneTrait;
    use CrudServiceUpdateTrait;

    public function forgeQueryByFilter(object $filterModel, Query $query)
    {
        $repository = $this->getRepository();
        ClassHelper::checkInstanceOf($repository, ForgeQueryByFilterInterface::class);
        $event = new QueryEvent($query);
        $event->setFilterModel($filterModel);
        $this->getEventDispatcher()->dispatch($event, EventEnum::BEFORE_FORGE_QUERY_BY_FILTER);
        $repository->forgeQueryByFilter($filterModel, $query);
    }

    public function persist(object $entity)
    {
        ValidationHelper::validateEntity($entity);
        $this->getEntityManager()->persist($entity);
    }
}
