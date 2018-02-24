<?php

namespace Locaty\ServiceLocator;

use Locaty\Service;

abstract class Basic {

    /**
     * @var Service\Basic[]
     */
    private static $_services = [];

    /**
     * @var bool
     */
    private static $_allowInjections = false;

    /**
     * @var string[]
     */
    private static $_injections = [];

    /**
     * @param string $class
     * @return Service\Basic
     */
    protected static function _get(string $class): Service\Basic {
        $class = self::_prepareClassName($class);
        if (array_key_exists($class, self::$_services)) {
            return self::$_services[$class];
        }
        $service = new $class();
        self::$_services[$class] = $service;
        return $service;
    }

    /**
     * @param string $class
     * @param string $replaceClass
     */
    public static function inject(string $class, string $replaceClass): void {
        self::_ensureInjectionAvailable();
        self::$_injections[$class] = $replaceClass;
        self::$_services[$class] = new $replaceClass();
    }

    public static function allowInjections(): void {
        self::$_allowInjections = true;
    }

    public static function resetInjections(): void {
        self::$_allowInjections = false;
        foreach (array_keys(self::$_injections) as $class) {
            unset(self::$_services[$class]);
        }
    }

    /**
     * @param string $class
     * @return string
     */
    private static function _prepareClassName(string $class): string {
        return trim($class, "\\");
    }

    /**
     * @throws \Exception
     */
    private static function _ensureInjectionAvailable(): void {
        if (self::$_allowInjections) {
            return;
        }
        throw new \Exception("Service injection must be used in test environment only");
    }
}
