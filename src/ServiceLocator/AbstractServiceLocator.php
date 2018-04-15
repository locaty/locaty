<?php

namespace Locaty\ServiceLocator;

use Psr;

abstract class AbstractServiceLocator {

    /**
     * @var Psr\Container\ContainerInterface
     */
    protected static $_container;

    /**
     * @param Psr\Container\ContainerInterface $container
     */
    public static function setContainer(Psr\Container\ContainerInterface $container) {
        self::$_container = $container;
    }
}
