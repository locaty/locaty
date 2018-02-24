<?php

namespace Locaty\Transfer\Response;

class Plain extends Basic {

    /**
     * @var string
     */
    private $_content;

    /**
     * @param string $content
     */
    public function __construct(string $content = '') {
        $this->_content = $content;
    }

    /**
     * @return string
     */
    public function body() {
        return $this->_content;
    }

    /**
     * @return void
     */
    public function setHeaders(): void {
        header('Content-type: text/plain');
    }
}
