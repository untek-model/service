<?php

namespace Untek\Model\Service\Interfaces;

use Untek\Core\Code\Helpers\DeprecateHelper;

DeprecateHelper::hardThrow();

interface CreateEntityInterface
{

    /**
     * Создать сущность
     *
     * Создавать новые сущности должен уметь только сервис
     *
     * @param array $attributes
     * @return object
     */
    public function createEntity(array $attributes = []);

}