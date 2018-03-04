<?php

namespace Locaty;

class SL extends ServiceLocator\Basic {

    /**
     * @return Component\Router\Facade
     */
    public static function router(): Component\Router\Facade {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return self::_get(Component\Router\Facade::class);
    }

    /**
     * @return Service\Utils
     */
    public static function utils(): Service\Utils {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return self::_get(Service\Utils::class);
    }
}
