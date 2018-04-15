<?php

namespace Tests\Mock\Component\Logger;

use Locaty\Component;
use Locaty\Component\Logger\NotificationEngine;

class Facade extends Component\Logger\Facade {

    /**
     * @return string
     */
    protected function _getLogsDir(): string {
        return '/tmp/_locaty_tests';
    }

    /**
     * @return NotificationEngine\Basic|null
     */
    protected function _getNotificationEngine(): ?NotificationEngine\Basic {
        return null;
    }
}
