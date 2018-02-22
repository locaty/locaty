<?php

namespace Locaty\Component\Router;

use Locaty\Entity\AbstractAction;

class Match {

    /**
     * @var AbstractAction
     */
    private $_action;

    /**
     * @var array
     */
    private $_params;

    /**
     * @var string
     */
    private $_name;

    /**
     * @param AbstractAction $action
     * @param array $params
     * @param string $name
     */
    public function __construct(AbstractAction $action, array $params = [], string $name = null) {
        $this->_action = $action;
        $this->_params = $params;
        $this->_name = $name;
    }

    /**
     * @return null|string
     */
    public function name(): ?string {
        return $this->_name;
    }

    /**
     * @return AbstractAction
     */
    public function action(): AbstractAction {
        return $this->_action;
    }

    /**
     * @return array
     */
    public function params(): array {
        return $this->_params;
    }
}
