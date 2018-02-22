<?php

namespace Locaty\ServiceLocator;

use Locaty\Entity\AbstractService;

abstract class AbstractServiceLocator {

    /**
     * @var AbstractService[]
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
     * @return AbstractService
     */
    protected static function _get(string $class): AbstractService {
        $class = self::_prepareClassName($class);
        if (array_key_exists($class, self::$_services)) {
            return self::$_services[$class];
        }
        $service = new $class();
        self::$_services[$class] = $service;
        return $service;
    }

    public static function allowInjections(): void {
        self::$_allowInjections = true;
    }

    /**
     * @param string $class
     * @param string $replaceClass
     */
    public static function inject(string $class, string $replaceClass): void {
        self::_ensureInjectionAvailable();
        self::$_injections[$class] = $replaceClass;
        if (array_key_exists($class, self::$_services)) {
            self::$_services[$class] = new $replaceClass();
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
