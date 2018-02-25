<?php

namespace Tests\Mock\Config;

use Locaty\Config;

class Local extends Config\Basic {

    /**
     * @return string
     */
    public static function host(): string {
        return self::$_config['host'];
    }
}
