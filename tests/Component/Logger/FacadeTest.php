<?php

namespace Tests\Component\Logger;

use Locaty\Testing;
use Tests\Mock;

class FacadeTest extends Testing\TestCase\Basic {

    const LOG_DIR = '/tmp/_locaty_tests';

    public function setUp() {
        parent::setUp();
        $this->_initLogger();
    }

    public function testLog() {
        $logger = new Mock\Component\Logger\Facade();
        $logger->log('facade', 'Entrypoint');

        $content = file_get_contents(self::LOG_DIR . '/facade.log');
        $lines = explode(PHP_EOL, $content);
        $this->assertCount(2, $lines);
        $this->assertContains('Entrypoint', $lines[0]);
        $this->assertEmpty($lines[1]);
    }

    protected function _initLogger() {
        if (!file_exists(self::LOG_DIR)) {
            mkdir(self::LOG_DIR);
        }
        register_shutdown_function(function () {
            if (file_exists(self::LOG_DIR)) {
                shell_exec('rm -rf ' . self::LOG_DIR);
            }
        });
    }
}
