<?php

namespace Locaty\Controller;

abstract class Basic {

    /**
     * @param string $name
     * @return callable
     */
    public static function action(string $name): callable {
        return [get_called_class(), $name . 'Action'];
    }
}
