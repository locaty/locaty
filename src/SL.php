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

    /**
     * @return Component\Template\Facade
     */
    public static function template(): Component\Template\Facade {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return self::_get(Component\Template\Facade::class);
    }
}
