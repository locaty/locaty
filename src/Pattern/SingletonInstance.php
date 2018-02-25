<?php

namespace Locaty\Pattern;

trait SingletonInstance {

    /**
     * @var static
     */
    protected static $_instance;

    /**
     * @return static
     */
    final public static function instance() {
        return isset(static::$_instance)
            ? static::$_instance
            : static::$_instance = new static;
    }

    final private function __construct() {
        $this->init();
    }

    protected function init() {}

    /** @noinspection PhpUnusedPrivateMethodInspection */
    final private function __wakeup() {}

    final private function __clone() {}
}
