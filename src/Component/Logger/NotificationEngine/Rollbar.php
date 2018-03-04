<?php

namespace Locaty\Component\Logger\NotificationEngine;

use Rollbar\RollbarLogger;
use Rollbar\Payload\Level;

class Rollbar extends Basic {

    /**
     * @var RollbarLogger
     */
    private $_rollbarLogger;

    /**
     * @param string $token
     * @param string $environment
     */
    public function __construct(string $token, string $environment = 'development') {
        $this->_rollbarLogger = new RollbarLogger([
            'access_token' => $token,
            'environment' => $environment,
        ]);
    }

    /**
     * @param \Throwable $e
     */
    public function notifyException(\Throwable $e): void {
        $this->_rollbarLogger->log(Level::ERROR, $e, []);
    }

    /**
     * @param string $message
     * @param array $data
     */
    public function notifyMessage(string $message, array $data = []): void {
        $this->_rollbarLogger->info($message, $data);
    }
}