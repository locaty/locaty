<?php

namespace Tests\Component\Logger;

use Locaty\SL;
use Locaty\Testing;

class FacadeTest extends Testing\TestCase\Basic {

    public function testLog() {
        $testDir = '/tmp/_locaty_test';
        if (!file_exists($testDir)) {
            $this->assertTrue(mkdir($testDir));
        }
        register_shutdown_function(function() use ($testDir) {
            $this->assertTrue(unlink($testDir . '/facade.log'));
            $this->assertTrue(rmdir($testDir));
        });

        $this->assertTrue(putenv('LOCATY_LOG_DIR=' . $testDir));
        SL::logger()->log('facade', 'Entrypoint');

        $content = file_get_contents($testDir . '/facade.log');
        $lines = explode(PHP_EOL, $content);
        $this->assertCount(2, $lines);
        $this->assertContains('Entrypoint', $lines[0]);
        $this->assertEmpty($lines[1]);
    }
}