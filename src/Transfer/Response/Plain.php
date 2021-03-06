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
    public function __construct(string $content) {
        $this->_content = $content;
    }

    /**
     * @return string
     */
    public function content(): ?string {
        return $this->_content;
    }

    /**
     * @return array
     */
    public function headers(): array {
        return [
            self::HEADER_CONTENT_TYPE => 'text/plain',
        ];
    }
}
