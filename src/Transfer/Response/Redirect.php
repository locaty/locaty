<?php

namespace Locaty\Transfer\Response;

class Redirect extends Basic {

    /**
     * @var string
     */
    private $_url;

    /**
     * @param string $url
     */
    public function __construct(string $url) {
        $this->_url = $url;
    }

    /**
     * @return string
     */
    public function content(): ?string {
        return null;
    }

    /**
     * @return array
     */
    public function headers(): array {
        return [
            self::HEADER_LOCATION => $this->_url,
        ];
    }
}
