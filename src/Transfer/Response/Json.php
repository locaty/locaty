<?php

namespace Locaty\Transfer\Response;

class Json extends Basic {

    /**
     * @var string
     */
    private $_content;

    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->_content = json_encode($data, JSON_UNESCAPED_UNICODE);
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
            self::HEADER_CONTENT_TYPE => 'application/json',
        ];
    }
}
