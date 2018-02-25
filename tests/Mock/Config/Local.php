<?php

namespace Tests\Mock\Config;

use Locaty\Config;

class Local extends Config\Basic {

    /**
     * @return string
     */
    public function host(): string {
        return $this->_config['host'];
    }
}
