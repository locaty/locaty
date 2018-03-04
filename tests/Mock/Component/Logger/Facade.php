<?php

namespace Tests\Mock\Component\Logger;

use Locaty\Component;

class Facade extends Component\Logger\Facade {

    /**
     * @return string
     */
    protected function _getLogDir(): string {
        return '/tmp/_locaty_tests';
    }
}
