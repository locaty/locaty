<?php

namespace Locaty\Component\Logger\NotificationEngine;

abstract class Basic {

    /**
     * @param \Throwable $exception
     */
    abstract public function notifyException(\Throwable $exception): void;

    /**
     * @param string $message
     * @param array $data
     */
    abstract public function notifyMessage(string $message, array $data = []): void;
}
