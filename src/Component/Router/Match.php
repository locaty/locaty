<?php

namespace Locaty\Component\Router;

class Match {

    /**
     * @var callable
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
     * @param callable $action
     * @param array $params
     * @param string $name
     */
    public function __construct(callable $action, array $params = [], string $name = null) {
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
     * @return callable
     */
    public function action(): callable {
        return $this->_action;
    }

    /**
     * @return array
     */
    public function params(): array {
        return $this->_params;
    }
}
