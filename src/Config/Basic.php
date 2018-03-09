<?php

namespace Locaty\Config;

abstract class Basic {

    /**
     * @var array
     */
    protected static $_config = [];

    /**
     * @param array $config
     */
    public static function init(array $config): void {
        self::$_config = array_replace_recursive(self::$_config, $config);
    }
}
