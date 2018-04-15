<?php

namespace Locaty\Component\Config;

abstract class Facade {

    /**
     * @var array
     */
    protected $_config = [];

    /**
     * @param array $config
     */
    protected function _mergeData(array $config): void {
        $this->_config = array_replace_recursive($this->_config, $config);
    }
}
