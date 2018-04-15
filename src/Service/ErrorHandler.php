<?php

namespace Locaty\Service;

use Locaty\Exception;

class ErrorHandler extends AbstractService {

    public function registerHandlers(): void {
        register_shutdown_function([$this, 'handleShutdown']);
        set_error_handler([$this, 'throwErrorException']);
    }

    /**
     * @param int $code
     * @param string $text
     * @param string $file
     * @param string $line
     * @throws Exception\UnknownError
     */
    public function throwErrorException(?int $code, string $text, string $file, string $line): void {
        throw new Exception\UnknownError("{$text} in file {$file}:{$line}", $code);
    }

    /**
     * @throws Exception\UnknownError
     */
    public function handleShutdown(): void {
        $error = error_get_last();
        if ($error === null) {
            return;
        }
        $type = array_key_exists('type', $error) ? $error['type'] : 0;
        if ($type === E_DEPRECATED || $type === E_WARNING) {
            return;
        }
        $this->throwErrorException($type, $error['message'], $error['file'], $error['line']);
    }
}
