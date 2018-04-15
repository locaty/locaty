<?php

namespace Locaty\Controller;

use Locaty\Component\Template;

abstract class Basic {

    /**
     * @param string $name
     * @return callable|array
     */
    public static function action(string $name) {
        return [get_called_class(), $name . 'Action'];
    }
}
