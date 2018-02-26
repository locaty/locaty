<?php

namespace Locaty\Transfer\Response;

abstract class Basic {

    const HEADER_CONTENT_TYPE = 'Content-type';
    const HEADER_LOCATION = 'Location';

    /**
     * @return string
     */
    abstract public function content(): ?string;

    /**
     * @return array
     */
    abstract public function headers(): array;
}
