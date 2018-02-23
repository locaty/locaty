<?php

namespace Locaty\Transfer\Response;

abstract class AbstractResponse {

    /**
     * @return string
     */
    public abstract function body();

    /**
     * @return void
     */
    public abstract function setHeaders(): void;

    /**
     * @return bool
     */
    public function hasBody(): bool {
        return true;
    }
}
