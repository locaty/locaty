<?php

namespace Locaty\Config;

use Locaty\Pattern;

abstract class Basic {

    use Pattern\SingletonInstance;

    /**
     * @var array
     */
    protected $_config = [];

    /**
     * @param array $data
     */
    public function load(array $data): void {
        $this->_config = array_merge($this->_config, $data);
    }

    /**
     * @param array $configs
     */
    public function loadMulti(array $configs): void {
        $this->load(call_user_func_array('array_merge', $configs));
    }
}
