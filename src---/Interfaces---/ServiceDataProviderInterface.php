<?php

namespace Untek\Model\Service\Interfaces;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Model\DataProvider\Libs\DataProvider;
use Untek\Model\Query\Entities\Query;

DeprecateHelper::hardThrow();

interface ServiceDataProviderInterface
{

    /**
     * Получить провайдер данных
     * @param Query|null $query Объект запроса
     * @return DataProvider
     */
    public function getDataProvider(Query $query = null): DataProvider;

}