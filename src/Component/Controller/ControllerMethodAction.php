<?php

namespace Locaty\Component\Controller;

use Locaty\Entity\AbstractAction;

class ControllerMethodAction extends AbstractAction {

    /**
     * @var string
     */
    private $_controllerClass;

    /**
     * @var string
     */
    private $_actionName;

    /**
     * @param string $controllerClass
     * @param string $actionName
     */
    public function __construct(string $controllerClass, string $actionName) {
        $this->_controllerClass = $controllerClass;
        $this->_actionName = $actionName;
    }

    /**
     * @param array $params
     */
    public function run(array $params): void {
        $controller = new $this->_controllerClass();
        // @todo: include params into request context
        call_user_func([$controller, $this->_actionName]);
    }
}
