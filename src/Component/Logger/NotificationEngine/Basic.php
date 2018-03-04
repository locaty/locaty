<?php

namespace Locaty\Component\Logger\NotificationEngine;

abstract class Basic {

    /**
     * @param \Throwable $e
     */
    abstract public function notifyException(\Throwable $e): void;

    /**
     * @param string $message
     * @param array $data
     */
    abstract public function notifyMessage(string $message, array $data = []): void;
}
