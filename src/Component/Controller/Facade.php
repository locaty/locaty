<?php

namespace Locaty\Component\Controller;

use Locaty\ServiceLocator\AbstractService;

class Facade extends AbstractService {

    /**
     * @param callable $action
     * @param array $params
     */
    public function executeAction(callable $action, array $params = []): void {
        $action($params);
    }
}
