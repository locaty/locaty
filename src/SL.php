<?php

namespace Locaty;

class SL extends ServiceLocator\AbstractServiceLocator {

    /**
     * @return Component\Router\Facade
     */
    public static function router(): Component\Router\Facade {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return self::_get(Component\Router\Facade::class);
    }
}
