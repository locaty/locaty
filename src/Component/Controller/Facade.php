<?php

namespace Locaty\Component\Controller;

use Locaty\Entity\AbstractAction;
use Locaty\Entity\AbstractService;

class Facade extends AbstractService {

    /**
     * @param AbstractAction $action
     * @param array $params
     */
    public function executeAction(AbstractAction $action, array $params = []): void {
        $action->run($params);
    }
}
