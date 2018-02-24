<?php

namespace Locaty\Config;

abstract class Basic {

    /**
     * @var array
     */
    protected static $_config;

    /**
     * @param array $data
     */
    public static function load(array $data): void {
        self::$_config = array_merge(self::$_config, $data);
    }

    /**
     * @param array $configs
     */
    public static function loadMulti(array $configs): void {
        self::load(call_user_func_array('array_merge', $configs));
    }
}
