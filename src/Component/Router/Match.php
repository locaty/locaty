<?php

namespace Locaty\Component\Router;

class Match {

    /**
     * @var callable|array
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
     * @param callable|array $action
     * @param array $params
     * @param string $name
     */
    public function __construct($action, array $params = [], string $name = null) {
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
     * @return callable|array
     */
    public function action() {
        return $this->_action;
    }

    /**
     * @return array
     */
    public function params(): array {
        return $this->_params;
    }
}
