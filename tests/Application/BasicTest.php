<?php
/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\Application;

use Locaty\Testing;
use Tests\Mock;

class BasicTest extends Testing\TestCase\Basic {

    /**
     * @runInSeparateProcess
     */
    public function testRun() {
        /** @var Mock\Application\Http $app */
        $app = Mock\Application\Http::create();
        $app->setActionName('indexAction');
        ob_start();
        $app->run();
        $result = ob_get_contents();
        ob_end_clean();
        $this->assertEquals('ok', $result);
    }

    public function testHandleError() {
        /** @var Mock\Application\Http $app */
        $app = Mock\Application\Http::create();
        $app->setActionName('badAction');
        $this->expectExceptionMessage('Some error');
        $app->run();
    }
}
